<?php

require_once('../../include/subscribe.inc.php');

foreach($_POST as $value){
    if($value==""){
        $response=array('title'=>'Error!','message'=>'Make sure you filled all the field','style'=>'error');
        echo(json_encode($response));
        exit();
    }
}
$name=$_POST['name'];
$email=$_POST['email'];
if(CSubscribe::add($name,$email)){
    $response=array('title'=>'Thank You','message'=>'Thanks,We will keep you updated','style'=>'notice');
}
else{
    $response=array('title'=>'Internal Error!','message'=>'There was an internal error','style'=>'error');            
}
echo(json_encode($response));
?>