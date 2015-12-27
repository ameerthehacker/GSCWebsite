<?php
session_start();

require_once('../../include/login.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        
        $noImage=false; //To flag whether the user updated the event image
        
        if(isset($_POST['edit'])){
            if(isset($_POST['id'])){
                $edit=true;
                $eventid=$_POST['id'];
            }
            else{
                $edit=false;
            }
        }
        else{
            $edit=false;
        }
        
        //Check all the value are posted 

        foreach($_POST as $key=>$value){
            if($value==""){
                if($edit && $key=="image"){
                    $noImage=true;
                    continue;
                }
                $response=array('title'=>'Error!','message'=>'Make sure you filled all the field','style'=>'error');
                echo(json_encode($response));
                exit();
            }
        }

        //Check the posted image 
            
        if(!$noImage){
            
            $formats=array('jpeg','gif','png');

            $imageInfo=explode("/",$_FILES['image']['type']);
            if($imageInfo[0]!="image"){
                $response=array('title'=>'Error!','message'=>'Invalid Image','style'=>'error');
                echo(json_encode($response));
                exit();
            }
            elseif(!in_array($imageInfo[1],$formats)){
                $response=array('title'=>'Sorry!','message'=>'This image format is not supported','style'=>'error');
                echo(json_encode($response));
                exit();                
            }
        }
        $title=mysql_real_escape_string($_POST['title']);
        $description=mysql_real_escape_string($_POST['description']);
        $venue=mysql_real_escape_string($_POST['venue']);
        $date=mysql_real_escape_string($_POST['date']);
        $time=mysql_real_escape_string($_POST['time']);
        if(!$noImage){
            $image=mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
            $imageType=mysql_real_escape_string($imageInfo[1]);   
        }
        if($edit){
            if($noImage){
                $sql="UPDATE events SET title='$title',description='$description',venue='$venue',date='$date',time='$time' WHERE id='$eventid'";
            }
            else{
                $sql="UPDATE events SET title='$title',description='$description',venue='$venue',date='$date',time='$time',imageType='$imageType',image='$image' WHERE id='$eventid'";                    
            }
        }
        else{
            $sql="INSERT INTO events VALUES('','$title','$description','$venue','$date','$time','$imageType','$image')";   
        }
        if(mysql_query($sql)){
            if($edit){
                $response=array('title'=>'Done!','message'=>'This event was updated successfully!','style'=>'notice');                                    
            }
            else{
                $response=array('title'=>'Done!','message'=>'This event was posted successfully!','style'=>'notice');                        
            }
        }
        else{
            $response=array('title'=>'Internal Error!','message'=>'There was an internal error','style'=>'error');
        }
    }
    else{
        $response=array('error'=>true,'title'=>'Access Denied','message'=>'You are not authentiated','style'=>'error');        
    }
}
else{
    $response=array('error'=>true,'title'=>'Access Denied','message'=>'You are not authentiated','style'=>'error');
}

echo(json_encode($response));

?>