<?php
session_start();

if(isset($_SESSION['admin']))
{
	header("Location: index.php");
	exit;
}

$admin = 'admin';
$pass = 'admin';
$error = false;
if(isset($_POST['submit']))
{	
    #if($admin == $_POST['user'] AND $pass == md5($_POST['pass'])){
	if($admin == $_POST['user'] and $pass == $_POST['pass'])
    {
		$_SESSION['admin'] = $admin;
		header("Location: index.php");
		exit;
	}
    else{ 
        $error = true;
    }
}
?>

<html>
    <head>
        <title>Debbug</title>
        <link rel="stylesheet" type="text/css" href="css/auth_form.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>          
    </head>
    
    <body>
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-wrap">
                            <h1>Войти в отладочный раздел</h1>
                            <form method="post" id="form_login" name="auth_form">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Логин</label>
                                    <input type="text" name="user" id="form_login_name" class="form-control" placeholder="Логин">
                                </div>
                                <div class="form-group">
                                    <label for="key" class="sr-only">Пароль</label>
                                    <input type="password" name="pass" class="form-control" placeholder="Пароль" id="form_login_pass">
                                </div>
     
                                <input type="submit" name="submit" value="Войти" id="form_login_submit" class="btn btn-custom btn-lg btn-block">
                            </form>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section> 

        <?php
        if($error){
            ?>
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body">
                                <p style="color: red; text-align: center; font-size: 20px; padding-top:10px;">Логин или пароль неверны!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>            
            
                <script type="text/javascript">
                    $(document).on('ready', function(){ 
                        $("#myModal").modal("show"); 
                    });
                </script>            
            <?php
        }
        ?>
        
        <script type="text/javascript">
        $("#form_login").submit(function(){  
            alert('отправил!');
            submit();
            return false;
        });
        </script>
    </body>
</html>        