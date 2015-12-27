<?php

require_once('connect.inc.php');

class CEvents{
    public static function getDetails($id){
        $sql="SELECT id,title,description,venue,date,time FROM events WHERE id='$id'";
        if($result=mysql_query($sql)){
            $event=mysql_fetch_assoc($result);
            return $event;
        }
        else{
            return false;
        }
    }
    public static function noOfEvents(){
        $sql="SELECT * FROM events";
        if($result=mysql_query($sql)){
            return mysql_num_rows($result);
        }
        else{
            return false;
        }
    }
    public static function deleteEvent($id){
        $sql="DELETE FROM events WHERE id='$id'";
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }
    }
    public static function getEvents($noOfEvents,$admin=false){
        $html="";
        if($admin){
            $image="scripts/php/photo.php";
        }
        else{
            $image="admin/scripts/php/photo.php";   
            $dropdown="";         
        }
        $sql="SELECT * FROM events ORDER BY id DESC LIMIT $noOfEvents";
        if($result=mysql_query($sql)){
            while($event=mysql_fetch_assoc($result)){
                $id=$event['id'];
                $title=$event['title'];
                $description=$event['description'];
                $venue=$event['venue'];
                $date=$event['date'];
                $time=$event['time'];
                
                if($admin){
                    $dropdown="<div class='dropdown pull-right'>
                                    <a href='#' role='button' class='dropdown-toggle' data-toggle='dropdown'>
                                        <span class='caret'></span>
                                    </a>
                                    <ul class='dropdown-menu'>
                                        <li><a event-id='$id' class='edit-event' data-toggle='modal' data-target='#modal-edit-event' href='#'>Edit</a></li>                                                                                
                                        <li><a event-id='$id' class='delete-event' href='#'>Delete</a></li>
                                    </ul>
                                </div><!--dropdown-->";
                    $mail="<div class='col-sm-4'> 
                               <button type='button' event-id='$id' class='btn btn-primary form-control notify-event'>Notify</button>
                           </div>";
                }
                else{
                    $dropdown="";
                    $mail="";
                }
                
                $html.="<div class='row'>
                        <div class='col-lg-push-2 col-lg-8 col-sm-12'>
                                <div class='panel panel-primary'>
                                    <div class='panel-heading'>
                                        $dropdown
                                        <h3 class='panel-title'>$title</h3>                                        
                                    </div><!--panel-heading-->
                                    <div class='panel-body'>
                                        <div class='container-fluid'>
                                            <div class='row'>
                                                <div class='col-sm-12'>
                                                    <p class='event-header'>
                                                        $description
                                                    </p>
                                                </div>
                                            </div>
                                            <div class='row well'>
                                                <div class='col-sm-12'>
                                                    <img class='img-responsive img-thumbnail' src='$image?id=$id' alt='Event Image'/>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-sm-12'>
                                                    <p class='event-details'>Going to be held at $venue</p>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-sm-12'>
                                                    <p class='event-details'>Scheduled on $date at $time</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--panel-body-->
                                    <div class='panel-footer'>
                                        <div class='container-fluid'>
                                            <div class='row'>
                                                <div class='col-sm-4'>
                                                    <button type='button' event-id='$id' class='btn btn-primary form-control event-feedback' data-toggle='modal' data-target='#modal-feedback'>Feedback</button>
                                                </div>
                                                $mail
                                            </div>
                                        </div>
                                    </div><!--panel-footer-->
                                </div><!--panel panel-primary-->
                            </div><!--col-lg-6 col-sm-12-->
                        </div><!--row-->";
            }
            return $html;
        }
        else{
            return false;
        }    
    }
}
 
?>