<?php

require_once('table.inc.php');
require_once('events.inc.php');

class CMembers{
    public static function getMembers(){
        
        $sql="SELECT * FROM members";
        
        $result=mysql_query($sql);
        return $result;
    }
    public static function add($details){
        $name=mysql_real_escape_string($details['name']);
        $class=mysql_real_escape_string($details['class']);
        $email=mysql_real_escape_string($details['email']);
        $designation=mysql_real_escape_string($details['designation']);
        
        $sql="INSERT INTO members VALUES (' ','$designation','$name','$class','$email')";
        
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }
       
    }
    public static function update($id,$details){
        $name=mysql_real_escape_string($details['name']);
        $class=mysql_real_escape_string($details['class']);
        $email=mysql_real_escape_string($details['email']);
        $designation=mysql_real_escape_string($details['designation']);
        
        $sql="UPDATE members SET designation='$designation',name='$name',class='$class',email='$email' WHERE id='$id'";
        
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }
       
    }
    public static function remove($checked){
        $table=new CTable('members');
        if($table->delete($checked)){
            return true;
        }
        else{
            return false;
        }
    }
    public static function sendMail($id){
        $event=CEvents::getDetails($id);
        $headers = 'From: GSC' . "\r\n";        
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $to="";
        $subject="GSC Event Update";
        $message="<html>
                  <head>
                   </head>
                   <body>
                       <p>Hey there! have a look at the new event</p>
                       <h4><p>$event[title]</p></h4>
                       <h5><p>$event[description]</p></h5>
                       <img src='http://www.gscwebsite.esy.es/admin/scripts/php/photo.php?id=$event[id]' alt='Event Image'></img>
                       <p>To be held at $event[venue]</p>
                       <p>Scheduled on $event[date] at $event[time]</p>
                       <h5><p>This is an automated email do not reply</p></h5>   
                       <h5><b><i>-Sincierly the GSC team</i></b></h5>                                        
                   </body>
                   </html>";
        $sql="SELECT * FROM members";
        
        if($result=mysql_query($sql)){
            while($subscriber=mysql_fetch_assoc($result)){
                if($to==""){
                    $to=$subscriber['email'];
                }
                else{
                    $to.=",".$subscriber['email'];
                }
            }
            if(mail($to,$subject,$message,$headers)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}
 
?>