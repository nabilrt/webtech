<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:../../Login Module/view/login.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";
$imageError="";
if(isset($_SESSION["NID"])){
    $NID=$_SESSION["NID"];

    $data=array(
        'NID'=>$NID
    );

    require_once '../controller/getuserData.php';

    $propic=new getDataFromFile($data);

    $renter=$propic->checkFromFiles($data);

    $Name=$renter['name'];
    $Gender=$renter['gender'];
    $Email=$renter['email'];
    $Password=$renter['password'];
    $Image=$renter['Image'];
}
    if(isset($_POST["update_dp"])){
        if(!empty($_FILES["fileToUpload"]["name"])){

        $target_dir = "../Pictures/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $Temp=$_FILES["fileToUpload"]["tmp_name"];
        $img_size=$_FILES["fileToUpload"]["size"];
        $filename=$_FILES['fileToUpload']['name']; 

        $data_img=array(
        'Image'=>$Image,
        'Directory'=>$target_dir,
        'Target_File'=>$target_file,
        'ImageType'=>$imageFileType,
        'Image_Size'=>$check,
        'Img_Size'=>$img_size,
        'File_Name'=>$filename,
        'FilePath'=>"",
        'Temporary'=>$Temp
        );

        require_once '../controller/profilepicture.php';

        $propic=new changePicture($data_img);

        $propic->change_picture($data_img);

        $error=$propic->get_error();
        $message=$propic->get_message();

        $imageError=$error["ImageErr"];

        $Image = $renter['Image'];

         $NID=$_SESSION["NID"];

    $data=array(
        'NID'=>$NID
    );

    require_once '../controller/getuserData.php';

    $propic=new getDataFromFile($data);

    $renter=$propic->checkFromFiles($data);

    $Name=$renter['name'];
    $Gender=$renter['gender'];
    $Email=$renter['email'];
    $Password=$renter['password'];
    $Image=$renter['Image'];


    }
    else{
            $imageError="Choose a photo ";
        }
}







?>
<?php

 include '../header.php';

   ?>



<html>

<head>
    <meta charset="utf-8">
    <title>Change Profile Picture</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
 </head>
<body class="bd">
    <br><br><br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account<hr></legend>

       <div style="display: flex;">

        <div>

            <?php
         include "menu.php";

         ?>
        </div>
    
   <div style="display: inline-block; padding-left: 40px;">


                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"onsubmit="return profilepicvalidation()" method="POST" enctype="multipart/form-data">
                <img src="<?php echo $Image ?>" alt="" width="150px" height="150px"><br><br>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" style="color: black;"><br><br>
                <span id="ImageError" style="color:red">
                                <?php
                                if ($imageError != "") {
                                    echo $imageError;
                                }
                                ?>
                            </span>
                            <br>
                
                <input type="submit" class="btn btn-outline-success" value="Change Profile Picture" name="update_dp" class="button" ><br></br>
                <?php
                if(isset($message)){
                    echo $message;
                }
                ?>
                </form>
           
         </div>    
        </div>
                    <?php
                      include "footer.php";
                    ?>
<script>
    
    function profilepicvalidation(){

   var imageError="";
   var img=document.getElementById("fileToUpload");
   var valid_ext=["jpeg","jpg","png"];

    if(img.value==""){

        document.getElementById("fileToUpload").value = ''; 
        document.getElementById("ImageError").innerHTML="Select an Image";
        imageError="Error"; 

    }else{

        var image_ext=img.value.substring(img.value.lastIndexOf('.')+1);
        var result=valid_ext.includes(image_ext);
        if(result==false){

           document.getElementById("fileToUpload").value = ''; 
           document.getElementById("ImageError").innerHTML="Only JPEG, PNG and JPG is allowed";
           imageError="Error"; 

        }

        else if(parseFloat(img.files[0].size/(1024*1024))>=3){
           document.getElementById("fileToUpload").value = ''; 
           document.getElementById("ImageError").innerHTML="Maximum File Size is 3 MB";
           imageError="Error";
        }

        else{
            imageError="";
            document.getElementById("ImageError").innerHTML="";
        }

    }

    if(imageError!=""){
        return false;
    }else if(imageError==""){
        return true;
    }

 }
</script>
</body>
</html>