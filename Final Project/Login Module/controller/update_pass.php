<?php
include_once '../model/model.php';

$mail=$_REQUEST["mail"];
$pass=$_REQUEST["pass"];

if(checkDupEmail($mail)){

    if(updateOPassword($mail,$pass)){

        echo "true";
    }
}
else if(dupREmail($mail)){

    if(updateRPassword($mail,$pass)){
        echo "true";
    }
}
else if(dupMEmail($mail)){

    if(updateMPassword($mail,$pass)){
        echo "true";
    }
}
else{

    echo "false";
}


?>