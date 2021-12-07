<?php
require_once '../model/Model.php';

class getNotices{

    public $message="";

    function getTheNotices($data){
        return fetchNotices($data);
    }


}


?>