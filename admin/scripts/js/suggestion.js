$(function(){
   var suggestNotification=$("#suggest-notification");
   var replySuggest={};
   var txtReply=$("#txt-reply-suggest");
   var btnReplySuggest=$("#btn-reply-suggest");
   var replyid=0;
   var replyCount=$("#reply-count");
   var clearSuggestions={};
   
   
    function loadSuggestion(){
         $.ajax({url:'scripts/php/getsuggestion.php',method:'POST',success:function(response){
            response=jQuery.parseJSON(response);
            if(!response.error){
                suggestNotification.html(response.html);
                if(response.count!=0){
                    replyCount.text(response.count);      
                    replySuggest=$(".reply-suggest");
                    clearSuggestions=$("#clear-suggestions");
                    clearSuggestions.on('click',function(evt){
                        evt.preventDefault();
                        $.ajax({url:'scripts/php/clearsuggestions.php',success:function(response){
                            response=jQuery.parseJSON(response);
                            if(!response.error){
                                loadSuggestion();
                            }
                            else{
                                $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});                                  
                            }                                                        
                        },error:function(){
                            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});                                        
                        }});
                    });
                    replySuggest.on('click',function(evt){
                        evt.preventDefault();
                        replyid=$(this).attr('record-id');
                    });          
                }
                else{
                    replyCount.css({visibility:'hidden'});
                    suggestNotification.html("<li><a href='#'>No new suggestions</a></li>");
                }
            }
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});            
        }});
    
    }
    
    loadSuggestion();
    
    btnReplySuggest.on('click',function(evt){
        var reply=txtReply.val();
        $.ajax({url:'scripts/php/replysuggestion.php',method:'POST',data:{id:replyid,message:reply},success:function(response){
            alert(response);
            response=jQuery.parseJSON(response);
            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});  
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});                        
        }});
    });
   
});