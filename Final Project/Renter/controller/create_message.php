<?php
include_once '../model/Model.php';

class CMessage{

    function create($data){

        if(send_message($data)){
            
            header("location:../view/chat.php");
        }
    }
}



?>