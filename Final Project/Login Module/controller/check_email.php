<?php
require_once '../model/model.php';

$mail=$_REQUEST['mail'];

if(checkDupEmail($mail) || dupREmail($mail) || dupMEmail($mail)){

    echo "true";
}

else{
    echo "false";
}



?>