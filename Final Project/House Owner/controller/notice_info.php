<?php
require_once '../model/model.php';

class getNotices{

    public $message="";

    function getTheNotices($data){
        return fetchNotices($data);
    }


}


?>