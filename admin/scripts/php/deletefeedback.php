<?php
session_start();

require('../../include/table.inc.php');
require('../../include/login.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        if(isset($_POST['tableName'])){
            if(isset($_POST['all'])){
                if($_POST['all']){
                    $removeAll=true;
                }
                else{
                    $removeAll=false;
                }
            }
            else{
                $removeAll=false;
            }
            $table=new CTable($_POST['tableName']);
            if($removeAll){
                if($table->deleteTable()){
                    $response=array('error'=>false,'title'=>'Done!','style'=>'notice','message'=>'All feedbacks were deleted');                    
                }
                else{
                    $response=array('error'=>true,'title'=>'Intenal Error!','style'=>'error','message'=>'There was an internal error');                        
                }
            }
            else{
                if(!isset($_POST['checked'])){
                    $response=array('error'=>true,'title'=>'Error!','style'=>'error','message'=>'Select a record first');
                }
                else{
                    if($table->delete($_POST['checked'])){
                        $response=array('error'=>false,'title'=>'Done!','style'=>'notice','message'=>'The feedbacks were deleted');
                    }
                    else{
                        $response=array('error'=>true,'title'=>'Intenal Error!','style'=>'error','message'=>'There was an internal error');    
                    }   
                }   
            }
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