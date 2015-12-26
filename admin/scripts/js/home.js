$(function(){
    var eventContainer=$("#event-container"); 
    var eventCount=10;
    var eventLoaded=true;
    var totalEvents=0;
    var eventLoading=$("#event-loading");
    
    function displayEvents(count){
        eventLoaded=false;
        $.ajax({url:'admin/scripts/php/events.php',method:'POST',data:{no:eventCount},beforeSend:function(){
            eventLoading.css({visibility:'visible',display:'block'});
            
        },success:function(response){
            response=jQuery.parseJSON(response);
            if(response.html){
                eventContainer.html(response.html);
                totalEvents=response.count;
                eventLoaded=true;
                eventLoading.css({visibility:'hidden',display:'none'});                
            }
            else{
                $.growl({title:"Internal Error!",message:'Unable to get events',style:'error',location:'tc'});             
            }
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'}); 
        }});
    }
    
    displayEvents(eventCount);
    
    $(window).scroll(function(){ 
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollPosition-scrollHeight) / scrollHeight > 0.9) {
             if(eventLoaded && eventCount<=totalEvents){
                 eventCount+=10;
                 displayEvents(eventCount);
             }
        }
    })
     
});