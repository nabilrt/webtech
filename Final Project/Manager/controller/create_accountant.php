<?php
include '../model/model.php';
class addAccountant{
    public $error=array(
        'nameErr'=>"",
        'emailErr' =>"",
        'passwordErr'=>"",
        'confirm_passwordErr'=>"",
        'nidErr' =>"",
        'genderErr' =>"",
        'ImageErr' => ""
    );
    public $message="";
  
    function addData($data)
    {
      if (empty($data["Name"])) {
          $this-> error["nameErr"] = "Name is required";
      } else {
          if ((str_word_count($data["Name"])) < 2) {
            $this-> error["nameErr"] = "The name must have at least two word";
          } else {
              if ((preg_match("/[A-Za-z]/", $data["Name"][0])) == 0) {
                $this-> error["nameErr"] = "The name must have start with litter";
              } else {
                  if (preg_match('/^[A-Za-z\s._-]+$/', $data["Name"]) !== 1) {
                    $this-> error["nameErr"] = "Name can contain letter,desh,dot and space";
                  }
              }
          }
      }
  
      if (empty($data["Email"])) {
        $this-> error["emailErr"] = "Email is required";
      } else {
          if (!filter_var($data["Email"], FILTER_VALIDATE_EMAIL)) {
            $this-> error["emailErr"] = "Invalid email format";
          }
      }
  
      if (empty($data["Password"])) {
        $this-> error["passwordErr"] = "Password is required";
      } else {
          if (strlen($data["Password"]) < 9) {
            $this-> error["passwordErr"] = "Password must contain at least 8 character";
          } else {
  
              if (preg_match('/[#$%@]/', $data["Password"]) !== 1) {
                $this-> error["passwordErr"] = "Password have to contain at least one '#' or '$' or '%' or '@'";
              }
          }
      }
  
      if (empty($data["Confirm_Password"])) {
        $this-> error["confirm_passwordErr"] = "Confirm Password is required";
      } else {
          if (strcmp($data["Password"], $data["Confirm_Password"]) !== 0) {
            $this-> error["confirm_passwordErr"] = "Password are not matched";
          }
      }
  
      if (empty($data["NID"])) {
        $this-> error["nidErr"] = "NID required";
      } else {
          if (strlen($data["NID"])!=10) {
            $this-> error["nidErr"] = "NID Must be 10 Numbers";
          }
          if (!is_numeric($data["NID"])) {
            $this-> error["nidErr"] = "NID Must only consists of number";
          }

      }
  
      if (empty($data["Gender"])){
        $this-> error["genderErr"] = "Gender is required";
      }

      $uploaded = 1;
        $actual_error = "";
        if (empty($data["Target_File"])) {
            $this->error["ImageErr"] = "Picture is Required";
            return "";
        }
        if ($data['File_Name'] != "") {
            if ($data['Image_Size'] !== false) {
                $uploaded = 1;
            } else {
                $this->error["ImageErr"] = "File is not an image.";
                $actual_error = $this->error["ImageErr"];
                $uploaded = 0;
            }

            if (file_exists($data['Target_File'])) {
                $this->error["ImageErr"] = "Sorry, file already exists.";
                $actual_error = $this->error["ImageErr"];
                $uploaded = 0;
            }

            if ($data['Img_Size'] > 40000000000) {
                $this->error["ImageErr"] = "Sorry, your file is too large.";
                $actual_error = $this->error["ImageErr"];
                $uploaded = 0;
            }

            if ($data['ImageType'] != "jpg" && $data['ImageType'] != "png" && $data['ImageType'] != "jpeg") {
                $this->error["ImageErr"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $actual_error = $this->error["ImageErr"];

                $uploaded = 0;
            }

            if ($uploaded == 0) {
                $this->error["ImageErr"] = $actual_error;
            } else {
                if (move_uploaded_file($data['Temporary'], $data['Target_File'])) {

                    $data['FilePath'] = $data['Directory'] . $data['File_Name'];
                } else {
                    $this->error["ImageErr"] = "Sorry, there was an error uploading your file.";
                }
            }
        } 

      if(empty($this-> error["nameErr"]) && empty($this-> error["emailErr"]) && empty($this-> error["nidErr"]) && empty($this-> error["passwordErr"]) && empty($this-> error["confirm_passwordErr"]) && empty($this-> error["genderErr"]) && empty($this-> error["ImageErr"])){

        if(addAccountants($data)){
            $this->message="Registration Successful";
        }
        else{
            $this->message="Unable to do Registration";
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