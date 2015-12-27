<?php

require('events.inc.php');

class CSubscribe{
    public static function add($name,$email){
        if(!CSubscribe::getSubscriberByMail($email)){
            $rand=rand(1000000,5000000);
            $sql="INSERT INTO subscribe VALUES (' ','$name','$email','$rand')";
            $headers = 'From: GSC' . "\r\n" ;
            $headers  .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $subject="Thanks for subscribing to Google Students Club";
            $message="<html>
                      <head>
                      <body>
                           <p>Hey,$name thanks for subscribing to Google Students Club,</br>
                            we will keep you updated with all new events and happenings at Google Students Club
                            <p>
                            <h4>
                            <img src='http://www.gscwebsite.esy.es/admin/images/gsc.jpeg' alt='GSC Logo'></img>
                            <p>
                                <b>
                                Google Students Club at Mepco Schlenk Engineering College,
                                Sivakasi has been started to bring out the young talents in sparkling minds. 
                                It was started in 2013 with a strength of 70 members in the club. 
                                This club functions under the Google Student Ambassador selected by Google India Pvt Ltd. 
                                </b>
                            </p>
                            <h5>
                                <p>To unsubscribe at any time click on the link below</p>
                                <p>http://www.gscwebsite.esy.es/admin/scripts/php/unsubscribe.php?email=$email&rand=$rand</p>
                            </h5>
                            <h5><b><i>-Sincierly the GSC team</i></b></h5>
                        </body>
                        </html>";
            if(mysql_query($sql)){
                mail($email,$subject,$message,$headers);
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return true;
        }
    }
    public static function count(){
        $sql="SELECT * FROM subscribe";
        if($result=mysql_query($sql)){
            return mysql_num_rows($result);
        } 
        else{
            return false;
        }
    }
    public static function getSubscriberByMail($email){
        $sql="SELECT * FROM subscribe WHERE email='$email'";
        $result=mysql_query($sql);
        $subscriber=mysql_fetch_assoc($result);
        return $subscriber;
    }
    public static function unsubscribe($email,$rand){
        if($subscriber=CSubscribe::getSubscriberByMail($email)){
            if($subscriber['rand']==$rand){
                
                $sql="DELETE FROM subscribe WHERE email='$email'";
                
                if(mysql_query($sql)){
                    return true;   
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    public static function sendMail($id){
        $event=CEvents::getDetails($id);
        $headers = 'From: GSC' . "\r\n";        
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $to="";
        $subject="GSC Event Update";
        $message="<html>
                  <head>
                   </head>
                   <body>
                       <p>Hi,we are happy to update you with our new event</p>
                       <h4><p>$event[title]</p></h4>
                       <h5><p>$event[description]</p></h5>
                       <img src='http://www.gscwebsite.esy.es/admin/scripts/php/photo.php?id=$event[id]' alt='Event Image'></img>
                       <p>To be held at $event[venue]</p>
                       <p>Scheduled on $event[date] at $event[time]</p>
                       <h5><p>This is an automated email do not reply</p></h5>   
                       <h5><b><i>-Sincierly the GSC team</i></b></h5>                                        
                   </body>
                   </html>";
        $sql="SELECT * FROM subscribe";
        
        if($result=mysql_query($sql)){
            while($subscriber=mysql_fetch_assoc($result)){
                if($to==""){
                    $to=$subscriber['email'];
                }
                else{
                    $to.=",".$subscriber['email'];
                }
            }
            if(mail($to,$subject,$message,$headers)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}
 
?>