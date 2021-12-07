<?php

include_once '../model/model.php';

class getChats{

    function get_the_chats($data){
    
        return fetchChats($data);
    
    }
}

?>