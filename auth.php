<?php
session_start();

if(isset($_GET['do']))
{
    if($_GET['do'] == 'logout')
    {
        unset($_SESSION['admin']);
        session_destroy();
    }
}
    
if(!$_SESSION['admin'])
{
	header("Location: enter.php");
	exit;
}
?>