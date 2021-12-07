<?php
include_once '../model/model.php';

function check_rented($id){

    return rented_count($id);
}

?>