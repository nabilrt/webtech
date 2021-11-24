<?php

include_once '../model/model.php';

class EditMessage {

    function edit_msg($data){

        if(editMessage($data)){

            header('Location:../view/chatting.php');
        }
    }
}

?>