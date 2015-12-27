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
    </body>
</html>

