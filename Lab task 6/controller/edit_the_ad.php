<?php
require_once '../model/model.php';
class editAds
{
    public $error = array(
        'rentErr' => "",
        'addressErr' => "",
        'areaErr' => "",
        'ImageErr' => ""
    );

    public $message = "";

    function editAd($data)
    {
        $actual_error = "";
        if (empty($data["Target_File"]) || empty($data["Target_File1"]) || empty($data["Target_File2"])) {
            $this->error["ImageErr"] = "Picture is Required";
            return "";
        }
        if (empty($data["AD_rent"])) {
            $this->error["rentErr"] = "Rent Cannot Be Empty";
        } else {
            if (!is_numeric($data["AD_rent"])) {
                $this->error["rentErr"] = "Rent can only contain numbers";
            }
        }

        if (empty($data["AD_area"])) {
            $this->error["areaErr"] = "Area cannot be Empty";
        }

        if (empty($data["AD_address"])) {
            $this->error["addressErr"] = "Address cannot be empty";
        }

        $uploaded = 1;
        if ($data['File_Name'] != "" || $data['File_Name1'] != "" || $data['File_Name2'] != "") {
            if ($data['Image_Size'] !== false && $data['Image_Size1'] !== false && $data['Image_Size2'] !== false) {
                $uploaded = 1;
            } else {
                $this->error["ImageErr"] = "File is not an image.";
                $actual_error = $this->error["ImageErr"];
                $uploaded = 0;
            }

            if (file_exists($data['Target_File']) || file_exists($data['Target_File1']) || file_exists($data['Target_File2'])) {
                $this->error["ImageErr"] = "Sorry, file already exists.";
                $actual_error = $this->error["ImageErr"];
                $uploaded = 0;
            }

            if ($data['Img_Size'] > 40000000000 || $data['Img_Size1'] > 40000000000 || $data['Img_Size2'] > 40000000000) {
                $this->error["ImageErr"] = "Sorry, your file is too large.";
                $actual_error = $this->error["ImageErr"];
                $uploaded = 0;
            }

            if (($data['ImageType'] != "jpg" && $data['ImageType'] != "png" && $data['ImageType'] != "jpeg") || ($data['ImageType1'] != "jpg" && $data['ImageType1'] != "png" && $data['ImageType1'] != "jpeg") || ($data['ImageType2'] != "jpg" && $data['ImageType2'] != "png" && $data['ImageType2'] != "jpeg")) {
                $this->error["ImageErr"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $actual_error = $this->error["ImageErr"];
                $uploaded = 0;
            }

            if ($uploaded == 0) {
                $this->error["ImageErr"] = $actual_error;
            } else {
                if (empty($this->error["addressErr"]) && empty($this->error["areaErr"]) && empty($this->error["rentErr"])) {
                    if (move_uploaded_file($data['Temporary'], $data['Target_File']) && move_uploaded_file($data['Temporary1'], $data['Target_File1']) && move_uploaded_file($data['Temporary2'], $data['Target_File2'])) {
                        $data['FilePath'] = $data['Directory'] . $data['File_Name'];
                        $data['FilePath1'] = $data['Directory'] . $data['File_Name1'];
                        $data['FilePath2'] = $data['Directory'] . $data['File_Name2'];
                        if (updateAnAd($data)) {
                            header("Location:../view/manage_ads.php");
                        } else {
                            $this->message = "Unable to Edit Ad";
                        }
                    } else {
                        $this->error["ImageErr"] = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $this->message = "Provide All The Informations";
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
