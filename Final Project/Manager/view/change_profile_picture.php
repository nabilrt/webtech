<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$imageError = "";
if (!isset($_SESSION["NID"])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $NID
    );

    require_once '../controller/getaccountantData.php';

    $accountant_dashboard = new getDataFromFile($data);

    $manager = $accountant_dashboard->checkFromFiles($data);

    $Full_Name = $manager['Name'];
    $Gender = $manager['Gender'];
    $Email = $manager['Email'];
    $Password = $manager['Password'];
    $Image = $manager['Image'];

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

            require_once '../controller/change_picture.php';

            $change_dp = new changePicture($data_img);
            $change_dp->change_picture($data_img);

            $error = $change_dp->get_error();
            $message = $change_dp->get_message();

            $imageError = $error["ImageErr"];
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
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
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
        <div style="display: inline-block; padding-left: 45px">
            <fieldset class="fieldsetAdjust">
                <h3 style="color: black; font-family: 'Kanit', sans-serif;">Update Profile Picture</h3><br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="dp_form" method="POST" enctype="multipart/form-data" onsubmit="return dp_validate()">
                    <img src="<?php echo $manager['Image']; ?>" alt="" width="150px" height="150px" class="rounded float-start"><br><br><br><br><br><br>&nbsp;
                    <p></p>
                    <input type="file" name="fileToUpload" id="fileToUpload" style="color: black;" class="form-control"><br><span id="ImageError" style="color:red">
                        <?php
                        if ($imageError != "") {
                            echo $imageError;
                        }
                        ?>
                    </span><br>
                    <input type="submit" value="Update Picture" name="update_dp" class="btn btn-success"><br>
                    <?php
                    if (isset($message)) {
                        echo '<span style="color:green">' . $message . '</span>';
                    }
                    ?>
                </form>
            </fieldset>
        </div>
    </div><br><br>
    <?php
    include 'footer.php';
    ?>

    <script type="text/javascript">
        function dp_validate() {
            var imgError = "";
            var img = document.getElementById("fileToUpload");
            var valid_ext = ["jpeg", "jpg", "png"];

            if (img.value == "") {
                document.getElementById("fileToUpload").value = "";
                document.getElementById("ImageError").innerHTML =
                    "Please Select an Image First";
                imgError = "Error";
            } else {
                var image_ext = img.value.substring(img.value.lastIndexOf(".") + 1);
                var result = valid_ext.includes(image_ext);
                if (result == false) {
                    document.getElementById("fileToUpload").value = "";
                    document.getElementById("ImageError").innerHTML =
                        "Only JPEG, PNG and JPG is allowed";
                    imgError = "Error";
                } else if (parseFloat(img.files[0].size / (1024 * 1024)) >= 3) {
                    document.getElementById("fileToUpload").value = "";
                    document.getElementById("ImageError").innerHTML =
                        "Maximum File Size is 3 MB";
                    imgError = "Error";
                } else {
                    imgError = "";
                    document.getElementById("ImageError").innerHTML = "";
                }
            }

            if (imgError != "") {
                return false;
            } else if (imgError == "") {
                return true;
            }
        }
    </script>
</body>

</html>