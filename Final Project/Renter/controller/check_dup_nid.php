<?php
require_once '../model/Model.php';

$nid=$_GET['nid'];

if(dupHNID($nid) || dupRNID($nid) || dupMNID($nid)){

    echo "true";
}

else{
    echo "false";
}



?>