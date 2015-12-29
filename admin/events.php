<?php
session_start();

if(!isset($_SESSION['user'])){
    header('refresh:0;index.php');
    exit();
}
else{
    $user=$_SESSION['user'];
}
 
?>
<html>
    <head>
        <title>GSC Admin</title>
        
        <!--CSS-->
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="css/jquery.dialog.css" type="text/css" rel="stylesheet"/>
        <link href="css/admin.css" type="text/css" rel="stylesheet"/>        
        
        <!--Javascript-->
        <script src="scripts/js/jquery.min.js" type="text/javascript"></script>
        <script src="scripts/js/bootstrap.min.js" type="text/javascript"></script>                        
        <script src="scripts/js/jquery.dialog.js" type="text/javascript"></script>
        <script src="scripts/js/jquery.form.js" type="text/javascript"></script>            
        <script src="scripts/js/events.js" type="text/javascript"></script>                                                                   
                        
    </head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">GSC Admin</a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-body">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                    
                </button>
            </div>
            <div class="collapse navbar-collapse navbar-body">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin.php">New Event</a></li>
                    <li class="active"><a href="events.php">Events</a></li>        
                    <li><a href="members.php">Members</a></li>                                                                       
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span>
                            <?php
                                echo("$user[username]");
                            ?>
                            <span class="caret"></span>                                
                        </a>
                        <ul class="dropdown-menu">
                            <li><a id="btn-logout" role="button" href="#">Logout</a></li>
                        </ul>
                    </li>                    
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <section id="event">
                <h3 class="page-header text-center">Events</h3>
                <div id="event-container" class="container">
                    
                </div><!--container-->
                <div class="container">
                        <div id="event-loading" class="row">
                            <div class="col-sm-push-2 col-sm-8 well">
                            <center>
                                <img class="img-responsive" alt="Ajax loader" src="images/ajax-loader.gif"/>
                            </center>
                            </div>
                        </div>
                    </div>
            </section>
        </div><!--row-->
    </div>
    <div id="modal-edit-event" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Events</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-edit-event" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-xs-2">Title</label>
                            <div class="col-lg-10">
                                <input id="title" type="text" placeholder="Event Title" class="form-control" name="title"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-2">Description</label>
                            <div class="col-lg-10">
                                <textarea id="description" placeholder="Something about the event..." class="form-control" row="3" name="description"></textarea>                                                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-2">Venue</label>
                            <div class="col-lg-10">
                                <input id="venue" type="text" placeholder="Event Venue" class="form-control" name="venue"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-2">Date</label>
                            <div class="col-lg-3">
                                <input id="date" type="text" placeholder="Event Date" class="form-control" name="date"/>
                            </div>
                            <label class="control-label col-xs-2">Time</label>
                            <div class="col-lg-3">
                                <input id="time" type="text" placeholder="Event Time" class="form-control" name="time"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-push-2 col-lg-4">
                                <img id="event-image" class="img-responsive img-thumbnail" src="" alt="Event Image"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-push-2 col-lg-2">
                                <button id="btn-browse-image" type="button" class="btn btn-primary">Browse Image</button>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-lg-2">Organizers</label>
                        <div class="col-lg-8">
                            <input type="input" id="txt-organizers" class="form-control" placeholder="Organized By.." name="organizers"/>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-warning form-control" data-toggle="collapse" data-target=".organizers"><span class="glyphicon glyphicon-pencil"></span></button>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-push-2 col-lg-8">
                                <div class="collapse organizers">
                                    <div class="checkbox">
                                        <?php
                                            
                                            require('include/members.inc.php');
                                            
                                            $members=CMembers::getMembers();
                                            while($member=mysql_fetch_assoc($members)){
                                                $html="<label class='checkbox-inline'>
                                                        <input type='checkbox' class='checkbox-members' value='$member[name]'/>$member[name]                
                                                        </label>";
                                                echo("$html");
                                            }
                                                
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-push-2 col-lg-10">
                                <div class="progress" id="event-progress" style="visiblity:hidden;display:none">
                                    <div class="progress-bar progress-bar-striped active" style="width:0%">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input id="image-file" type="file" name="image" style="visibility:hidden;display:none"/>
                    </form>
                    <div class="row">
                        <div id="edit-event-loader" class="well col-lg-push-1 col-lg-10">
                            <center>
                                <img src="images/ajax-loader.gif" alt="Ajax Loader"/>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-save-event" type="button" class="btn btn-primary">Save</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
