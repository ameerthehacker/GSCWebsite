<?php

require_once('connect.inc.php');

class CSuggestion{
    public static function suggest($details){
        $name=$details['name'];
        $email=$details['email'];
        $reason=$details['reason'];
        
        $sql="INSERT INTO suggestions VALUES (' ','$name','$email','$reason')";
        
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }
    }
    public static function count(){
        
        $sql="SELECT * FROM suggestions";
        
        if($result=mysql_query($sql)){
            $count=mysql_num_rows($result);
            return $count;
        }
        else{
            return false;
        }
        
    }
    public static function getSuggesion($id){
        
        $sql="SELECT * FROM suggestions WHERE id='$id'";
        
        if($result=mysql_query($sql)){
            if($suggestion=mysql_fetch_assoc($result)){
                return $suggestion;
            }
        }
        else{
            return false;
        }
        
    }
    public static function clear(){
        
        $sql="DELETE FROM suggestions";
        
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }
        
    }
    public static function getSuggestions(){
        
        $sql="SELECT * FROM suggestions";
        
        if($result=mysql_query($sql)){
            return $result;
        }
        else{
            return false;
        }
    }
    public static function reply($id,$message){
        $suggestion=CSuggestion::getSuggesion($id);
        $headers="From: GSC \r\n";
        $to=$suggestion['email'];
        $subject="GSC Event Request Reply";
        if(mail($to,$subject,$message,$headers)){
            return true;
        }
        else{
            return false;
        }
    }
}
 
?>