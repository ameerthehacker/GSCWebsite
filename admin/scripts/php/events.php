<?php

require('../../include/events.inc.php');

if(isset($_POST['no'])){
    $admin=false;
    if(isset($_POST['admin'])){
        $admin=$_POST['admin'];
    }
    $noOfEvents=$_POST['no'];
    if($html=CEvents::getEvents($noOfEvents,$admin)){
        $noOfEvents=CEvents::noOfEvents();
        $response=array('html'=>$html,'count'=>$noOfEvents);
        echo(json_encode($response));
    }
}
 
?>