<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$nameError = $emailError = $dobError = $usernameError = $genderError = $nidError = "";
$passError = $cpassError = "";
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
}
if (isset($_POST["edit"])) {
    $data_s = array(
        'Name' => $_POST['name'],
        'Email' => $_POST['email'],
        'Password' => $_POST['pass'],
        'Confirm_Password' => $_POST['c_pass'],
        'Gender' => $_POST['gender'],
    );

    require_once "../controller/edit_data.php";
    $manager_edit_profile = new editData($data_s);

    $manager_edit_profile->edit($data_s);

    $error = $manager_edit_profile->get_error();
    $message = $manager_edit_profile->get_message();

    $nameError = $error["nameErr"];
    $emailError = $error["emailErr"];
    $passError = $error["passwordErr"];
    $cpassError = $error["confirm_passwordErr"];
    $genderErr = $error["genderErr"];

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
}



?>

<?php
include 'header.php';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">
</head>

<body class="bd">

    <br>
    <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;"> Account Account
        <hr>
        <hr>
        <hr>
    </legend>
    <div style="display:flex">
        <div>
            <?php include 'menu.php'; ?>
        </div>
        <div style="display:inline-block; padding-left:45px">
            <h3 style="font-family: 'Archivo Narrow', sans-serif;"><b>Edit User Informations</b></h3><br>
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
                </form>
            </div>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script type="text/javascript">
        function edit_profile_validate() {
            var x = document.getElementById("name").value;
            x = x.replace(/(^\s*)|(\s*$)/gi, "");
            x = x.replace(/[ ]{2,}/gi, " ");
            x = x.replace(/\n /, "\n");
            var z = x.split(" ").length;
            var nameErr = "";
            var passErr = "";
            var cpassErr = "";
            var emailErr = "";
            if (x == "") {
                document.getElementById("nameError").innerHTML = "Name cannot be Empty";
                nameErr = "Error";
            } else {
                if (/[A-Za-z]/.test(x[0]) == false) {
                    document.getElementById("nameError").innerHTML =
                        "Name must start with a letter";
                    nameErr = "Error";
                } else if (z < 2) {
                    document.getElementById("nameError").innerHTML =
                        "Name must contain at least two words";
                    nameErr = "Error";
                } else {
                    nameErr = "";
                    document.getElementById("nameError").innerHTML = "";
                }
            }
            var pass = document.getElementById("pass").value;
            if (pass == "") {
                document.getElementById("passError").innerHTML =
                    "Password Field Cannot be Empty";
                passErr = "Error";
            } else {
                if (/[a-z]+/.test(pass) == false) {
                    document.getElementById("passError").innerHTML =
                        "Your Password should contain at least one small letter";
                    passErr = "Error";
                } else if (/[\'^£$%&*()}{@#~?><>,|=_+¬-]/.test(pass) == false) {
                    document.getElementById("passError").innerHTML =
                        "Your Password should contain at least one special character";
                    passErr = "Error";
                } else if (/[0-9]+/.test(pass) == false) {
                    document.getElementById("passError").innerHTML =
                        "Your Password should contain at least one number";
                    passErr = "Error";
                } else if (pass.length < 8) {
                    document.getElementById("passError").innerHTML =
                        "Your Password should contain at least 8 characters";
                    passErr = "Error";
                } else {
                    passErr = "";
                    document.getElementById("passError").innerHTML = "";
                }
            }
            var c_pass = document.getElementById("c_pass").value;
            if (c_pass == "") {
                document.getElementById("cpassError").innerHTML =
                    "Confirm Password Field Cannot be Empty";
                cpassErr = "Error";
            } else {
                if (c_pass != pass) {
                    document.getElementById("cpassError").innerHTML =
                        "Your Passwords does not match";
                    cpassErr = "Error";
                } else {
                    cpassErr = "";
                    document.getElementById("cpassError").innerHTML = "";
                }
            }

            mail = document.getElementById("email").value;
            var validRegex =
                /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

            if (mail == "") {
                document.getElementById("emailError").innerHTML =
                    "Email Field cannot be empty";
                document.getElementById("email").focus();
                emailErr = "Error";
            } else {
                if (!document.getElementById("email").value.match(validRegex)) {
                    document.getElementById("emailError").innerHTML =
                        "Please enter a valid e-mail address";
                    document.getElementById("email").focus();
                    emailErr = "Error";
                } else {
                    emailErr = "";
                    document.getElementById("emailError").innerHTML = "";
                }
            }

            if (nameErr != "" || passErr != "" || cpassErr != "" || emailErr != "") {
                return false;
            } else if (
                nameErr == "" &&
                passErr == "" &&
                cpassErr == "" &&
                emailErr == ""
            ) {
                return true;
            }
        }

        function cpassVerify() {
            var form_ok = 0;

            var pass = document.getElementById("pass").value;

            var c_pass = document.getElementById("c_pass").value;

            if (c_pass == "") {
                document.getElementById("cpassError").innerHTML =
                    "Confirm Password Field Cannot be Empty";
                document.getElementById("c_pass").focus();
                form_ok = 1;
            } else {
                if (c_pass != pass) {
                    document.getElementById("cpassError").innerHTML =
                        "Your Passwords does not match";
                    document.getElementById("c_pass").focus();
                    form_ok = 1;
                } else {
                    form_ok = 0;
                    document.getElementById("cpassError").innerHTML = "";
                }
            }
            if (form_ok == 1) {
                return false;
            } else if (form_ok == 0) {
                return true;
            }
        }

        function passVerify() {
            var form_ok = 0;
            var pass = document.getElementById("pass").value;
            if (pass == "") {
                document.getElementById("passError").innerHTML =
                    "Password Field Cannot be Empty";
                form_ok = 1;
            } else {
                if (/[a-z]+/.test(pass) == false) {
                    document.getElementById("passError").innerHTML =
                        "Your Password should contain at least one small letter";
                    document.getElementById("pass").focus();
                    form_ok = 1;
                } else if (/[\'^£$%&*()}{@#~?><>,|=_+¬-]/.test(pass) == false) {
                    document.getElementById("passError").innerHTML =
                        "Your Password should contain at least one special character";
                    document.getElementById("pass").focus();
                    form_ok = 1;
                } else if (/[0-9]+/.test(pass) == false) {
                    document.getElementById("passError").innerHTML =
                        "Your Password should contain at least one number";
                    document.getElementById("pass").focus();
                    form_ok = 1;
                } else if (pass.length < 8) {
                    document.getElementById("passError").innerHTML =
                        "Your Password should contain at least 8 characters";
                    document.getElementById("pass").focus();
                    form_ok = 1;
                } else {
                    form_ok = 0;
                    document.getElementById("passError").innerHTML = "";
                }
            }
            if (form_ok == 1) {
                return false;
            } else if (form_ok == 0) {
                return true;
            }
        }

        function name_verify() {
            var x = document.getElementById("name").value;
            x = x.replace(/(^\s*)|(\s*$)/gi, "");
            x = x.replace(/[ ]{2,}/gi, " ");
            x = x.replace(/\n /, "\n");
            var z = x.split(" ").length;
            var form_ok = 0;
            if (x == "") {
                document.getElementById("nameError").innerHTML = "Name cannot be Empty";
                document.getElementById("name").focus();
                form_ok = 1;
            } else {
                if (/[A-Za-z]/.test(x[0]) == false) {
                    document.getElementById("nameError").innerHTML =
                        "Name must start with a letter";
                    document.getElementById("name").focus();
                    form_ok = 1;
                } else if (z < 2) {
                    document.getElementById("nameError").innerHTML =
                        "Name must contain at least two words";
                    document.getElementById("name").focus();
                    form_ok = 1;
                } else {
                    form_ok = 0;
                    document.getElementById("nameError").innerHTML = "";
                }
            }
            if (form_ok == 1) {
                return false;
            } else if (form_ok == 0) {
                return true;
            }
        }
    </script>
</body>

</html>