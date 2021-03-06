$(function(){
    var eventContainer=$("#event-container"); 
    var eventCount=10;
    var eventLoaded=true;
    var totalEvents=0;
    var eventLoading=$("#event-loading");
    var btnEventFeedback={};
    var btnSubmitFeedback=$("#btn-submit-feedback");
    var btnSubmitSuggestion=$("#btn-submit-suggestion");
    var formEventFeedback=$("#form-event-feedback");
    var eventid=0;
    var btnSubmitSubscribe=$("#btn-submit-subscribe");
    var formSubscribe=$("#form-subscribe");
    var formSuggest=$("#form-suggest");
    
    formEventFeedback.ajaxForm();
    formSubscribe.ajaxForm();
    formSuggest.ajaxForm();
    
    function displayEvents(count){
        eventLoaded=false;
        $.ajax({url:'admin/scripts/php/events.php',method:'POST',data:{no:eventCount},beforeSend:function(){
            eventLoading.css({visibility:'visible',display:'block'});
            
        },success:function(response){
            response=jQuery.parseJSON(response);
            eventContainer.html(response.html);
            totalEvents=response.count;
            eventLoaded=true;
            eventLoading.css({visibility:'hidden',display:'none'}); 
            
            btnEventFeedback=$(".event-feedback");
            btnEventFeedback.on('click',function(evt){
                eventid=$(this).attr('event-id');
                
            });             
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
    
    btnSubmitSuggestion.on('click',function(evt){
       formSuggest.ajaxSubmit({url:'admin/scripts/php/suggest.php',success:function(response){
            response=jQuery.parseJSON(response);
            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});                                                         
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});                             
        }});
    });
    
    btnSubmitFeedback.on('click',function(evt){
        formEventFeedback.ajaxSubmit({url:'admin/scripts/php/feedback.php',data:{id:eventid},success:function(response){
            response=jQuery.parseJSON(response);
            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});                                                         
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});                             
        }});
    });
    
    btnSubmitSubscribe.on('click',function(evt){
       formSubscribe.ajaxSubmit({url:'admin/scripts/php/subscribe.php',success:function(response){
           response=jQuery.parseJSON(response);
           $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});                                                                    
       },error:function(){
           $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});                                        
       }});
    });
     
});