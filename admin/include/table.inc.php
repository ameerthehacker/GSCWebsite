<?php

require_once('connect.inc.php');

class CTable{
	private $tableName;
	private $tableid;
	
	public function __construct($tableName,$tableid=""){
		$this->tableName=$tableName;
		$this->tableid=$tableid;
	}
	public function drawTable($columnHeaders=NULL,$hasCheckBox=false){
		
		$sql="SELECT * FROM $this->tableName";
		if($result_records=mysql_query($sql)){
            $header="<table id=\"$this->tableid\" table-name=\"$this->tableName\" class=\"table table-stripped\" cellspacing=\"0\" width=\"100%\">\n<thead>\n<tr>\n";
            $body="<tbody>\n";
            $footer="<tfoot>\n<tr>\n";
            while($record=mysql_fetch_assoc($result_records)){
                $body.="<tr>\n";
                if($hasCheckBox){
                    $body.="<td><input feedback-id=\"$record[id]\" class=\"table-checkbox\" type=\"checkbox\"/></td>";
                }
                foreach($record as $field){
                    $body .="<td>$field</td>\n";
                }
                $body.="</tr>";
            }
            $body .="</tbody>\n";
            if($columnHeaders==NULL){	
                $sql="SHOW COLUMNS FROM $this->tableName";
                $result_columns=mysql_query($sql);
                while($column=mysql_fetch_assoc($result_columns)){
                    $columnName=$column['Field'];
                    $header .= "<th>$columnName</th>\n";
                    $footer .= "<th>$columnName</th>\n";
                }
                $header.="</tr>\n</thead>\n";
                $footer.="</tr>\n</tfoot>\n</table>";
                echo("$header $body $footer");
            }
            else{
                foreach($columnHeaders as $columnHeader ){
                    $header .= "<th>$columnHeader</th>\n";
                    $footer .= "<th>$columnHeader</th>\n";
                }
                $header.="</tr>\n</thead>\n";
                $footer.="</tr>\n</tfoot>\n</table>";
                $table=$header.$body.$footer;
                return $table;
            }   
        }
        else{
            echo("".mysql_error());
            return false;
        }
	}
    public function deleteTable(){
        $sql="DELETE FROM $this->tableName";
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }
    }
    public function delete($values){
        $noError=true;
        foreach($values as $value){
            $sql="DELETE FROM $this->tableName WHERE id='$value'";
            mysql_query($sql);
            if(mysql_error()){
                $error=false;
            }                        
        }
        return $noError;
    }
}
 
?>