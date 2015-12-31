<?php 

require_once('../../include/suggestion.inc.php');

foreach($_POST as $values){
    if($values==""){
        $response=array('title'=>'Error!','message'=>'Make sure you filled all the field','style'=>'error');
        echo(json_encode($response));
        exit();
    }
}

if(CSuggestion::suggest($_POST)){
    $response=array('title'=>'Thank You','message'=>'Thanks for your suggestion','style'=>'notice');
}
else{
    $response=array('title'=>'Internal Error!','message'=>'There was an internal error','style'=>'error');            
}

echo(json_encode($response));

?>