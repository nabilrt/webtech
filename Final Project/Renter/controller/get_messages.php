<?php
include_once '../model/Model.php';

class getMessages{


    function get_msg($id){

        return fetch_messages($id);
    }

}

?>