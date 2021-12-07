<?php
include_once '../model/model.php';

class changePicture
{
    public $error = array(
        'ImageErr' => ""
    );
    public $message = "";

    function change_picture($data)
    {
        $target_dir = "../files/";
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
                    if (updateImage($data)) {
                        $this->message = "Picture Updated";
                    } else {
                        $this->message = "Unable to Update";
                    }
                } else {
                    $this->error["ImageErr"] = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
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