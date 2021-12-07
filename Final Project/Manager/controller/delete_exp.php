<?php 
include_once '../model/model.php';

$id=$_GET['id'];

if(delete_expense($id)){

    header('Location:../view/manage_expense.php');
}


?>