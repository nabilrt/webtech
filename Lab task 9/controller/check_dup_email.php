<?php
require_once '../model/model.php';

$mail=$_REQUEST['mail'];

if(checkDupEmail($mail)){

    echo "true";
}

else{
    echo "false";
}



?>