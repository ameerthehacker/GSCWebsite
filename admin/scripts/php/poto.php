<?php

require_once('../../include/connect.inc.php');

if(!isset($_GET['id'])){
    exit();
}
else{
    $id=mysql_real_escape_string($_GET['id']);

    $sql="SELECT * FROM events WHERE id='$id'";
    
    if($result=mysql_query($sql)){
        if($event=mysql_fetch_assoc($result))
        {
            $imageType=$event['imageType'];
            $image=$event['image'];
            
            header("Content-Type: image/$imageType");
            
            echo("$image");   
        }
        else{
            echo("Invalid image index");
        }
    }        
    else{
        echo("Sorry there was an internal error!");
    }
}
?>