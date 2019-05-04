<html>
    <head>
        <title>Лист сотрудников</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    
    <body>
        <?php
            include "auth.php";       
            include "function.php";
            
            print_navigation();
            
            if(isset($_GET["mod_edit"]))
            {
                if($_GET["mod_edit"] == "delete")
                {
                    delete_sotrudnik($_GET["id_sotrudnika"]);                    
                }    
                
                if($_GET["mod_edit"] == "edit")
                {
                    edit_sotrudnik($_GET["id_sotrudnika"]);                    
                } 
            }    
            else
            {
                print_list_sotrudnikov();
            }
        ?>
    </body>
</html>
