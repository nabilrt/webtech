<?php
include '../model/Model.php';

class getDataFromFile{

    public $message="";
    public $error="";

    function checkFromFiles($data){
        return getUserInfo($data);
    }

    function get_error(){
        return $this -> error;
    }

    function get_message(){
        return $this -> message;
    }

}

?>