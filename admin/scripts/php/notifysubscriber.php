<?php
session_start();

require_once('../../include/subscribe.inc.php');
require_once('../../include/login.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        if(isset($_POST['id'])){
            $eventid=$_POST['id'];
            if(CSubscribe::sendMail($eventid)){
                $response=array('title'=>'Done!','message'=>'The mail was sent','style'=>'notice');                        
            }
            else{
                $response=array('title'=>'Internal Error!','message'=>'There was an internal error','style'=>'error');                    
            }
        }
        else{
            $response=array('title'=>'Error!','message'=>'Invalid Event Index','style'=>'error');            
        }
    }
    else{
        $response=array('title'=>'Access Denied','message'=>'You are not authentiated','style'=>'error');        
    }
}
else{
    $response=array('title'=>'Access Denied','message'=>'You are not authentiated','style'=>'error');
}
echo(json_encode($response));
?>