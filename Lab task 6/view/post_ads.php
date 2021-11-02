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
    header("location:howner_login.php");
}
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];
    $data = array(
        'NID' => $NID
    );
    require_once '../controller/getUserData.php';
    $h_owner_dashboard = new getDataFromFile($data);
    $h_owner_dashboard->checkFromFiles($data);
    $Full_Name = $_SESSION['FullName'];
    $Gender = $_SESSION['Gender'];
    $Email = $_SESSION['Email'];
    $Password = $_SESSION['Password'];
    $Image = $_SESSION['Image'];
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
            if (isset($_POST["display"])) {
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
            } else if (!isset($_POST["display"])) {
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
                    'Displayable' => "No",
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
            }
        } else {
            $ImageError = "3 Pictures Needs to be Selected";
        }
    }
}
?>

<br></br>
<?php
include 'header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Post Ads</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body>

    <br>
    <div class="intro">

        <br>
        <span style="font-family: Rockwell;">
            <?php


            echo "Hi , " . $Full_Name;

            ?>
        </span>

        <br>
        <a href="log_out.php" target="_self" class="button2">Log out</a>
        <img class="intro2" src="<?php echo $Image; ?>" width="120px" height="120px"><br><br>

    </div>



    <div>
        <table border=1 style="width:800px; border-style: none;border-collapse: collapse; border: 2px solid blue;">

            <tr>

                <td style="width:250px">
                    <legend>Account
                        <hr>
                    </legend>
                    <ul>
                        <a href="h_owner_dashboard.php" class="button">Dashboard</a>
                        <a href="post_ads.php" class="button">Post Ads</a>
                        <a href="manage_ads.php" class="button">Manage Ads</a>
                        <a href="search_ad.php" class="button">Search Ad</a>
                        <a href="chatting.php" class="button">Chat</a>
                        <a href="manage_payments.php" class="button">Manage Payments</a>
                        <a href="give_notice.php" class="button">Give Notice</a>
                        <a href="manage_notices.php" class="button">Manage Notices</a>
                        <a href="view_profile.php" class="button">View Profile</a>
                        <a href="h_owner_edit_profile.php" class="button">Edit Profile</a>
                        <a href="change_dp.php" class="button">Change Picture</a>
                        <a href="log_out.php" class="button">Log out</a>
                    </ul>
                </td>
                <td style="width:550px; vertical-align:top; padding: 10px 15px;">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <label>AD_ID</label><br>
                        <input type="text" name="ad_id" id="ad_id" value=""><br>
                        <label>AD Rent</label><br>
                        <input type="text" name="ad_rent" id="ad_rent" value=""><br><span style="color:red">
                            <?php
                            if ($rentError != "") {
                                echo $rentError;
                            }
                            ?>
                        </span><br><br>
                        <label>Area</label><br>
                        <input type="text" name="ad_area" value="">
                        <br><span style="color:red">
                            <?php
                            if ($areaError != "") {
                                echo $areaError;
                            }
                            ?>
                        </span><br><br>
                        <label>Address</label><br>
                        <input type="text" name="ad_address" id="ad_address" value=""><br><span style="color:red">
                            <?php
                            if ($addressError != "") {
                                echo $addressError;
                            }
                            ?>
                        </span><br><br>
                        <label>Description</label><br>
                        <input type="textarea" name="msg" rows="5" cols="100"><br><br>
                        <label>Picture 1</label><br>
                        <input type="file" name="fileToUpload" id="f1"><span>
                        </span><br><br>
                        <label>Picture 2</label><br>
                        <input type="file" name="fileToUpload1" id="f2"><span>
                        </span><br><br>
                        <label>Picture 3</label><br>
                        <input type="file" name="fileToUpload2" id="f3"><span>
                        </span><br><br>
                        <input type="checkbox" name="display" id="display" value="Yes">Display<br><br>
                        <input type="submit" name="post_ad" value="Post for Approve"><br><br>
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
                    </form>
                </td>
            </tr>
        </table>
    </div><br>
    <?php
    include 'footer.php';
    ?>
</body>

</html>