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
                       <li class="active"><a href="#home">Home</a>
                       <li><a href="#event">Event</a>                       
                       <li><a href="#">Google Student Ambassador</a>                                              
                       <li><a href="members.php">Members</a>                                              
                       <li><a href="#">About</a>                       
                   </ul>
               </div> 
           </div> 
        </div>
        <div class="container-fluid">
            <div class="row">
              <section id="home" class="jumbotron">
                  <div class="container">
                    <h3 class="page-header text-center home-header">Welcome to Google Students Club</h4>
                    <p class="text-center">
                        Google Students Club at Mepco Schlenk Engineering College, Sivakasi has been started to bring out the young talents in sparkling minds. It was started in 2013 with a strength of 70 members in the club. This club functions under the Google Student Ambassador selected by Google India Pvt Ltd. 
                    </p>
                    <div class="col-lg-4">
                        <button class="btn btn-warning form-control" data-toggle="collapse" data-target=".suggest">
                           Suggest Events
                        </button>
                        <div class="suggest collapse">
                            <div class="well">
                                <form class="form-horizontal" id="form-suggest" method="post">
                                   <div class="form-group">
                                       <div class="col-lg-12">
                                           <input class="form-control" type="text" placeholder="Name" name="name"/>
                                       </div>
                                   </div> 
                                   <div class="form-group">
                                       <div class="col-lg-12">
                                           <input class="form-control" type="text" placeholder="Email" name="email"/>
                                       </div>
                                   </div> 
                                   <div class="form-group">
                                       <div class="col-lg-12">
                                           <textarea class="form-control" type="text" row="3" placeholder="The event you need and few lines of why you need..." name="reason"></textarea>
                                       </div>
                                   </div> 
                                   <div class="form-group">
                                       <div class="col-lg-12">
                                           <button type="button" id="btn-submit-suggestion" class="form-control btn btn-success">Submit</button>
                                       </div>
                                   </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-warning form-control" data-toggle="collapse" data-target=".subscribe">
                            Subscribe
                                <?php
                                
                                require_once('admin/include/subscribe.inc.php');
                                
                                if($count=CSubscribe::count()){
                                    echo("<span class='badge'>$count</span>");                                    
                                }
                                ?>
                        </button>
                        <div class="subscribe collapse">
                            <div class="well">
                                <form class="form-horizontal" id="form-subscribe" method="post">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <input name="name" placeholder="Your Name" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <input name="email" placeholder="Your Email" class="form-control"/>                                          
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <button class="form-control btn btn-success" id="btn-submit-subscribe" type="button">Submit</button>                                          
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-warning form-control" data-toggle="collapse" data-target=".feedback">
                           Feedback
                        </button>
                        <div class="feedback collapse">
                            <div class="well">
                                <form class="form-horizontal" id="form-feedback" method="post">
                                   <div class="form-group">
                                       <div class="col-lg-12">
                                           <input class="form-control" type="text" placeholder="Name" name="name"/>
                                       </div>
                                   </div> 
                                   <div class="form-group">
                                       <div class="col-lg-12">
                                           <input class="form-control" type="text" placeholder="Email" name="email"/>
                                       </div>
                                   </div> 
                                   <div class="form-group">
                                       <div class="col-lg-12">
                                           <textarea class="form-control" type="text" row="3" placeholder="Tell us your thought..." name="feedback"></textarea>
                                       </div>
                                   </div> 
                                   <div class="form-group">
                                       <div class="col-lg-12">
                                           <button type="button" class="form-control btn btn-success">Submit</button>
                                       </div>
                                   </div> 
                                </form>
                            </div>
                        </div>
                    </div>
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
        <div class="modal fade" id="modal-feedback">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>                        
                        <h4 class="modal-title">Feedback</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-event-feedback" method="post">
                            <div class="form-group">
                                <label class="control-label col-lg-2">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Name" name="name"/> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Department</label>
                                <div class="col-lg-4">
                                    <select name="department" class="form-control">
                                        <option>Mech</option>
                                        <option>CSE</option>
                                        <option>EEE</option>
                                        <option>ECE</option>
                                        <option>IT</option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Section</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Section" name="section"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Year</label>
                                <div class="col-lg-4">
                                    <select name="batch" class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Email" name="email"/> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4">Date Of Birth</label>
                                <div class="col-lg-2">
                                    <select name="day" class="form-control">
                                        <?php
                                            for($i=1;$i<=31;$i++){
                                                echo("<option>$i</option>");
                                            } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <select name="month" class="form-control">
                                        <option>Jan</option>
                                        <option>Feb</option>
                                        <option>March</option>
                                        <option>April</option>
                                        <option>May</option>                                        
                                        <option>June</option>
                                        <option>July</option>
                                        <option>Aug</option>
                                        <option>Sept</option>
                                        <option>Oct</option>
                                        <option>Nov</option>
                                        <option>Dec</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select name="year" class="form-control">
                                        <?php
                                            for($i=1990;$i<2015;$i++){
                                                echo("<option>$i</option>");
                                            } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-8">Are you a member of Google Students Club?</label>
                                <div class="radio col-lg-4">
                                    <label class="col-lg-6">
                                        <input type="radio" name="gscmember" value="yes"/>
                                        Yes
                                    </label>
                                    <label class="col-lg-6">
                                        <input type="radio" name="gscmember" value="no"/>                                        
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4">
                                    Feedback on the event
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <textarea row="3" class="form-control" placeholder="Something about the event..." name="feedback"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-submit-feedback" type="button" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>