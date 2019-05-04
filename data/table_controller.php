<?php

$name_file = hash('ripemd160', $_POST["form_info"]);
$fp = fopen($name_file.'.json', 'a+');
fwrite($fp, $_POST["form_data"]."\n");
fclose($fp);

?>