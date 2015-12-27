<?php 

require_once('../../include/feedback.inc.php');

if(isset($_POST['id'])){
    $eventid=$_POST['id'];
    foreach($_POST as $value){
        if($value==""){
            $response=array('title'=>'Error!','message'=>'Make sure you filled all the fields','style'=>'error');            
            echo(json_encode($response));
            exit();
        }
    }
    $dob=$_POST['day']." ".$_POST['month']." ".$_POST['year'];
    $feedback=array('name'=>$_POST['name'],'department'=>$_POST['department'],'section'=>$_POST['section'],'year'=>$_POST['batch'],
    'email'=>$_POST['email'],'dob'=>$dob,'gscmember'=>$_POST['gscmember'],'feedback'=>$_POST['feedback']);
    if(CFeedback::submitFeedback($eventid,$feedback)){
        $response=array('title'=>'Done!','message'=>'Thanks for your feedback','style'=>'notice');        
    }
    else{
        $response=array('title'=>'Internal Error!','message'=>'There was an internal error' . mysql_error(),'style'=>'error');            
    }
}
else{
    $response=array('title'=>'Error!','message'=>'Invalid event index','style'=>'error');
}
echo(json_encode($response));
?>