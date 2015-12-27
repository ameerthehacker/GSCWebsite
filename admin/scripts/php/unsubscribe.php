<?php

require('../../include/subscribe.inc.php');

if(isset($_GET['email'])&&isset($_GET['rand'])){
    $email=$_GET['email'];
    $rand=$_GET['rand'];
    if(CSubscribe::unsubscribe($email,$rand)){
        echo("You are unsubsribed from Google Students Club you wont  recieve any updates!");
    }
    else{
        echo("Sorry!,We could not complete your request");        
    }
}
else{
    echo("Sorry!,We could not complete your request");
}
 
?>