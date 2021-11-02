<?php

require_once '../model/model.php';

class getAds
{
    public $message = "";

    function getTheAds($data)
    {
        return fetchAds($data);
    }
}
?>
