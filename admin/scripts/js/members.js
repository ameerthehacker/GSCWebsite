$(function(){
    var tableMembers=$("#table-members");
    var formAddMember=$("#form-add-member");
    var formEditMember=$("#form-edit-member");    
    var btnAddMember=$("#btn-add-member");
    var btnSaveMember=$("#btn-save-member");
    var btnRemoveMember=$("#btn-remove-member");
    var btnExportWord=$("#btn-export-word");
    var btnExportExcel=$("#btn-export-excel");
    var btnLogout=$("#btn-logout");
    var modalEditMember=$("#modal-edit-member");
    var modalAddMember=$("#modal-inserty-member");
    var member=$("tr");
    var memberid=0;
    
    formEditMember.ajaxForm();
    
    member.on('dblclick',function(evt){
        memberid=$(this).attr('record-id');
        var fields=[];
        $(this).children(".field").each(function(){
            fields.push($(this).text());
        });
        $("#member-designation").children('option').each(function(){
            if($(this).text()==fields[0]){
                $(this).attr('selected','selected');
            } 
        });         
        $("#member-name").val(fields[1]); 
        $("#member-class").val(fields[2]); 
        $("#member-email").val(fields[3]);         
        modalEditMember.modal('show');      
    });

    btnLogout.on('click',function(evt){
        evt.preventDefault();
        $.ajax({url:'./logout.php',success:function(response){
            window.location="./index.php";
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});
        }});
    });
    
    formAddMember.ajaxForm();
    
    btnAddMember.on('click',function(evt){
        formAddMember.ajaxSubmit({url:'scripts/php/addmember.php',method:'POST',data:{edit:true},success:function(response){
            response=jQuery.parseJSON(response);            
            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});   
            modalAddMember.modal('hide');
            if(!response.error){
                setTimeout(function(){
                    window.location.reload(true);
                },2000);
            }
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'}); 
        }});
    });
    
    btnSaveMember.on('click',function(evt){
        formEditMember.ajaxSubmit({url:'scripts/php/addmember.php',method:'POST',data:{id:memberid,edit:true},success:function(response){
            response=jQuery.parseJSON(response);
            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});   
            modalEditMember.modal('hide');
            if(!response.error){
                setTimeout(function(){
                    window.location.reload(true);
                },2000);
            }
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'}); 
        }}); 
    });
    
    btnExportWord.on('click',function(){
        $.download('scripts/php/export/word_excel.php',{tableName:'members',type:'word'});
    });
    
    btnExportExcel.on('click',function(){
        $.download('scripts/php/export/word_excel.php',{tableName:'members',type:'excel'});        
    });
    
    btnRemoveMember.on('click',function(){
       var checked=[];
       $('.table-checkbox').each(function(){
          if($(this).is(" :checked")){
              checked.push($(this).attr('field-id'));
          } 
       });
       $.ajax({url:'scripts/php/deletemember.php',method:'POST',data:{'checked':checked},success:function(response){
            response=jQuery.parseJSON(response);
            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'});   
            if(!response.error){
                setTimeout(function(){
                    window.location.reload(true);
                },2000);
            }
       },error:function(){
           $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});            
       }});
    });
    
    
    tableMembers.DataTable({
       columnDefs:[{
           targets:[ 1 ],
           visible:false,
           searchable:false,
       }] 
    });
});