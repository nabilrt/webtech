<?php
include_once '../model/model.php';
class login{
    public $Error=array(
        'nidErr'=>"",
        'passwordErr'=>""
    );
    public $message="";
    public $error="";
    function check_login($data){
        if(empty($data["NID"])){
            $this->Error["nidErr"]="This Field Cannot Be Empty";
        }

        if(empty($data["Password"])){
            $this->Error["passwordErr"]="This Field Cannot Be Empty";
        }

          if(empty($this->Error["nidErr"]) && empty($this->Error["passwordErr"])){
             if(checkLogin($data)){
                 $this->message ="Login Successful";
             }
             else{
                 $this->err_message="NID and Password does not match";
             }
          }else{
            $this->err_message="";
          }
    }

    public $err_message="";

    function get_error(){
        return $this -> Error;
    }

    function get_message(){
        return $this -> message;
    }

    function error_message(){
        return $this->err_message;
    }
}
?>