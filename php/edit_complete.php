<?php
    include "connect_db.php";    
    $sql = "UPDATE 
                anketa 
            SET 
                fio='"                          .$_POST["fio"]."', 
                pol='"                          .$_POST["pol"]."', 
                data_rogdenia='"                .$_POST["data_rogdenia"]."', 
                mesto_rogdenia='"               .$_POST["mesto_rogdenia"]."', 
                telefon='"                      .$_POST["telefon"]."', 
                obrazovanie='"                  .$_POST["obrazovanie"]."', 
                nomer_strahovogo_svidetelstva='".$_POST["nomer_strahovogo_svidetelstva"]."', 
                INN='"                          .$_POST["INN"]."', 
                dannie_truduvoi_knigki='"       .$_POST["dannie_truduvoi_knigki"]."', 
                dannie_pasporta='"              .$_POST["dannie_pasporta"]."', 
                typ_dolgnosty='"                .$_POST["typ_dolgnosty"]."', 
                dolgnost='"                     .$_POST["dolgnost"]."', 
                stavka='"                       .$_POST["stavka"]."', 
                oklad='"                        .$_POST["oklad"]."', 
                nomer_prikaza='"                .$_POST["nomer_prikaza"]."' 
                
            WHERE 
                anketaID='".$_POST["id_sotrudnika"]."';";
    mysql_query($sql) or die (mysql_error());   
    header("Location: list_sotrudnikov.php");
    exit;
?>