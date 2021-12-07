<?php
require_once '../model/Model.php';

$mail=$_REQUEST['mail'];

if(checkDupEmail($mail) || checkDupHEmail($mail) || dupMEmail($mail)){

    echo "true";
}

else{
    echo "false";
}



?>