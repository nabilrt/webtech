<?php

include_once '../model/Model.php';

class createRequest{

    function send_newMessage($data){

        if(send_new_message($data)){

            header("location:../view/chat.php");

        }
    }
}


?>