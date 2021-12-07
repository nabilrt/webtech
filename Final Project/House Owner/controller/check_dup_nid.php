<?php
require_once '../model/model.php';

$nid=$_REQUEST['nid'];

if(dupHNID($nid) || dupRNID($nid) || dupMNID($nid)){

    echo "true";
}

else{
    echo "false";
}



?>