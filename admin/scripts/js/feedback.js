$(function(){
    
    var tableFeedback=$("#table-feedback");
    var tableName=tableFeedback.attr('table-name');
    var btnDelete=$("#btn-delete");
    var btnDeleteAll=$("#btn-delete-all");
    var tableCheckbox=$(".table-checkbox");
    var btnExportExcel=$("#btn-export-excel");
    var btnExportWord=$("#btn-export-word");
    var btnLogout=$("#btn-logout");
    
    btnLogout.on('click',function(evt){
        evt.preventDefault();
        $.ajax({url:'./logout.php',success:function(response){
            window.location="./index.php"
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'});
        }});
    });
    btnDelete.on('click',function(evt){
        var checked=[];
        tableCheckbox.each(function(){
            if($(this).is(' :checked')){
                checked.push($(this).attr('field-id'));                
            }
        });
        $.ajax({url:'scripts/php/deletefeedback.php',method:'POST',data:{'tableName':tableName,'checked':checked},success:function(response){
            response=jQuery.parseJSON(response);
            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'}); 
            if(!response.error){
                setTimeout(function() {
                    document.location.reload(true);
                }, 2000); 
            }            
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'}); 
        }});
    });
    btnDeleteAll.on('click',function(evt){
      evt.preventDefault();
      $.ajax({url:'scripts/php/deletefeedback.php',method:'POST',data:{'tableName':tableName,'all':true},success:function(response){
            response=jQuery.parseJSON(response);
            $.growl({title:response.title,message:response.message,style:response.style,location:'tc'}); 
            if(!response.error){
                setTimeout(function() {
                    document.location.reload(true);
                }, 2000); 
            }            
        },error:function(){
            $.growl({title:"Internal Error!",message:'Unable to perform a ajax request',style:'error',location:'tc'}); 
        }});
    });
    
    btnExportExcel.on('click',function(evt){
        evt.preventDefault();
        $.download('scripts/php/export/word_excel.php',{'tableName':tableName,type:'excel'});
    });
    
    btnExportWord.on('click',function(evt){
        evt.preventDefault();
        $.download('scripts/php/export/word_excel.php',{'tableName':tableName,type:'word'});
    });
    
    tableFeedback.DataTable({
        columnDefs:[{
            targets:[ 1 ],
            visible:false,
            searchable:false
        }]
    });
});