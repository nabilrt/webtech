<?php
include '../model/model.php';
class addHouseOwner
{
  public $error = array(
    'nameErr' => "",
    'emailErr' => "",
    'passwordErr' => "",
    'confirm_passwordErr' => "",
    'nidErr' => "",
    'genderErr' => "",
  );
  public $message = "";

  function addData($data)
  {
    if (empty($data["Name"])) {
      $this->error["nameErr"] = "Name is required";
    } else {
      if ((str_word_count($data["Name"])) < 2) {
        $this->error["nameErr"] = "The name must have at least two word";
      } else {
        if ((preg_match("/[A-Za-z]/", $data["Name"][0])) == 0) {
          $this->error["nameErr"] = "The name must have start with litter";
        } else {
          if (preg_match('/^[A-Za-z\s._-]+$/', $data["Name"]) !== 1) {
            $this->error["nameErr"] = "Name can contain letter,dash,dot and space";
          }
        }
      }
    }

    if (empty($data["Email"])) {
      $this->error["emailErr"] = "Email is required";
    } else {
      if (!filter_var($data["Email"], FILTER_VALIDATE_EMAIL)) {
        $this->error["emailErr"] = "Invalid email format";
      }
      if(checkEmail($data)){
        $this->error["emailErr"] = "Email already exists";
      }
    }

    if (empty($data["Password"])) {
      $this->error["passwordErr"] = "Password Cannot be Empty";
    } else if (strlen($data["Password"]) < 8) {
      $this->error["passwordErr"] = "Your Password Must Contain At Least 8 Digits !";
    } elseif (!preg_match("#[0-9]+#", $data["Password"])) {
      $this->error["passwordErr"] = "Your Password Must Contain At Least 1 Number !";
    } elseif (!preg_match("#[a-z]+#", $data["Password"])) {
      $this->error["passwordErr"] = "Your Password Must Contain At Least 1 Lowercase Letter !";
    } elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $data["Password"])) {
      $this->error["passwordErr"] = "Your Password Must Contain At Least 1 Special Character !";
    }

    if (empty($data["Confirm_Password"])) {
      $this->error["confirm_passwordErr"] = "Confirm Password is required";
    } else {
      if (strcmp($data["Password"], $data["Confirm_Password"]) !== 0) {
        $this->error["confirm_passwordErr"] = "Password are not matched";
      }
    }

    if (empty($data["NID"])) {
      $this->error["nidErr"] = "NID required";
    } else {
      if (strlen($data["NID"]) != 10) {
        $this->error["nidErr"] = "NID Must be 10 Numbers";
      }
      if (!is_numeric($data["NID"])) {
        $this->error["nidErr"] = "NID Must only consists of number";
      }
      if(checkNID($data)){
        $this->error["nidErr"] = "NID Already Exist";
      }
      
    }

    if (empty($data["Gender"])) {
      $this->error["genderErr"] = "Gender is required";
    }

    if (empty($this->error["nameErr"]) && empty($this->error["emailErr"]) && empty($this->error["nidErr"]) && empty($this->error["passwordErr"]) && empty($this->error["confirm_passwordErr"]) && empty($this->error["genderErr"])) {

      if (addHouseOwners($data)) {
        $this->message = "Registration Successful";
      } else {
        $this->message = "Unable to do Registration";
      }
    }
  }

  function get_error()
  {
    return $this->error;
  }

  function get_message()
  {
    return $this->message;
  }
}
?>
