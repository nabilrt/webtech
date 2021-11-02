<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$imageError = "";
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

    $change_dp = new getDataFromFile($data);

    $change_dp->checkFromFiles($data);

    $Full_Name = $_SESSION['FullName'];
    $Gender = $_SESSION['Gender'];
    $Email = $_SESSION['Email'];
    $Password = $_SESSION['Password'];
    $Image = $_SESSION['Image'];

    if (isset($_POST["update_dp"])) {



        if (!empty($_FILES["fileToUpload"]["name"])) {
            $target_dir = "../files/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            $Temp = $_FILES["fileToUpload"]["tmp_name"];
            $img_size = $_FILES["fileToUpload"]["size"];
            $filename = $_FILES['fileToUpload']['name'];

            $data_img = array(
                'Image' => $Image,
                'Directory' => $target_dir,
                'Target_File' => $target_file,
                'ImageType' => $imageFileType,
                'Image_Size' => $check,
                'Img_Size' => $img_size,
                'File_Name' => $filename,
                'FilePath' => "",
                'Temporary' => $Temp
            );

            require_once '../controller/changeUserPicture.php';

            $change_dp = new changePicture($data_img);
            $change_dp->change_picture($data_img);

            $error = $change_dp->get_error();
            $message = $change_dp->get_message();

            $imageError = $error["ImageErr"];

            $Image = $_SESSION['Image'];
        } else {
            $imageError = "Select an Image First";
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
    <title>Change Picture</title>
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
                <td style="width:550px; vertical-align:top;">
                    <fieldset class="fieldsetAdjust">
                        <legend style="color: black; font-family:Footlight MT">Update Profile Picture</legend>
                        <script>
                            function formValidation() {
                                if ((document.getElementById("fileToUpload").value == "" || document.getElementById("fileToUpload").value == null)) {
                                    alert("Select an Image First");
                                    return false;
                                } else
                                    return true;
                            }
                        </script>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                            <img src="<?php echo $Image ?>" alt="" width="150px" height="150px"><br><br>
                            <input type="file" name="fileToUpload" id="fileToUpload" style="color: black;"><br><br><span style="color:red">
                                <?php
                                if ($imageError != "") {
                                    echo $imageError;
                                }
                                ?>
                            </span><br><br>
                            <input type="submit" value="Update Picture" name="update_dp" class="button1"><br>
                            <?php
                            if (isset($message)) {
                                echo '<span style="color:green">' . $message . '</span>';
                            }
                            ?>
                        </form>
                    </fieldset>
                </td>

            </tr>
        </table>
    </div><br>
    <?php
    include 'footer.php';
    ?>

</body>

</html>