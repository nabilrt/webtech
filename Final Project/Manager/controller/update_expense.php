<?php

include_once '../model/model.php';

function update_Exp($data){

    if(update_expense($data)){

        header('Location:../view/manage_expense.php');
    }
}




?>