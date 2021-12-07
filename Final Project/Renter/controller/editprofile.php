<?php
include_once '../model/Model.php';

class editData{
    public $error=array(
        'nameError'=>"",
        'emailError' =>"",
        'passError'=>"",
        'cpasswordError'=>"",
        'genderError' =>""
        
        
    );
    public $message="";
  
    function edit($data)
    {
      if (empty($data["name"])) {
          $this-> error["nameError"] = "Name is required";
      } else {
          if ((str_word_count($data["name"])) < 2) {
            $this-> error["nameError"] = "Name must have at least two word";
          } else {
              if ((preg_match("/[A-Za-z]/", $data["name"][0])) == 0) {
                $this-> error["nameError"] = "Name have to start with litter";
              } else {
                  if (preg_match('/^[A-Za-z\s._-]+$/', $data["name"]) !== 1) {
                    $this-> error["nameError"] = "Name can contain letter,desh,dot and space";
                  }
              }
          }
      }
  
      if (empty($data["email"])) {
        $this-> error["emailError"] = "Email is required";
      } else {
          if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this-> error["emailError"] = "Invalid email format";
          }
      }
  
      if (empty($data["pass"])) {
        $this-> error["passError"] = "Password is required";
      } else {
          if (strlen($data["pass"]) < 8) {
            $this-> error["passError"] = "Password must contain at least 8 character";
          } else {
  
              if (preg_match('/[#$%@]/', $data["pass"]) !== 1) {
                $this-> error["passError"] = "Password have to contain at least one '#' or '$' or '%' or '@'";
              }
          }
      }
  
      if (empty($data["Cpass"])) {
        $this-> error["cpasswordError"] = "Confirm Password is required";
      } else {
          if (strcmp($data["pass"], $data["Cpass"]) !== 0) {
            $this-> error["cpasswordError"] = "Confirm Password must be matched with password ";
          }
      }
  
      if (empty($data["gender"])){
        $this-> error["genderError"] = "Gender is required";
      }
      

      if(empty($this-> error["nameError"]) && empty($this-> error["emailError"]) &&  empty($this-> error["passError"]) && empty($this-> error["cpasswordError"]) && empty($this-> error["genderError"]))
      {
        if(editUserInfo($data)){
            $this->message="Profile has been updated";
        }
        else{
            $this->message="Profile has not been updated";
        }
      }
  
    }

    function get_error(){
        return $this -> error;
    }

    function get_message(){
        return $this -> message;
    }
}

?>