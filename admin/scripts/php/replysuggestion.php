<?php
session_start();

require_once('../../include/suggestion.inc.php');
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
        $id=$_POST['id'];
        $message=$_POST['message'];
        if($suggestions=CSuggestion::reply($id,$message)){
            $response=array('error'=>false,'title'=>'Done!','message'=>'The reply was sent','style'=>'notice');                        
        }
        else{
            $response=array('error'=>true,'title'=>'Internal Error!','message'=>'There was an internal error','style'=>'error');            
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