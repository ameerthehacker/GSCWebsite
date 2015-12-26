<html>
    <head>
        <title>Google Students Club</title>
        
        <!--CSS-->
        <link href="admin/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="admin/css/jquery.dialog.css" type="text/css" rel="stylesheet"/>
        <link href="admin/css/index.css" type="text/css" rel="stylesheet"/>        
        
        <!--Javascript-->
        <script src="admin/scripts/js/jquery.min.js" type="text/javascript"></script>
        <script src="admin/scripts/js/bootstrap.min.js" type="text/javascript"></script>                        
        <script src="admin/scripts/js/jquery.dialog.js" type="text/javascript"></script>
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
                       <li><a href="#home">Home</a>
                       <li><a href="#event">Event</a>                       
                       <li><a href="#">Google Student Ambassador</a>                                              
                       <li><a href="#">Members</a>                                              
                       <li><a href="#">About</a>                       
                   </ul>
               </div> 
           </div> 
        </div>
        <div class="container-fluid">
            <div class="row">
              <section id="home" class="jumbotron">
                  <h3 class="page-header text-center home-header">Welcome to Google Students Club</h4>
                  <p class="text-center">
                     Google Students Club at Mepco Schlenk Engineering College, Sivakasi has been started to bring out the young talents in sparkling minds. It was started in 2013 with a strength of 70 members in the club. This club functions under the Google Student Ambassador selected by Google India Pvt Ltd. 
                  </p>
              </section>
            </div><!--row-->
            <div class="row">
                <section id="event">
                    <h3 class="page-header text-center">Events</h3>
                    <div id="event-container" class="container">
                        
                    </div><!--container-->
                    <div class="container">
                        <div id="event-loading" class="row">
                            <div class="col-sm-push-2 col-sm-8 well">
                            <center>
                                <img class="img-responsive" alt="Ajax loader" src="admin/images/ajax-loader.gif"/>
                            </center>
                            </div>
                        </div>
                    </div>
                </section>
            </div><!--row-->
        </div><!--container-fluid-->
    </body>
</html>