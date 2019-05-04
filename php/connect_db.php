<?php
$db_connect = mysql_connect("localhost","root", "") or die("не удалось подключиться к серверу: " . mysql_error());
mysql_select_db("sport_complex") or die("Не удалось выбрать базу"); 
mysql_query("SET NAMES utf8"); 
?>