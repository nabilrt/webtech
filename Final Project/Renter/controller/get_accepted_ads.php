<?php

include_once '../model/Model.php';

class getAcceptedAds{
    
    function getA_Ads($id){

        return fetch_accepted_ads($id);
    }
}

?>