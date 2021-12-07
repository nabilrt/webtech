<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$rentError = $areaError = $addressError = $ImageError = "";
$noImageError = "";
$noImageError1 = "";
$noImageError2 = "";
if (!isset($_SESSION["NID"])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];
    $data = array(
        'NID' => $NID
    );
    require_once '../controller/getUserData.php';
    $h_owner_dashboard = new getDataFromFile($data);
    $owner = $h_owner_dashboard->checkFromFiles($data);

    $Full_Name = $owner['Name'];
    $Gender = $owner['Gender'];
    $Email = $owner['Email'];
    $Password = $owner['Password'];
    $Image = $owner['Image'];
    if (isset($_POST["post_ad"])) {

        if (empty($_POST["ad_rent"])) {
            $rentError = "Rent Cannot Be Empty";
        } else {
            if (!is_numeric($_POST["ad_rent"])) {
                $rentError = "Rent can only contain numbers";
            }
        }

        if (empty($_POST["ad_area"])) {
            $areaError = "Area cannot be Empty";
        }

        if (empty($_POST["ad_address"])) {
            $addressError = "Address cannot be empty";
        }

        if (!empty($_FILES["fileToUpload"]["name"]) || !empty($_FILES["fileToUpload1"]["name"]) || !empty($_FILES["fileToUpload2"]["name"])) {
            $target_dir = "../files/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $target_file1 = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
            $target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
            $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            $check1 = getimagesize($_FILES["fileToUpload1"]["tmp_name"]);
            $check2 = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
            $Temp = $_FILES["fileToUpload"]["tmp_name"];
            $Temp1 = $_FILES["fileToUpload1"]["tmp_name"];
            $Temp2 = $_FILES["fileToUpload2"]["tmp_name"];
            $img_size = $_FILES["fileToUpload"]["size"];
            $img_size1 = $_FILES["fileToUpload1"]["size"];
            $img_size2 = $_FILES["fileToUpload2"]["size"];
            $filename = $_FILES['fileToUpload']['name'];
            $filename1 = $_FILES['fileToUpload1']['name'];
            $filename2 = $_FILES['fileToUpload2']['name'];
            $data_p = array(
                'House_Owner' => $_SESSION["NID"],
                'AD_Rent' => $_POST["ad_rent"],
                'AD_Area' => $_POST["ad_area"],
                'AD_Address' => $_POST["ad_address"],
                'AD_Description' => $_POST["msg"],
                'AD_ID' => $_POST["ad_id"],
                'Displayable' => $_POST["display"],
                'Directory' => $target_dir,
                'Target_File' => $target_file,
                'Target_File1' => $target_file1,
                'Target_File2' => $target_file2,
                'ImageType' => $imageFileType,
                'ImageType1' => $imageFileType1,
                'ImageType2' => $imageFileType2,
                'Image_Size' => $check,
                'Image_Size1' => $check1,
                'Image_Size2' => $check2,
                'Img_Size' => $img_size,
                'Img_Size1' => $img_size1,
                'Img_Size2' => $img_size2,
                'File_Name' => $filename,
                'File_Name1' => $filename1,
                'File_Name2' => $filename2,
                'FilePath' => "",
                'FilePath1' => "",
                'FilePath2' => "",
                'Temporary' => $Temp,
                'Temporary1' => $Temp1,
                'Temporary2' => $Temp2
            );
            require_once '../controller/create_ad.php';
            $post_ads = new postAds($data_p);
            $post_ads->addHouses($data_p);
            $error = $post_ads->get_error();
            $message = $post_ads->get_message();
            $rentError = $error["rentErr"];
            $addressError = $error["addressErr"];
            $areaError = $error["areaErr"];
            $ImageError = $error["ImageErr"];
        } else {
            $ImageError = "3 Pictures Needs to be Selected";
        }
    }
}
?>

<br></br>
<?php
include 'new_header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Post Ads</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
</head>

<body class="bd">
    <br>
    <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;">Account
        <hr>
    </legend>

    <div style="display:flex;">
        <div>
            <?php include 'menu.php'; ?>
        </div>
        <div style="display:inline-block; font-family: 'Overpass', sans-serif;">
        
         <div class="container" style="padding-left:50px">
         <h3><b>Post Ads</b></h3><br>
            <form method="POST" name="m_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return ad_post_validation()" class="row g-3">
                
                <div class="col-md-4">
                    <label class="form-label">ID</label><br>
                    <input type="text" name="ad_id" id="ad_id" value="" onkeyup="return aid_validate()" onblur="return aid_validate()" class="form-control"><span id="idError" style="color:red"></span></div>
                    <div class="col-md-4">
                    <label class="form-label">Rent</label><br>
                    <input type="text" name="ad_rent" id="ad_rent" onkeyup="return rent_validate()" onblur="return rent_validate()" value="" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter the rent amount(value must be a number)">
                    <span id="rentError" style="color:red">
                        <?php
                        if ($rentError != "") {
                            echo $rentError;
                        }
                        ?>
                    </span></div><br>
                    <div class="col-md-8">
                    <label>Area</label><br>
                    <input type="text" name="ad_area" id="ad_ar" onkeyup="return area_validate()" onblur="return area_validate()" value="" class="form-control">
                    <span id="areaError" style="color:red">
                        <?php
                        if ($areaError != "") {
                            echo $areaError;
                        }
                        ?>
                    </span></div>
                    <div class="col-md-8">
                    <label class="form-label">Address</label><br>
                    <input type="text" name="ad_address" id="ad_address" onkeyup="return address_validate()" onblur="return address_validate()" value="" class="form-control">
                    <span id="addressError" style="color:red">
                        <?php
                        if ($addressError != "") {
                            echo $addressError;
                        }
                        ?>
                    </span></div>
                    <div class="col-8">
                    <label>Description</label><br>
                    <textarea name="msg" id="desc" onkeyup="return desc_validate()" onblur="return desc_validate()" rows="5" cols="30" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter the correct description of your house"></textarea>
                    <span id="descError" style="color:red"></span><br></div>
                    <div class="col-md-5">
                    <label class="form-label">Picture 1</label><br>
                    <input type="file" name="fileToUpload" id="f1" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a Picture of your Interior"><span id="f1Error" style="color:red">
                    </span></div>
                    <div class="col-md-3">
                    <label class="form-label">Picture 2</label><br>
                    <input type="file" name="fileToUpload1" id="f2" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a Picture of your Interior"><span id="f2Error" style="color:red">
                    </span></div>
                    <div class="col-8">
                    <label>Picture 3</label><br>
                    <input type="file" name="fileToUpload2" id="f3" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a Picture of your Interior"><span id="f3Error" style="color:red">
                    </span><br></div><br><br>
                    <div class="col-md-5">
                    <input type="submit" name="post_ad" value="Post for Approve" class="btn btn-success"><br><br></div>
                    <?php
                    if (isset($message)) {
                        echo '<span style="color:green;">' . $message . '</span>';
                    } else if (isset($error)) {
                        echo $error;
                    }
                    ?>
                    <span id="ImgError" style="color:red">
                        <?php
                        if ($ImageError != "") {
                            echo $ImageError;
                        }
                        ?>
                    </span>
                    </div>
            </form>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script type="text/javascript" src="../js/form_validations.js"></script>
</body>

</html>