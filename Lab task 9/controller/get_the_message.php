<?php

include_once '../model/model.php';

class getMessage{

    function get_the_message($m_id){
       
        return fetch_a_message($m_id);
        
    }
    
}

?>