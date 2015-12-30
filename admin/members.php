<?php
session_start();

require_once('include/table.inc.php');

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
        <link href="css/jquery.dataTables.min.css" type="text/css" rel="stylesheet"/>                    
        <link href="css/dataTables.bootstrap.min.css" type="text/css" rel="stylesheet"/>          
        <link href="css/members.css" type="text/css" rel="stylesheet"/>        
        
        <!--Javascript-->
        <script src="scripts/js/jquery.min.js" type="text/javascript"></script>
        <script src="scripts/js/bootstrap.min.js" type="text/javascript"></script>                        
        <script src="scripts/js/jquery.dialog.js" type="text/javascript"></script>
        <script src="scripts/js/jquery.form.js" type="text/javascript"></script>      
        <script src="scripts/js/jquery.dataTables.min.js" type="text/javascript"></script>                       
        <script src="scripts/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/js/jquery.download.js" type="text/javascript"></script>                      
        <script src="scripts/js/members.js" type="text/javascript"></script>                                                                   
                        
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
                    <li><a href="events.php">Events</a></li>        
                    <li class="active"><a href="members.php">Members</a></li>                                                                       
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
        <div class="row well">
            <div class="col-lg-4">
                <button class="btn btn-primary form-control" data-toggle="modal" data-target="#modal-insert-member">Add</button>
            </div>
            <div class="col-lg-4">
                <button id="btn-remove-member" class="btn btn-danger form-control">Delete</button>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-primary form-control" data-toggle="dropdown" data-target=".dropdown-body">Export <span class="caret"></span></button>
                <div class="dropdown-toggle dropdown-body">
                    <ul class="dropdown-menu">
                        <li><a id="btn-export-word" href="#">Microsoft Word</a></li>
                        <li><a id="btn-export-excel" href="#">Microsoft Excel</a></li>                    
                    </ul>
                </div>
            </div>
        </div>
        <div class="row well well-lg">
            <?php
                $table=new CTable('members','table-members');
                $html=$table->drawTable(array('#',' ','Office Bearing','Name','Class','Email'),true,
                "SELECT * FROM members ORDER BY designation");
                echo("$html"); 
            ?>
        </div>
    </div>
    <div class="modal fade" id="modal-insert-member">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Member</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="form-add-member">
                        <div class="form-group">
                            <label class="control-label col-lg-3">Name</label>                            
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" placeholder="Name"></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Class</label>                            
                            <div class="col-lg-9">
                                <input type="text" name="class" class="form-control" placeholder="Class"></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Email</label>                            
                            <div class="col-lg-9">
                                <input type="text" name="email" class="form-control" placeholder="Email"></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Office Bearing</label>                            
                            <div class="col-lg-9">
                                <select class="form-control" name="designation">
                                    <option>Staff Advisor</option>
                                    <option>Chair Person</option>
                                    <option>Writer And Editor</option>
                                    <option>Creative Lead</option>
                                    <option>Designer</option>      
                                    <option>Technical Lead</option>
                                    <option>Event Organizer</option>                                    
                                    <option>Office Bearer</option>                                                                                                                                          
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btn-add-member" class="btn btn-success">Add</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>