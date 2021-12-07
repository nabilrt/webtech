<?php

include_once '../model/Model.php';

$a_id=$_REQUEST['id'];

//function getD($a_id){

    $details=get_basha_details($a_id);
    $a_rent=$details['Rent'];
    $r_i=$details['Owner_ID'];

    $res=array("$r_i","$a_rent");
    $m_json=json_encode($res);
    echo $m_json;

//}

?>