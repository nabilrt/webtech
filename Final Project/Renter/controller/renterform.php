<?php
include_once '../model/Model.php';
class renters
{
  public $error = array(
    'nameError' => "",
    'emailError' => "",
    'passError' => "",
    'cpassError' => "",
    'nidError' => "",
    'genderError' => "",
    'dobError' => "",

  );
  public $text = "";
  function addData($data)
  {
    if (empty($data["name"])) {
      $this->error["nameError"] = "Name is required";
    } else {

      if ((!preg_match("/^[a-zA-Z-'. ]*$/", $data["name"])) or (str_word_count($data["name"])) < 2) {
        $this->error["nameError"] = "Name has to be two words and Alphabets only";
      }
    }

    if (empty($data["email"])) {
      $this->error["emailError"]  = "Email is required";
    } else {


      if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $this->error["emailError"] = "Invalid Email !";
      }

      if (dupEmail($data)) {
        $this->error["emailError"] = "Email already exists";
      }
    }


    if (empty($data["gender"])) {
      $this->error["genderError"] = "Gender is required";
    }


    if (empty($data["pass"])) {
      $this->error["passError"]  = "Please enter password";
    } else {


      if (strlen($data["pass"]) < 8) {
        $this->error["passError"] = "Your Password Must Contain At Least 8 Digits !" . "<br>";
      } elseif (!preg_match("#[0-9]+#", $data["pass"])) {
        $this->error["passError"] = "Your Password Must Contain At Least 1 Number !" . "<br>";
      } elseif (!preg_match("#[A-Z]+#", $data["pass"])) {
        $this->error["passError"] = "Your Password Must Contain At Least 1 Capital Letter !" . "<br>";
      } elseif (!preg_match("#[a-z]+#", $data["pass"])) {
        $this->error["passError"] = "Your Password Must Contain At Least 1 Lowercase Letter !" . "<br>";
      } elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $data["pass"])) {
        $this->error["passError"] = "Your Password Must Contain At Least 1 Special Character !" . "<br>";
      }
    }

    if (empty($data["Cpass"])) {
      $this->error["cpassError"] = "Please re-enter password";
    } else {



      if (strlen($data["Cpass"]) < 8) {
        $this->error["cpassError"] = "Your Password Must Contain At Least 8 Digits !" . "<br>";
      } elseif (!preg_match("#[0-9]+#", $data["Cpass"])) {
        $this->error["cpassError"] = "Your Password Must Contain At Least 1 Number !" . "<br>";
      } elseif (!preg_match("#[A-Z]+#", $data["Cpass"])) {
        $this->error["cpassError"] = "Your Password Must Contain At Least 1 Capital Letter !" . "<br>";
      } elseif (!preg_match("#[a-z]+#", $data["Cpass"])) {
        $this->error["cpassError"] = "Your Password Must Contain At Least 1 Lowercase Letter !" . "<br>";
      } elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $data["Cpass"])) {
        $this->error["cpassError"] = "Your Password Must Contain At Least 1 Special Character !" . "<br>";
      } elseif ($data["pass"] != $data["Cpass"]) {
        $this->error["cpassError"] = "Re-type password must be matched with password";
      }
    }

    if (empty($data["dob"])) {
      $this->error["dobError"] = "dob is required";
    }


    if (empty($data["nid"])) {
      $this->error["nidError"] = "NID required";
    } else {
      if (strlen($data["nid"]) != 10) {
        $this->error["nidError"] = "NID must have 10 numbers";
      }
      if (!is_numeric($data["nid"])) {
        $this->error["nidError"] = "NID must have only numbers";
      }
      if (dupNID($data)) {
        $this->error["nidError"] = "NID number already exists";
      }
    }


    if (addrenters($data)) {
      $this->text = "Registration done successfully!";
    } else {
      $this->text = "Registration failed!";
    }
  }
  function get_error()
  {
    return $this->error;
  }

  function get_text()
  {
    return $this->text;
  }
}
