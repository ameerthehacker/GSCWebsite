<?php

require_once('../../include/connect.inc.php');

//Check all the value are posted 

foreach($_POST as $value){
    if($value==""){
        $response=array('title'=>'Error!','message'=>'Make sure you filled all the field','style'=>'error');
        echo(json_encode($response));
        exit();
    }
}

//Check the posted image 

$formats=array('jpeg','gif','png');

$imageInfo=explode("/",$_FILES['image']['type']);
if($imageInfo[0]!="image"){
    $response=array('title'=>'Error!','message'=>'Invalid Image','style'=>'error');
    echo(json_encode($response));
}
elseif(!in_array($imageInfo[1],$formats)){
    $response=array('title'=>'Sorry!','message'=>'This image format is not supported','style'=>'error');
    echo(json_encode($response));
}
else{
    $title=mysql_real_escape_string($_POST['title']);
    $description=mysql_real_escape_string($_POST['description']);
    $venue=mysql_real_escape_string($_POST['venue']);
    $date=mysql_real_escape_string($_POST['date']);
    $time=mysql_real_escape_string($_POST['time']);
    $image=mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
    $imageType=mysql_real_escape_string($imageInfo[1]);
    
    $sql="INSERT INTO events VALUES('','$title','$description','$venue','$date','$time','$imageType','$image')";
    
    if(mysql_query($sql)){
        $response=array('title'=>'Done!','message'=>'This event was posted successfully!','style'=>'notice');
        echo(json_encode($response));
    }
    else{
        $response=array('title'=>'Internal Error!','message'=>'Error: '. mysql_error(),'style'=>'error');
        echo(json_encode($response));
    }
}
?>