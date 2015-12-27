<?php

require_once('connect.inc.php');

class CFeedback{
    public static function createFeedback($id){
        $sql="CREATE TABLE IF NOT EXISTS feedback$id (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        department VARCHAR(255) NOT NULL,
        section VARCHAR(255) NOT NULL,
        year VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        dob VARCHAR(255) NOT NULL,
        gscmember VARCHAR(255) NOT NULL,
        feedback VARCHAR(600) NOT NULL,
        PRIMARY KEY(id)
        )";
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }
    }
    public static function submitFeedback($id,$feedback){
        
        if(CFeedback::createFeedback($id)){
            $name=$feedback['name'];
            $department=$feedback['department'];
            $section=$feedback['section'];
            $year=$feedback['year'];
            $email=$feedback['email'];
            $dob=$feedback['dob'];
            $gscmember=$feedback['gscmember'];
            $feedback=$feedback['feedback'];
            
            $sql="INSERT INTO feedback$id VALUES (' ','$name','$department','$section','$year','$email','$dob','$gscmember','$feedback' )";
            
            if(mysql_query($sql)){
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