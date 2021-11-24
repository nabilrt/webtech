<?php

include_once '../model/model.php';

class ConfirmRenter{

    function confirm_renter($data){

        if(add_renter($data)){

            header('Location:../view/manage_rents.php');

        }
    }
}


?>