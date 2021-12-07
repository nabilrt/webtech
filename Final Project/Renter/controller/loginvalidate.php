<?php
include_once '../model/Model.php';
class login{
    public $Error=array(
        'nidErr'=>"",
        'passwordErr'=>""
    );
    public $message="";
    function check_login($data){
        if(empty($data["NID"])){
            $this->Error["nidErr"]="NID is required";
        }

        if(empty($data["Password"])){
            $this->Error["passwordErr"]="Password is required";
        }

          if(empty($this->Error["nidErr"]) && empty($this->Error["passwordErr"]))
          {
             if(checkLogin($data)){
                 $this->message ="Login Successful";
             }
             else{
                 $this->err_message="Login unsucccessful";
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