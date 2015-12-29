$(function(){
   var btnLogout=$("#btn-logout");
   var imageFile=$('#image-file');
   var eventImage=$("#event-image")
   var btnBrowseImage=$("#btn-browse-image");
   var formNewEvent=$("#form-new-event");
   var btnPostEvent=$("#btn-post-event");
   var eventProgress=$("#event-progress");
   var checkboxMembers=$(".checkbox-members");
   var txtOrganizers=$("#txt-organizers");
   
   formNewEvent.ajaxForm();
   
   txtOrganizers.on('keypress',function(evt){
      evt.preventDefault(); 
   });
   btnLogout.on('click',function(evt){
       evt.preventDefault();
       $.ajax({url:'./logout.php',success:function(response){
           window.location="./index.php";
       },error:function(){
           $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});
       }});
   });
   btnBrowseImage.on('click',function(evt){
      imageFile.trigger('click'); 
   });
   imageFile.on('change',function(evt){
       var image=new FileReader();
       if(this.files && this.files[0]){
           image.readAsDataURL(this.files[0]);
       }
       image.onload=function(evt){
           eventImage.attr('src',evt.target.result);           
       }
   });
   btnPostEvent.on('click',function(evt){
      formNewEvent.ajaxSubmit({url:'scripts/php/post.php',data:{edit:false},success:function(response){
          response=jQuery.parseJSON(response);
          $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});
      },beforeSubmit:function(){
          eventProgress.css({visibility:'visible',display:'block'});
          eventProgress.children().css({width:"0%"});          
      },uploadProgress:function(evt,pos,total,per){
          eventProgress.children().css({width:per+"%"});
      },complete:function(){
          eventProgress.css({visibility:'hidden',display:'none'});          
      }}); 
   });
   
   checkboxMembers.on('change',function(evt){
       var organizers="";
       checkboxMembers.each(function(){
           if($(this).is(" :checked")){
               if(organizers==""){
                    organizers=$(this).attr('value');
                }
                else{
                    organizers+=","+$(this).attr('value');               
                }
           }
       }); 
       txtOrganizers.val(organizers);
   });
});