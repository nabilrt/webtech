<?php

    session_start();
    $isFound=false;

    if(isset($_SESSION['Username'])){
        $data = file_get_contents("../json/data.json");  
        $data = json_decode($data, true); 
        foreach($data as $key=>$value){
            if($value['Username']==$_SESSION["Username"]){
            $Name=$value['Name'];
            $image_link=$value['Image']; 
            $Gender=$value['Gender'];
            $Username=$value['Username']; 
            $DOB=$value['DOB'];
            $isFound=true;
            break;
            }
        }
        if($isFound){
             $ConfirmMessage="";
        }else{
             $ErrorMessage="Wrong Username or Password";
        }

        $ImageError = $UploadConfirmation = "";

        if(isset($_POST["update_dp"])){
            $target_dir = "../files/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $filepath = "";
            if($_FILES['fileToUpload']['name'] != "")
            {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) { 
                    $uploaded = 1;
                } else {
                    $ImageError = "File is not an image.";
                    $uploaded = 0;
                }
            
                if (file_exists($target_file)) {
                    $ImageError = "Sorry, file already exists.";
                    $uploaded = 0;
                }
            
                if ($_FILES["fileToUpload"]["size"] > 40000000000) {
                    $ImageError = "Sorry, your file is too large.";
                    $uploaded = 0;
                }
            
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $ImageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploaded = 0;
                }
            
                if ($uploaded == 0) {
                    $ImageError = "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $UploadConfirmation = "File has been uploaded Successfully";
                        $filepath = $target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                    } else {
                        $ImageError = "Sorry, there was an error uploading your file.";
                    }
                }
            }else{
                $ImageError="No Image was selected";
            }
        }
    }else{
        header("location:login_page.php");
    }

?>

<?php

include 'top-navbar1.php';

?>

<html>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard_styles.css">
    <body>
    <br><br>
    <div class="sign-up" style="font-family: Arial;">
    <?php  
    echo "<img src= ".$image_link." height='150px' width='150px'><br><br>";
    echo "Welcome , ".$Name;
    ?>
    <br>
    <a href="login_page.php" target="_self" class="links">Log out</a>
    </div>
    <div>
    <table class="table">
        <thead>
            <th style="color: black;">Account<hr></th>
            <th> </th>
        </thead>
        <tr>
        <td style="color: black;  font-family:Century Gothic">
            <ul style="list-style-type:none">
                <ii><a href="dashboard.php" style="text-decoration: none; color:royalblue; list-style-type:none">Dashboard</a></ii>
                <li><a href="view_profile.php" style="text-decoration: none; color:royalblue; list-style-type:none">View Profile</a></li>
                <li><a href="edit_profile.php" style="text-decoration: none; color:royalblue; list-style-type:none">Edit Profile</a></li>
                <li><a href="change_dp.php" style="text-decoration: none; color:royalblue; list-style-type:none">Change Profile Picture</a></li>
                <li><a href="change_pass.php" style="text-decoration: none; color:royalblue; list-style-type:none">Change Password</a></li>
                <li><a href="logout.php" style="text-decoration: none; color:royalblue; list-style-type:none">Log out</a></li>
            </ul>
        </td>
        <td>
            <fieldset class="fieldsetAdjust">
                <legend style="color: black; font-family:Footlight MT">Update Profile Picture</legend>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <img src="<?php if(!empty($filepath)){echo $filepath;} else { echo $image_link; } ?>" alt="" width="150px" height="150px"><br><br>
                <input type="file" name="fileToUpload" id="fileToUpload" style="color: black;"><br><br><span style="color:red">
                    <?php
                    if ($ImageError != "") {
                        echo $ImageError;
                    }else{
                        echo $UploadConfirmation;
                    }
                    ?>
                </span><br><br>
                <input type="submit" value="Update Picture" name="update_dp" class="button1">
                </form>
            </fieldset>

        </td>
        </tr>
    </table> 
    </div><br><br><br><br><br><br><br><br><br><br>
    <?php
    include 'footer.php';
    ?>
    </body>
</html>