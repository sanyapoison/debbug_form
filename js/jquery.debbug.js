function data_debbug_serial(this_form, form_method){
    try{
        var error_get_form_data = false;
        var error_get_form_attr = false;
        
        try{
            var form_data = $(this_form).serializeArray();
            var form_data_convert = {}
            $(form_data).each(function () {
                var name_attr = this.name;
                var value_attr = this.value;
                form_data_convert[name_attr] = value_attr;                 
            });
        }
        catch(e){
            console.log("error_debbug_form_data");
            console.log(e);            
            error_get_form_data = true;
        }
        
        try{        
            var form_attr = {};
            $(this_form).each(function () {
                $(this.attributes).each(function (index) {
                    var name_attr = this.name;
                    var value_attr = this.value;
                    form_attr[name_attr] = value_attr;
                });   
            });
        }
        catch(e){
            console.log("error_debbug_form_attr");
            console.log(e);
            error_get_form_attr = true;            
        }        
        
        if(!error_get_form_data && !error_get_form_attr){        
            var form_attr_json = JSON.stringify(form_attr);
            var form_data_convert_json = JSON.stringify(form_data_convert);
            
            $.ajax({
                type: "POST",    
                url: "/bitrix/admin/debbug/data/table_controller.php",    
                data: {form_info: form_attr_json, form_data: form_data_convert_json},
                success: function (data) {
                    console.log("complete");     
                    switch(form_method){
                        case "submit":
                            try{   
                                $(this_form).submit();
                                console.log("data_debbug_submit");   
                                console.log(data);    
                            }
                            catch(e){
                                console.log("error_debbug_submit");
                                console.log(e);                           
                            }                            
                        break;
                            
                        case "ajax":  
                            console.log("data_debbug_complete");
                            console.log(data);
                        break;

                        default:
                            console.log("data_debbug_complete");
                            console.log("data_debbug_form_method_error");
                            console.log(data);                        
                        break;        
                    }                                       
                } 
            });
            
        }
        else{
            console.log("error_debbug_data");
            console.log(e);            
        }
        
    }
    catch(e){
        console.log("error_debbug_data");
        console.log(e);
    }
}