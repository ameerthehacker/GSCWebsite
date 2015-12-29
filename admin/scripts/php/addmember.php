<?php
session_start();

require_once('../../include/members.inc.php');
require_once('../../include/login.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        foreach($_POST as $value){
            if($value==""){
                $response=array('title'=>'Error!','message'=>'Make sure you filled all the field','style'=>'error');    
                echo(json_encode($response));
                exit(); 
            }   
        }
        if(CMembers::add($_POST)){
            $response=array('error'=>false,'title'=>'Done!','message'=>'The member was added','style'=>'notice');                        
        }
        else{
            $response=array('error'=>true,'title'=>'Internal Error!','message'=>'There was an internal error'.mysql_error(),'style'=>'error');                    
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