try{
    
    $("#form_login_submit").click(function(){              
        data_debbug_serial("#form_login", "ajax");                
    });
    
}
catch(e){
    console.log("error_debbug_init");
    console.log(e);
}