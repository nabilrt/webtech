<?php
require_once '../model/Model.php';
class getrent{

    function fetchrent($RNo){
       return fetchpayment($RNo);
    }
}

?>