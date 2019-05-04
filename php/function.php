<?php           
    // навигация
    function print_navigation($active_page)
    {?>
            <nav class="navbar navbar-default no-margin">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                      <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <ul class="nav navbar-nav">
                            <li class="active" ><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon glyphicon-th-list" aria-hidden="true"></span></button></li>
                        </ul>
                        Debbuger 
                    </a>
                </div><!-- navbar-header-->
            </nav>
            <div id="wrapper" class="toggled-2">
                <!-- Sidebar -->
                <div id="sidebar-wrapper">
                    <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                        <li <?php if($active_page == "home"){ echo 'class="active"';} ?> > 
                            <a href="index.php"><span class="glyphicon glyphicon-home"></span>Главная</a> 
                        </li>
                        <li <?php if($active_page == "set"){ echo 'class="active"';} ?> > 
                            <a href="settings.php"><span class="glyphicon glyphicon-cog"></span>Настройки</a></li>
                        <li>
                            <a href="index.php?do=logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>Выход</a>
                        </li>     
                    </ul>
                </div><!-- /#sidebar-wrapper -->
                <!-- /#page-content-wrapper -->
            </div>

            <script type="text/javascript" src="js/menu.js"></script>
        <?php
    }
             
?>