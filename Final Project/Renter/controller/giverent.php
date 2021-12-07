<?php
require_once '../model/Model.php';

class giveNotice{

    public $message="";

    function g_notice($data){
        if(give_rent($data)){
            $this->message="Rent paid Successfully";
        }
        else{
            $this->message="Unable to pay";
        }
    }

    function get_message(){
        return $this -> message;
    }


}


?>