<?php
session_start();
date_default_timezone_set("Asia/Dhaka");
$NID = "";
$nameError = $emailError = $dobError = $usernameError = $genderError = $nidError = "";
$passError = $cpassError = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$times = "";
if (!isset($_SESSION["NID"])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $_SESSION["NID"],
    );

    require_once '../controller/getUserData.php';

    $h_owner_edit_profile = new getDataFromFile($data);

    $owner = $h_owner_edit_profile->checkFromFiles($data);

    $Full_Name = $owner['Name'];
    $Gender = $owner['Gender'];
    $Email = $owner['Email'];
    $Password = $owner['Password'];
    $Image = $owner['Image'];
}
if (isset($_POST["edit"])) {
    $timenow = date("Y-m-d") . " " . date("h:i:sa");
    setcookie('last_edited', $timenow, time() + 100000);
    $times = $_COOKIE['last_edited'];
    $data_s = array(
        'Name' => $_POST['name'],
        'Email' => $_POST['email'],
        'Password' => $_POST['pass'],
        'Confirm_Password' => $_POST['c_pass'],
        'Gender' => $_POST['gender'],
    );

    require_once "../controller/editUserData.php";
    $h_owner_edit_profile = new editData($data_s);

    $h_owner_edit_profile->edit($data_s);

    $error = $h_owner_edit_profile->get_error();
    $message = $h_owner_edit_profile->get_message();

    $nameError = $error["nameErr"];
    $emailError = $error["emailErr"];
    $passError = $error["passwordErr"];
    $cpassError = $error["confirm_passwordErr"];
    $genderErr = $error["genderErr"];
}
?>

<br></br>
<?php
include 'new_header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
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
        <div style="display:inline-block; padding-left:45px; font-family: 'Overpass', sans-serif;">
            <h3><b>Edit User Informations</b></h3><br>
            <div class="form-group">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return edit_profile_validate()">
                    <label>Name</label><br>
                    <input type="text" name="name" id="name" placeholder="Full Name" class="form-control" onkeyup="return name_verify()" onblur="return name_verify()" value="<?php echo $Full_Name; ?>"><br><span id="nameError" style="color: red;">
                        <?php
                        if ($nameError != "") {
                            echo "* - " . $nameError;
                        }
                        ?></span><br>
                    <label>Password</label><br>
                    <input type="password" name="pass" id="pass" placeholder="Password" class="form-control" onkeyup="return passVerify()" onblur="return passVerify()" value="<?php echo $Password; ?>"><span id="passError" style="color: red;">
                        <?php
                        if ($passError != "") {
                            echo "* - " . $passError;
                        }
                        ?></span><br>
                    <script>
                        function myFunction() {
                            var x = document.getElementById("pass");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                        }
                    </script>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" onclick="myFunction()"><label class="form-check-label" for="flexCheckChecked">Show Password</label><br><br>
                    </div>
                    <label>Confirm Password</label><br>
                    <input type="password" name="c_pass" id="c_pass" class="form-control" onkeyup="return cpassVerify()" onblur="return cpassVerify()" placeholder="Confirm Password" value="<?php echo $Password; ?>"><span id="cpassError" style="color: red;">
                        <?php
                        if ($cpassError != "") {
                            echo "* - " . $cpassError;
                        }
                        ?></span><br>
                    <script>
                        function myFunction1() {
                            var x = document.getElementById("c_pass");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                        }
                    </script>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" onclick="myFunction1()"><label class="form-check-label" for="flexCheckChecked">Show Password</label><br><br>
                    </div>
                    <label>Email</label><br>
                    <input type="text" name="email" id="email" placeholder="Email" class="form-control" onkeyup="return emailVerify()" onblur="return emailVerify()" value="<?php echo $Email; ?>"><span id="emailError" style="color: red;">
                        <?php
                        if ($emailError != "") {
                            echo "* - " . $emailError;
                        }
                        ?></span><br>
                    <label>Gender</label>&nbsp;
                    <input type="radio" id="gender" class="form-check-input" name="gender" value="Male" <?php if ($Gender == "Male") {
                                                                                                            echo "checked";
                                                                                                        } ?>><label class="form-check-label" for="flexRadioDefault2">&nbsp;Male</label>&nbsp;
                    <input type="radio" id="gender" class="form-check-input" name="gender" value="Female" <?php if ($Gender == "Female") {
                                                                                                                echo "checked";
                                                                                                            } ?>> <label class="form-check-label" for="flexRadioDefault2"> Female</label>&nbsp;
                    <input type="radio" id="gender" class="form-check-input" name="gender" value="Prefer not to Say" <?php if ($Gender == "Prefer not to Say") {
                                                                                                                            echo "checked";
                                                                                                                        } ?>><label class="form-check-label" for="flexRadioDefault2">&nbsp; Prefer not to say</label>&nbsp;<br><span style="color: red;">
                        <?php
                        if ($genderError != "") {
                            echo "* - " . $genderError;
                        }
                        ?></span><br>
                    <input type="submit" name="edit" value="Submit" class="btn btn-success"><br>
                    <?php
                    if (isset($message)) {
                        echo "<span style='color:green'><b>" . $message . "</b></span><br>";
                    }
                    ?>
                    <?php
                    echo "Last Updated " . $_COOKIE['last_edited'];
                    ?>
                </form>
            </div>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script type="text/javascript" src="../js/form_validations.js"></script>
</body>

</html>