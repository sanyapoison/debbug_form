<?php
include "auth.php";     
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Debbug</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>        
    </head>
    
    <body>
        <?php              
            include "php/function.php";            
            print_navigation("home");            
        ?>
        
        <div class="container">
            <div class="row">
                <h1>Все таблицы</h1>
                <div role="tabpanel">
                    <div class="col-sm-2">
                        <ul class="nav nav-pills nav-stacked" role="tablist">
                            <li role="presentation" class="brand-nav active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Lorem ipsum</a></li>
                            <li role="presentation" class="brand-nav"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Zombie ipsum</a></li>
                            <li role="presentation" class="brand-nav"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Gansta ipsum</a></li>
                            <li role="presentation" class="brand-nav"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Corporate ipsum</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-8">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt feugiat lorem, at ornare tellus faucibus ut.
                                    Curabitur eget metus dapibus nibh laoreet lacinia eget id metus. Mauris quis convallis elit, ac convallis augue. 
                                    Pellentesque ornare cursus nibh quis fermentum. Morbi faucibus at tortor sed volutpat. Etiam at ex molestie turpis aliquam auctor.
                                    Nulla consequat tristique augue, vel venenatis massa fringilla sit amet. Morbi egestas turpis facilisis sem faucibus finibus.
                                </p>
                                <p>
                                    Nam sodales magna eget nulla interdum gravida. Aenean cursus magna vel lorem eleifend, vel eleifend massa rhoncus. 
                                    Duis accumsan vehicula ultricies. Proin tincidunt blandit congue. Curabitur semper odio ut malesuada dapibus.
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab2">
                                <p>
                                    Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. 
                                    Summus brains sit, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris.
                                    Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium.
                                    Qui animated corpse, cricket bat max brucks terribilem incessu zomby. 
                                </p>
                                <p>
                                    The voodoo sacerdos flesh eater, suscitat mortuos comedere 
                                    carnem virus. Zonbi tattered for solum oculi eorum defunctis go lum cerebro. Nescio brains an Undead zombies. 
                                    Sicut malus putrid voodoo horror. Nigh tofth eliv ingdead.
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab3">
                                <p>
                                    Lorem ipsizzle dolor away amizzle, consectetuer pizzle elizzle. Nullizzle yo velizzle, check it out volutpizzle, quis, gravida vel, yo.
                                    Ma nizzle eget tortor. Sizzle eros. My shizz izzle dolizzle gizzle turpis tempizzle fo shizzle mah nizzle fo rizzle, mah home g-dizzle.
                                    Maurizzle pellentesque nibh izzle own yo'. Check it out in tortor. Pellentesque fizzle rhoncizzle nisi. 
                                </p>
                                <p>
                                    In hac habitasse platea dictumst. Shizzlin dizzle dapibus. You son of a bizzle tellizzle urna, pretizzle fo shizzle mah nizzle fo rizzle, mah home g-dizzle,
                                    ghetto ac, check it out vitae, nunc. Shizzlin dizzle suscipizzle. Integizzle sempizzle velit sizzle dizzle.
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab4">
                                <p>
                                    Collaboratively administrate empowered markets via plug-and-play networks. 
                                    Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without 
                                    revolutionary ROI.
                                </p>
                                <p>
                                    Efficiently unleash cross-media information without cross-media value. 
                                    Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar 
                                    solutions without functional solutions.
                                </p>
                                <p>
                                    Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate 
                                    one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service 
                                    for state of the art customer service.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
        
    </body>
</html>
