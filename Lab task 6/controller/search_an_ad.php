<?php
require_once '../model/model.php';

class Search{
    function searchAd($id){
        try{
            return searchUser($id);
        }catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

?>