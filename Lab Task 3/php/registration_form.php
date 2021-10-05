<?php

$Error = "";
$Name = $Email = $Username = $Password = $Confirm_Password = $Gender = $DoB = "";
$day = $month = $year = 0;
$nameError = $emailError = $dobError = $usernameError = $genderError =  "";
$passError = $cpassError = "";
$ImageError = $UploadConfirmation = "";

if (isset($_POST["register"])) {
    $name_words = $_POST["name"];
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    $DoB = strval($day) . "-" . strval($month) . "-" . strval($year);
    $target_dir = "../files/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $filepath = "";
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        if ((!preg_match("/^[a-zA-Z-'._ ]*$/", $Name))) {
            $nameError = "Name Must Start with a letter";
        } else {
            if ((str_word_count($name_words) < 2)) {
                $nameError = "Minimum Two Words Needed in Name";
            }
        }
    }
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $Email = validateInput($_POST["email"]);
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid Email Format Type it correctly";
        }
    }
    if (empty($_POST["username"])) {
        $usernameError = "Username is Required";
    } else {
        $Username = validateInput($_POST["username"]);
        if (((!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $Username))) && (strlen($_POST["username"]) < 2)) {
            $usernameError = "Username can only contain alphanumeric characters dash and underscore only and at least 2 characters";
        }
    }
    if (empty($_POST["pass"])) {
        $passError = "Password is Required";
    } else {
        if (strlen(($_POST["pass"])) < 8) {
            $passError = "At least 8 character needed";
        } else {
            if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["pass"])) {
                $passError = "At least one special character needed";
            }
        }
    }

    if (empty($_POST["cpassword"])) {
        $cpassError = "Confirm Password cannot be empty";
    } else {
        if (($_POST["pass"]) != ($_POST["cpassword"])) {
            $cpassError = "Password does not match";
        }
    }

    if ((empty($_POST["day"])) or (empty($_POST["month"])) or (empty($_POST["year"]))) {
        $dobError = "Enter all the fields";
    } else {
        if (($day >= 1 and $day <= 31) and ($month >= 1 and $month <= 12) and ($year >= 1953 and $year <= 1998)) {
            $DoB = strval($day) . "-" . strval($month) . "-" . strval($year);
        } else {
            $dobError = "Invalid Date Entered [dd - (1-31) mm - (1-12) yy - (1953-1998)]";
        }
    }

    if (empty($_POST["gender"])) {
        $genderError = "Gender Required";
    } else {
        $Gender = validateInput($_POST["gender"]);
    }

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


    $Confirmation = "";
    if ($nameError == "" && $emailError == "" && $usernameError == "" && $passError == "" && $cpassError == "" && $genderError == "" && $dobError == "" && $ImageError == "") {
        if (file_exists("../json/data.json")) {
            $current_content = file_get_contents("../json/data.json");
            $array_content = json_decode($current_content, true);
            $new_content = array(
                'Name' => $_POST["name"],
                'Email' => $_POST["email"],
                'Username' => $_POST["username"],
                'Password' => $_POST["pass"],
                'Gender' => $_POST["gender"],
                'DOB' => $DoB,
                'Image' => $filepath
            );
            $array_content[] = $new_content;
            $final_content = json_encode($array_content, JSON_UNESCAPED_SLASHES);
            if (file_put_contents("../json/data.json", $final_content)) {
                $Confirmation = "Registration Completed!";
            }
        } else {
            $Confirmation = "JSon File Does not Exist";
        }
    }
}

function validateInput($information)
{
    $information = trim($information);
    $information = stripslashes($information);
    $information = htmlspecialchars($information);
    return $information;
}

?>
<!DOCTYPE html>
<html>
<title>User Registration</title>
<link rel="stylesheet" type="text/css" href="../css/registration_form_styles.css">
<body>
    <div>
    <div>
        <h1 class="heading">Registration Form</h1>
        <h5 class="heading2">Please provide correct details to proceed</h5>
    </div>
    <div>
        <form method="POST" action="" enctype="multipart/form-data">
            <label class="labels"><B>Name</B></label><br>
            <input type="text" id="name" name="name" value="" placeholder="Name"><span style="color: red;">
                <?php
                if ($nameError != "") {
                    echo "* - " . $nameError;
                }
                ?></span><br><br>
            <label class="labels"><b>Email</b></label><br>
            <input type="text" id="email" name="email" value="" placeholder="Email"><span style="color: red;">
                <?php
                if ($emailError != "") {
                    echo "* - " . $emailError;
                }
                ?></span><br><br>
            <label class="labels"><b>Username</b></label><br>
            <input type="text" id="username" name="username" value="" placeholder="Username"><span style="color: red;">
                <?php
                if ($usernameError != "") {
                    echo "* - " . $usernameError;
                }
                ?>
            </span><br><br>
            <label class="labels"><b>Password</b></label><br>
            <input type="text" id="pass" name="pass" value="" placeholder="Password"><span style="color:red">
                <?php
                if ($passError != "") {
                    echo "* - " . $passError;
                }
                ?>
            </span><br><br>
            <label class="labels"><b>Confirm Password</b></label><br>
            <input type="text" id="cpassword" name="cpassword" value="" placeholder="Confirm Password"><span style="color: red;">
                <?php
                if ($cpassError != "") {
                    echo "* - " . $cpassError;
                }
                ?>
            </span><br><br>
            <label class="labels"><b>Gender</b></label>
            <input type="radio" id="gender" name="gender" value="Male"> Male
            <input type="radio" id="gender" name="gender" value="Female"> Female
            <input type="radio" id="gender" name="gender" value="Other"> Other &nbsp; <span style="color:red">
                <?php
                if ($genderError != "") {
                    echo "* - " . $genderError;
                }
                ?>
            </span>
            <br><br>
            <label class="labels"><b>Date of Birth</b></label><br>
            <input type="dob" id="day" name="day" value="" placeholder="dd" size="3" class="adjustbox"> -
            <input type="dob" id="month" name="month" value="" placeholder="mm" size="3" class="adjustbox"> -
            <input type="dob" id="year" name="year" value="" placeholder="yy" size="5" class="adjustbox"> <span style="color: red;">
                <?php if ($dobError != "") {
                    echo " * - ";
                    echo $dobError;
                }
                ?>
            </span><br><br>
            <fieldset class="fieldsetAdjust">
                <legend class="labels"><b>Picture</b></legend>
                <img src="<?php if(!empty($filepath)){echo $filepath;} else { echo "../files/normal.png"; } ?>" alt="" width="150px" height="150px"><br><br>
                <input type="file" name="fileToUpload" id="fileToUpload"><br><br><span style="color:red">
                    <?php
                    if ($ImageError != "") {
                        echo $ImageError;
                    }
                    ?>
                </span><br><br>
            </fieldset><br>
            <input type="submit" value="Register" name="register" class="button1">
            <input type="reset" value="Clear" name="clear" class="button1">
            <a href="homepage.php" target="_self"> Go to Homepage</a>
            <br><br>
            <?php
            if (isset($Confirmation)) {
                echo "<span style='color:green'><b>" . $Confirmation . "</b></span><br>";
            }
            ?>
        </form>     
    </div>
    <?php
    include "footer.php";
    ?>
    </div>
</body>
</html>