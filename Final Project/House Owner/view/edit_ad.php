<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$rentError = $areaError = $addressError = $ImageError = "";
$ad_rent = $ad_address = $ad_area = $ad_des = $p1 = $p2 = $p3 = "";
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

    require_once '../controller/get_the_ad.php';
    $ad_id = $_GET["id"];
    $show_Ad = new getTheAd($ad_id);
    $ad = $show_Ad->fetchAnAd($ad_id);
    $ad_owner = $ad["H_Owner_ID"];
    $ad_rent = $ad["AD_Rent"];
    $ad_address = $ad['AD_Address'];
    $ad_area = $ad['AD_Area'];
    $ad_des = $ad['AD_des'];
    $p1 = $ad['Picture1'];
    $p2 = $ad['Picture2'];
    $p3 = $ad['Picture3'];


    if (isset($_POST["edit"])) {
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
                'AD_rent' => $_POST["ad_rent"],
                'AD_area' => $_POST["ad_area"],
                'AD_address' => $_POST["ad_address"],
                'AD_description' => $_POST["msg"],
                'AD_iD' => $_POST["id"],
                'displayable' => "Yes",
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




            require_once '../controller/edit_the_ad.php';
            $edit_ad = new editAds($data_p);
            $edit_ad->editAd($data_p);
            $error = $edit_ad->get_error();
            $message = $edit_ad->get_message();
            $rentError = $error["rentErr"];
            $addressError = $error["addressErr"];
            $areaError = $error["areaErr"];
            $ImageError = $error["ImageErr"];
        } else {
            $ImageError = "3 Pictures Needs to be Selected";
            $rentError = "Rent Cannot Be Empty";
            $addressError = "Address Cannot Be Empty";
            $areaError = "Area Cannot Be Empty";
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
    <title>Edit Ad</title>
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
    <div style="display:flex">
        <div>
            <?php include 'menu.php'; ?>
        </div>
        <div style="display:inline-block">
            <div class="form-group" style="padding-left: 50px;">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" onsubmit="return edit_ad_validations()">
                    <label>AD Rent</label><br>
                    <input type="text" name="ad_rent" id="ad_rent" class="form-control" onkeyup="return rent_validate()" onblur="return rent_validate()" value="<?php echo $ad_rent; ?>"><br>
                    <span id="rentError" style="color:red">
                        <?php
                        if ($rentError != "") {
                            echo $rentError;
                        }
                        ?>
                    </span><br>
                    <label>Area</label><br>
                    <input type="text" name="ad_area" id="ad_ar" class="form-control" onkeyup="return area_validate()" onblur="return area_validate()" value="<?php echo $ad_area; ?>">
                    <br><span id="areaError" style="color:red">
                        <?php
                        if ($areaError != "") {
                            echo $areaError;
                        }
                        ?>
                    </span><br>
                    <label>Address</label><br>
                    <input type="text" name="ad_address" id="ad_address" class="form-control" onkeyup="return address_validate()" onblur="return address_validate()" value="<?php echo $ad_address; ?>"><br>
                    <span id="addressError" style="color:red">
                        <?php
                        if ($addressError != "") {
                            echo $addressError;
                        }
                        ?>
                    </span><br>
                    <label>Description</label><br>
                    <input type="text" name="msg" id="desc" class="form-control" onkeyup="return desc_validate()" onblur="return desc_validate()" value="<?php echo $ad_des; ?>"><br>
                    <span id="descError" style="color:red"></span><br>
                    <label>Picture 1</label><br>
                    <input type="file" name="fileToUpload" id="f1" class="form-control" value="<?php echo $p1; ?>"><span id="f1Error" style="color: red;">
                    </span><br>
                    <label>Picture 2</label><br>
                    <input type="file" name="fileToUpload1" id="f2" class="form-control" value="<?php echo $p2; ?>"><span id="f2Error" style="color: red;">
                    </span><br>
                    <label>Picture 3</label><br>
                    <input type="file" name="fileToUpload2" id="f3" class="form-control" value="<?php echo $p3; ?>"><span id="f3Error" style="color: red;">
                    </span><br>
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                    <input type="submit" name="edit" value="Edit" class="btn btn-success">
                    <?php
                    if (isset($message)) {
                        echo '<span style="color:green;">' . $message . '</span>';
                    } else if (isset($error)) {
                        echo $error;
                    }
                    ?>
                    <span style="color:red">
                        <?php
                        if ($ImageError != "") {
                            echo $ImageError;
                        }
                        ?>
                    </span>
                    <a href="manage_ads.php" class="btn btn-outline-primary">Go Back</a>
                </form>
            </div>
        </div>
    </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script type="text/javascript" src="../js/form_validations.js"></script>
</body>

</html>