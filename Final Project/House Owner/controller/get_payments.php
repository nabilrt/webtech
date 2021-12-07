<?php

include_once '../model/model.php';

class getPayments{

    function get_pays($id){

        return pay_details($id);
    }
}



?>