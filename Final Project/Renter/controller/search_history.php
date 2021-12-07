<?php
require_once '../model/Model.php';

class Search{
    function searchpay($id){
        try{
            return search_payment($id);
        }catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

?>