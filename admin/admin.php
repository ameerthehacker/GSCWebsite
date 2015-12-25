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
        <script src="scripts/js/admin.js" type="text/javascript"></script>                                
                        
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
                        <li><a href="#">New Event</a></li>
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
        
        <div class="container">
            <div class="well">
                <form class="form-horizontal" id="form-new-event" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <h4 class="text-center">New Event</h4>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">Title</label>
                        <div class="col-lg-8">
                            <input type="text" placeholder="Event Title" class="form-control" name="title"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">Description</label>
                        <div class="col-lg-8">
                            <textarea placeholder="Something about the event..." class="form-control" row="3" name="description"></textarea>                                                        
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">Venue</label>
                        <div class="col-lg-8">
                            <input type="text" placeholder="Event Venue" class="form-control" name="venue"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">Date</label>
                        <div class="col-lg-3">
                            <input type="text" placeholder="Event Date" class="form-control" name="date"/>
                        </div>
                        <label class="control-label col-xs-2">Time</label>
                        <div class="col-lg-3">
                            <input type="text" placeholder="Event Time" class="form-control" name="time"/>
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
                        <div class="col-lg-push-2 col-lg-8">
                            <div class="progress" id="event-progress" style="visiblity:hidden;display:none">
                                <div class="progress-bar progress-bar-striped active" style="width:0%">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-push-8 col-lg-2">
                            <button id="btn-post-event" class="btn btn-success form-control" type="submmit">Post</button>
                        </div>
                    </div>
                    <input id="image-file" type="file" name="image" style="visibility:hidden;display:none"/>
                </form>
            </div>
        </div>
    </body>
</html>