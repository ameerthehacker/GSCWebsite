<?php
session_start();

require('../../include/login.inc.php');
require('../../include/events.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        if(isset($_POST['id'])){
            $eventid=$_POST['id'];
            if($details=CEvents::getDetails($eventid)){
                $response=$details;
            }
            else{
            }
        }
        else{
            $response=array('error'=>true,'title'=>'Error!','message'=>'Invalid event details','style'=>'error');                    
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