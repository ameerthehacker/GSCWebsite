<html>
    <head>
        <title>Google Students Club</title>
        
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        
        <!--CSS-->
        <link href="admin/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="admin/css/jquery.dialog.css" type="text/css" rel="stylesheet"/>
        <link href="admin/css/index.css" type="text/css" rel="stylesheet"/>        
        
        <!--Javascript-->
        <script src="admin/scripts/js/jquery.min.js" type="text/javascript"></script>
        <script src="admin/scripts/js/bootstrap.min.js" type="text/javascript"></script>                        
        <script src="admin/scripts/js/jquery.dialog.js" type="text/javascript"></script>
        <script src="admin/scripts/js/jquery.form.js" type="text/javascript"></script>        
        <script src="admin/scripts/js/home.js" type="text/javascript"></script>        
                        
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a gref="#" class="navbar-brand">GSC</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-body">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                                              
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-right navbar-body">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php#home">Home</a>
                        <li><a href="index.php#event">Event</a>                       
                        <li><a href="#">Google Student Ambassador</a>                                              
                        <li class="active"><a href="#">Members</a>                                              
                        <li><a href="#">About</a>                       
                    </ul>
                </div> 
            </div> 
        </div>
        <div class="jumbotron">
           <div class="container">
               <h1>Hey there!,<small>We run the whole fleet at GSC</small></h1> 
           </div>
        </div>
        <div class="container">
            <div class="row well well-lg">
                <?php
                
                    require_once('admin/include/table.inc.php');
                
                    $table=new CTable('members','table-members');
                    $html=$table->drawTable(array('Office Bearing','Name','Class','Email'),false,
                    "SELECT designation,name,class,email FROM members ORDER BY designation");
                    echo("$html"); 
                ?>
            </div>
        </div>
    </body>
</html>