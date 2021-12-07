<?php

include_once '../model/model.php';

class getAcceptedAds{
    
    function getA_Ads($id){

        return fetch_accepted_ads($id);
    }
}

?>