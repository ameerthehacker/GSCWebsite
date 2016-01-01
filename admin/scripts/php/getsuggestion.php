<?php
session_start();

require_once('../../include/suggestion.inc.php');
require_once('../../include/login.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if($login->isAuthentiated()){
        if($suggestions=CSuggestion::getSuggestions()){
            $html="";
            $count=CSuggestion::count();
            while($suggestion=mysql_fetch_assoc($suggestions)){
                $html.="<li record-id=$suggestion[id] class='suggestion'>
                            <div class='container-fluid'>
                                <div class='row'><b>$suggestion[name]</b></div>
                                <div class='row'><i>$suggestion[reason]</i></div>
                                <div clas='row'><div class='pull-right'><a record-id='$suggestion[id]' class='reply-suggest' data-toggle='modal' data-target='#modal-reply-suggest' href='#'>Reply</a></div></div>
                            </div>
                        </li>";
            }
            if($html!=""){
                $html.="<li class='text-center'><a href='#' id='clear-suggestions'>Clear All</a></li>";                                   
            }
            $response=array('error'=>false,'html'=>$html,'count'=>$count);
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