<?php
require_once '../model/model.php';

$nid=$_GET['nid'];

if(dupHNID($nid) || dupRNID($nid)){

    echo "true";
}

else{
    echo "false";
}



?>