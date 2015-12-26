$(function(){
    var eventContainer=$("#event-container"); 
    var eventCount=10;
    var eventLoaded=true;
    var totalEvents=0;
    var eventLoading=$("#event-loading");
    var btnDeleteEvent={};
    var btnEditEvent={};
    var eventImage=$("#event-image");
    var imageFile=$("#image-file");
    var btnBrowseImage=$("#btn-browse-image");
    var formEditEvent=$("#form-edit-event");
    var editEventLoader=$("#edit-event-loader");
    var btnSaveEvent=$("#btn-save-event");
    var eventProgress=$("#event-progress");
    
    //Ajax to get events 
    
    function displayEvents(count){
        eventLoaded=false;
        $.ajax({url:'scripts/php/events.php',method:'POST',data:{no:eventCount,admin:true},beforeSend:function(){
            eventLoading.css({visibility:'visible',display:'block'});
        },success:function(response){
            response=jQuery.parseJSON(response);
            if(response.html){
                eventContainer.html(response.html);
                totalEvents=response.count;
                eventLoaded=true;
                eventLoading.css({visibility:'hidden',display:'none'}); 
                btnDeleteEvent=$(".delete-event");         
                btnDeleteEvent.on('click',function(evt){
                    evt.preventDefault();
                    $.ajax({url:'scripts/php/delete.php',method:'POST',data:{id:$(this).attr('event-id')},success:function(response){
                        response=jQuery.parseJSON(response);
                        if(response.error){
                            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});                                         
                        }
                        else{
                            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'}); 
                            displayEvents(eventCount);                                                                    
                        }                        
                    },error:function(){
                        $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'}); 
                    }});
                });
                  
                btnEditEvent=$(".edit-event");
                btnEditEvent.on('click',function(evt){
                    formEditEvent.css({visibility:'hidden',display:'none'});
                    editEventLoader.css({visibility:'visible',display:'block'});
                    $.ajax({url:'scripts/php/details.php',method:'POST',data:{id:$(this).attr('event-id')},success:function(response){
                        response=jQuery.parseJSON(response);
                        jQuery.each(response,function(index,value){
                           $("#"+index).val(value);
                        });
                        eventImage.attr('src','scripts/php/photo.php?id='+response.id);
                        editEventLoader.css({visibility:'hidden',display:'none'});
                        formEditEvent.css({visibility:'visible',display:'block'});   
                        btnSaveEvent.on('click',function(){
                           formEditEvent.ajaxForm();
                           formEditEvent.ajaxSubmit({url:'scripts/php/post.php',data:{id:response.id,edit:true},beforeSend:function(){
                               eventProgress.css({vsisibility:'visible',display:'block'});
                               eventProgress.children().css({width:"0%"});
                           },
                           success:function(response){
                               response=jQuery.parseJSON(response);
                               eventProgress.css({vsisibility:'hidden',display:'none'});
                               $.growl({title:response.title,message:response.message,style:response.style,location:'tc'}); 
                           },uploadProgress:function(evt,pos,total,per){
                               eventProgress.children().css({width:per+"%"});
                           },error:function(){
                               eventProgress.css({vsisibility:'hidden',display:'none'});                               
                               $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});                                
                           }});
                        });                     
                        
                    },error:function(){
                        $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});                         
                    }});
                });  
                 
            }
            else{
                $.growl({title:"Internal Error!",message:'Unable to get events',style:'error',location:'tc'});             
            }
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'}); 
        }});
    }
    
    displayEvents(eventCount);
    
    //Ajax to get new events on scroll
    
    $(window).scroll(function(){ 
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollPosition-scrollHeight) / scrollHeight > 0.9) {
            if(eventLoaded && eventCount<=totalEvents){
                eventCount+=10;
                displayEvents(eventCount);
            }
        }
    });
    
    btnBrowseImage.on('click',function(evt){
       imageFile.trigger('click'); 
    });
    
    imageFile.on('change',function(evt){
       if(this.files&&this.files[0]){
           var reader = new FileReader();
           reader.onload=function(evt){
               eventImage.attr('src',evt.target.result);
           }   
           reader.readAsDataURL(this.files[0]);
       }     
    });
    
});