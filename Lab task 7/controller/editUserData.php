<?php
include_once '../model/model.php';

class editData
{
  public $error = array(
    'nameErr' => "",
    'emailErr' => "",
    'passwordErr' => "",
    'confirm_passwordErr' => "",
    'genderErr' => ""
  );
  public $message = "";

  function edit($data)
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
            $this->error["nameErr"] = "Name can contain letter,desh,dot and space";
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
    }


    if (empty($data["Password"])) {
      $this->error["passwordErr"] = "Password Cannot be Empty";
    } else if (strlen($data["Password"]) < 8) {
      $this->error["passwordErr"] = "Your Password Must Contain At Least 8 Digits !";
    } else if (!preg_match("#[0-9]+#", $data["Password"])) {
      $this->error["passwordErr"] = "Your Password Must Contain At Least 1 Number !";
    } else if (!preg_match("#[a-z]+#", $data["Password"])) {
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

    if (empty($data["Gender"])) {
      $this->error["genderErr"] = "Gender is required";
    }

    if (empty($this->error["nameErr"]) && empty($this->error["emailErr"]) &&  empty($this->error["passwordErr"]) && empty($this->error["confirm_passwordErr"]) && empty($this->error["genderErr"])) {
      if (editUserInfo($data)) {
        $this->message = "Profile Updated";
      } else {
        $this->message = "Unable to update profile";
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
