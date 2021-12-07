<?php

include_once '../model/Model.php';

$id=$_GET['id'];

$house=get_basha_details($id);

$o_id=$house["Owner_ID"];

if(delete_ren($id,$o_id)){

    header('Location:../view/rented_houses.php');
}


?>