<?php
include_once '../model/Model.php';

class changePicture{
    public $error=array(
        'ImageErr'=>""
    );
    public $message=""; 

    function change_picture($data){
        $uploaded=1;
        if($data['File_Name'] != "")
        {
            if ($data['Image_Size'] !== false) { 
                $uploaded = 1;
            } else {
                $this-> error["ImageErr"] = "File is not an image.";
                $uploaded = 0;
            }
        
            if (file_exists($data['Target_File'])) {
                $this-> error["ImageErr"] = "Sorry, file already exists.";
                $uploaded = 0;
            }
        
            if ($data['Img_Size'] > 40000000000) {
                $this-> error["ImageErr"] = "Sorry, your file is too large.";
                $uploaded = 0;
            }
        
            if ($data['ImageType'] != "jpg" && $data['ImageType'] != "png" && $data['ImageType'] != "jpeg") {
                $this-> error["ImageErr"] = "Sorry, your file was not uploaded.";
                $uploaded = 0;
            }
        
            if ($uploaded == 0) 
            {
                $this-> error["ImageErr"] = "Sorry,only JPG, JPEG, PNG & GIF files are allowed";
            } else {
                if (move_uploaded_file($data['Temporary'], $data['Target_File'])) {
                    
                    $data['FilePath'] = $data['Directory'] . $data['File_Name'];
                    if(updateImage($data)){
                        $this->message="Picture Updated";
                    }
                    else{
                        $this->message="Unable to Update";
                    }
                } else {
                    $this-> error["ImageErr"] = "Sorry, there was an error uploading your file.";
                }
            }
        }
        else{
                    
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