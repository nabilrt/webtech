<?php

include_once '../model/model.php';

class getRentData{

    function get_Data($ad_id){

        return get_ad_details($ad_id);
    }
}

?>