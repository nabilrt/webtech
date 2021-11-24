<?php

include_once '../model/model.php';

$a_id=$_REQUEST['id'];

//function getD($a_id){

    $details=get_basha_details($a_id);
    
    echo $details;

//}

?>