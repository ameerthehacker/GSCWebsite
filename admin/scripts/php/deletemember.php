<?php
session_start();

require_once('../../include/members.inc.php');
require_once('../../include/login.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        if(isset($_POST['checked'])){
            if(CMembers::remove($_POST['checked'])){
                $response=array('error'=>false,'title'=>'Done!','message'=>'The member was removed','style'=>'notice');                        
            }
            else{
                $response=array('error'=>true,'title'=>'Internal Error!','message'=>'There was an internal error','style'=>'error');                    
            }   
        }
        else{
            $response=array('error'=>true,'title'=>'Error!','message'=>'Choose a member first','style'=>'error');                                
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