<?php
include "auth.php";     
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Debbug settings</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>        
        <script type="text/javascript" src="js/menu.js"></script>
    </head>
    
    <body>
        <?php              
            include "php/function.php";            
            print_navigation("set");            
        ?>
    </body>
</html>