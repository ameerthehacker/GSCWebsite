<?PHP
 session_start();
 
 require_once('../../../include/login.inc.php');
 
 if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if(!$login->isAuthentiated()){
        echo("<p>Access Denied,You are not authentiated</p>");
        exit();                        
    }
}
else{
    echo("<p>Access Denied,You are not authentiated</p>");
    exit();   
}
 
//EDIT YOUR MySQL Connection Info:
$DB_Server = $host;        //your MySQL Server
$DB_Username = $username;                 //your MySQL User Name
$DB_Password = $password;                //your MySQL Password
$DB_DBName = $database;                //your MySQL Database Name
$DB_TBLName = $_POST['tableName'];             //your MySQL Table Name

if($_POST['type']=="word"){
    $w=1;
}
else if($_POST['type']=="excel"){
    $w=0;
}

$sql = "SHOW COLUMNS FROM $DB_TBLName";
$fields=array();
if($result=mysql_query($sql)){
    while($field=mysql_fetch_assoc($result)){
        array_push($fields,$field['Field']);
    }
}
else{
    echo("Sorry,there was an internal error!");
    exit();
}
unset($fields[array_search('id',$fields)]);
$fields=implode(",",$fields);

$sql="SELECT $fields FROM $DB_TBLName";

//$DB_TBLName,  $DB_DBName, may also be commented out & passed to the browser
//as parameters in a query string, so that this code may be easily reused for
//any MySQL table or any MySQL database on your server
 
//DEFINE SQL QUERY:
//edit this to suit your needs
/*
 
Leave the connection info below as it is:
just edit the above.
 
(Editing of code past this point recommended only for advanced users.)
*/
//create MySQL connection
$Connect = @MYSQL_CONNECT($DB_Server, $DB_Username, $DB_Password)
     or DIE("Couldn't connect to MySQL:<br>" . MYSQL_ERROR() . "<br>" . MYSQL_ERRNO());
//select database
$Db = @MYSQL_SELECT_DB($DB_DBName, $Connect)
     or DIE("Couldn't select database:<br>" . MYSQL_ERROR(). "<br>" . MYSQL_ERRNO());
//execute query
$result = @MYSQL_QUERY($sql,$Connect)
     or DIE("Couldn't execute query:<br>" . MYSQL_ERROR(). "<br>" . MYSQL_ERRNO());
 
//if this parameter is included ($w=1), file returned will be in word format ('.doc')
//if parameter is not included, file returned will be in excel format ('.xls')
IF (ISSET($w) && ($w==1))
{
	 $file_type = "msword";
     $file_ending = "doc";
     
}ELSE {
     $file_type = "vnd.ms-excel";
     $file_ending = "xls";
}
//header info for browser: determines file type ('.doc' or '.xls')
HEADER("Content-Type: application/$file_type");
HEADER("Content-Disposition: attachment; filename=database_dump.$file_ending");
HEADER("Pragma: no-cache");
HEADER("Expires: 0");
 
/*    Start of Formatting for Word or Excel    */
 
IF (ISSET($w) && ($w==1)) //check for $w again
{
     /*    FORMATTING FOR WORD DOCUMENTS ('.doc')   */
     //create title with timestamp:
     //define separator (defines columns in excel & tabs in word)
     $sep = "\n"; //new line character
 
     WHILE($row = MYSQL_FETCH_ROW($result))
     {
         //set_time_limit(60); // HaRa
         $schema_insert = "";
         FOR($j=0; $j<mysql_num_fields($result);$j++)
         {
         //define field names
         $field_name = MYSQL_FIELD_NAME($result,$j);
         //will show name of fields
         $schema_insert .= "$field_name:\t";
             IF(!ISSET($row[$j])) {
                 $schema_insert .= "NULL".$sep;
                 }
             ELSEIF ($row[$j] != "") {
                 $schema_insert .= "$row[$j]".$sep;
                 }
             ELSE {
                 $schema_insert .= "".$sep;
                 }
         }
         $schema_insert = STR_REPLACE($sep."$", "", $schema_insert);
         $schema_insert .= "\t";
         PRINT(TRIM($schema_insert));
         //end of each mysql row
         //creates line to separate data from each MySQL table row
         PRINT "\n----------------------------------------------------\n";
     }
}ELSE{
     /*    FORMATTING FOR EXCEL DOCUMENTS ('.xls')   */
     //create title with timestamp:
     //define separator (defines columns in excel & tabs in word)
     $sep = "\t"; //tabbed character
 
     //start of printing column names as names of MySQL fields
     FOR ($i = 0; $i < MYSQL_NUM_FIELDS($result); $i++)
     {
         ECHO MYSQL_FIELD_NAME($result,$i) . "\t";
     }
     PRINT("\n");
     //end of printing column names
 
     //start while loop to get data
     WHILE($row = MYSQL_FETCH_ROW($result))
     {
         //set_time_limit(60); // HaRa
         $schema_insert = "";
         FOR($j=0; $j<mysql_num_fields($result);$j++)
         {
             IF(!ISSET($row[$j]))
                 $schema_insert .= "NULL".$sep;
             ELSEIF ($row[$j] != "")
                 $schema_insert .= "$row[$j]".$sep;
             ELSE
                 $schema_insert .= "".$sep;
         }
         $schema_insert = STR_REPLACE($sep."$", "", $schema_insert);
         //following fix suggested by Josue (thanks, Josue!)
         //this corrects output in excel when table fields contain \n or \r
         //these two characters are now replaced with a space
         $schema_insert = PREG_REPLACE("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
         $schema_insert .= "\t";
         PRINT(TRIM($schema_insert));
         PRINT "\n";
     }
}
?>