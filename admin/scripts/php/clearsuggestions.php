<?php
session_start();

require_once('../../include/suggestion.inc.php');
require_once('../../include/login.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        if($suggestions=CSuggestion::clear()){
            $response=array('error'=>false);
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