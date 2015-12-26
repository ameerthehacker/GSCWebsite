<?php
session_start();

require_once('../../include/login.inc.php');
require_once('../../include/events.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        if(isset($_POST['id'])){
            $eventid=$_POST['id'];
            if(CEvents::deleteEvent($eventid)){
                $response=array('error'=>false,'title'=>'Done!','message'=>'The event was removed','style'=>'notice');                                                     
            }
            else{
                $response=array('error'=>true,'title'=>'Internal Error!','message'=>'There was an internal error','style'=>'error');                                     
            }
        }
        else{
            $response=array('error'=>true,'title'=>'Error!','message'=>'Invalid event index','style'=>'error');                    
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