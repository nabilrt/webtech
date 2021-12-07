<?php

include_once '../model/Model.php';

class getADDetails{

    function get_details($id){

        return fetch_chat_details($id);
    }
}

?>