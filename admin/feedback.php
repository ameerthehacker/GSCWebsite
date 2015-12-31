<?php
session_start();

require_once('include/login.inc.php');
require_once('include/table.inc.php');
require_once('include/feedback.inc.php');

if(isset($_SESSION['user'])){
    $login=new CLogin($_SESSION['user']['username'],$_SESSION['user']['password']);
    if(!$login->isAuthentiated()){
        header('refresh:0;index.php');                   
    }
    else{
        $user=$_SESSION['user'];
    }
}
else{
    header('refresh:0;index.php');           
} 
?>


<html>
    <head>
        <title>Feedback</title>
        
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        
        <!--CSS-->
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="css/jquery.dialog.css" type="text/css" rel="stylesheet"/>
        <link href="css/jquery.dataTables.min.css" type="text/css" rel="stylesheet"/>                    
        <link href="css/dataTables.bootstrap.min.css" type="text/css" rel="stylesheet"/>          
        <link href="css/feedback.css" type="text/css" rel="stylesheet"/>                      
        
        <!--javascript-->
        <script src="scripts/js/jquery.min.js" type="text/javascript"></script> 
        <script src="scripts/js/bootstrap.min.js" type="text/javascript"></script>         
        <script src="scripts/js/jquery.dataTables.min.js" type="text/javascript"></script>                       
        <script src="scripts/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/js/jquery.dialog.js" type="text/javascript"></script>        
        <script src="scripts/js/jquery.download.js" type="text/javascript"></script>                
        <script src="scripts/js/feedback.js" type="text/javascript"></script>
        <script src="scripts/js/suggestion.js" type="text/javascript"></script>                                                                                   
        
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
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span><span class="badge">4</span></a>
                            <ul id="suggest-notification" class="dropdown-menu dropdown-toggle">
                                
                            </ul>
                        </li>
                        <li><a href="#" id="btn-delete-all">Remove All</a></li>
                        <li><a href="#" id="btn-delete">Delete Feedback</a></li>        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Export  <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a id="btn-export-word" href="#">Microsoft Word</a></li>
                                <li><a id="btn-export-excel" href="#">Microsoft Excel</a></li>                                                
                            </ul>
                        </li>                                                       
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
            <div class="well well-lg">
                <div class="row">
                    <?php
                        if(isset($_GET['id'])){
                            $eventid=$_GET['id'];
                            CFeedback::createFeedback($eventid);
                            $table=new CTable("feedback".$eventid,'table-feedback');
                            $response=$table->drawTable(array('#','','Name','Department','Section',
                            'Year','Email','Date Of Birth','GSC Member','Feedback'),true);
                            echo("$response");
                        }
                        else{
                            echo("<p>Invalid event index</p>");  
                            exit();                  
                        }     
                    ?>
                </div>
         </div>
         <div class="modal fade" id="modal-reply-suggest">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reply</h4>
                    </div>
                    <div class="modal-body">
                        <textarea id="txt-reply-suggest" row="5" class="form-control" placeholder="Your reply..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" id="btn-reply-suggest">Reply</button>
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

