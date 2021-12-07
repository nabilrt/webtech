<?php
session_start();
if (!isset($_SESSION['NID'])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
$NID = "";

$name = $email = $un = $gender = $pass = $Cpass = $dob = $nid = "";

$UploadConfirmation = "";
$target_file = "";
$nameErr = $emailErr = $unErr = $genderErr = $passErr = $CpassErr = $dobErr = $pictureErr = $ImgErr = $nidErr = "";
$Name = $Email = $Gender = $Password = $Image = "";
$nameError = $nidError = $passError = $cpassError = $emailError = $genderError = $dobError = "";


if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $_SESSION["NID"],
    );
    require_once '../controller/getuserData.php';

    $editprofile = new getDataFromFile($data);

    $renter = $editprofile->checkFromFiles($data);

    $Name = $renter['name'];
    $Gender = $renter['gender'];
    $Email = $renter['email'];
    $Password = $renter['password'];
    $Image = $renter['Image'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data_s = array(
        'NID' => $_SESSION['NID'],

        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'pass' => $_POST['pass'],
        'Cpass' => $_POST['Cpass'],
        'gender' => $_POST['gender']


    );
    require_once "../controller/editprofile.php";
    $editprofile = new editData($data_s);

    $editprofile->edit($data_s);

    $error = $editprofile->get_error();
    $message = $editprofile->get_message();


    $nameErr = $error["nameError"];
    $emailErr = $error["emailError"];
    $passErr = $error["passError"];
    $CpassErr = $error["cpasswordError"];
    $genderErr = $error["genderError"];

    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $_SESSION["NID"],
    );
    require_once '../controller/getuserData.php';

    $editprofile = new getDataFromFile($data);

    $renter = $editprofile->checkFromFiles($data);

    $Name = $renter['name'];
    $Gender = $renter['gender'];
    $Email = $renter['email'];
    $Password = $renter['password'];
    $Image = $renter['Image'];
}


?>
<?php

include '../header.php';

?>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body class="bd">

    <br><br><br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account
        <hr>
    </legend>
    <div style="display: flex;">

        <div>

            <?php
            include "menu.php";

            ?>
        </div>

        <div style="display: inline-block; padding-left: 40px;">

            <form onsubmit="return editprofilevalidation()" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <label><b>Your Name</b></label><br>
                <input type="text" name="name" id="name" value="<?php echo $renter['name']; ?>" placeholder="Full Name" onkeyup="return nameverification()" onblur="return nameverification()" class="form-control" data-toggle="tooltip" data-placement="top" title="">
                <span id="nameError" style="color: red;">
                    <?php
                    if ($nameError != "") {
                        echo "* - " . $nameError;
                    }
                    ?>
                </span>
                <br><br>

                <label><b>Your email:</b>&nbsp; </label><br>
                <input type="text" name="email" id="email" onkeyup="return emailVerification()" onblur="return emailVerification()" value="<?php echo $Email; ?>" placeholder="Email" class="form-control" data-toggle="tooltip" data-placement="top" title=""><span id="emailError" style="color: red;"><?php
                                                                                                                                                                                                                                                                                                        if ($emailError != "") {
                                                                                                                                                                                                                                                                                                            echo "* - " . $emailError;
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                        ?></span>

                <br></br>
                <label><b>Password</b></label><br>
                <input type="password" name="pass" onkeyup="return passVerification()" onblur="return passVerification()" class="form-control" id="pas" placeholder="Password" value="<?php echo $Password; ?>" class="form-control" data-toggle="tooltip" data-placement="top" title="">
                <span id="passError" style="color: red;">
                    <?php
                    if ($passError != "") {
                        echo "* - " . $passError;
                    }
                    ?></span>
                <br><br>
                <script>
                    function myFunction() {
                        var x = document.getElementById("pas");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>

                <input type="checkbox" onclick="myFunction()"> Show Password <br><br>
                <label><b>Confirm Password</b></label><br>

                <input type="password" name="Cpass" id="Cpass" onkeyup="return cpassVerification()" onblur="return cpassVerification()" value="<?php echo $Password; ?>" placeholder="Confirm Password" class="form-control" data-toggle="tooltip" data-placement="top" title="">
                <span id="cpassError" style="color: red;">
                    <?php
                    if ($cpassError != "") {
                        echo "* - " . $cpassError;
                    }
                    ?></span><br>
                <script>
                    function myFunction1() {
                        var x = document.getElementById("Cpass");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
                <input type="checkbox" onclick="myFunction1()"> Show Password <br><br>
                <label><b> Gender:</b>&nbsp;</label>
                <input type="radio" id="m" name="gender" onclick="return genderVerification()" value="Male" <?php if ($Gender == "Male") {
                                                                                                                echo "checked";
                                                                                                            } ?>> Male&nbsp;
                <input type="radio" id="f" name="gender" onclick="return genderVerification()" value="Female" <?php if ($Gender == "Female") {
                                                                                                                    echo "checked";
                                                                                                                } ?>> Female&nbsp;
                <input type="radio" id="p" name="gender" onclick="return genderVerification()" value="Others" <?php if ($Gender == "Others") {
                                                                                                                    echo "checked";
                                                                                                                } ?>> Others&nbsp;

                <span id="genderError" style="color: red;">


                    <?php
                    if ($genderError != "") {
                        echo "* - " . $genderError;
                    }
                    ?></span>
                <br></br>


                <input type="submit" class="btn btn-outline-success" name="edit" value="Submit"><br>
                <?php
                if (isset($message)) {
                    echo "<span style='color:green'><b>" . $message . "</b></span><br>";
                }
                ?>
            </form>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
    <script>
        function nameverification() {
            var x = document.getElementById("name").value;
            x = x.replace(/(^\s*)|(\s*$)/gi, "");
            x = x.replace(/[ ]{2,}/gi, " ");
            x = x.replace(/\n /, "\n");
            var z = x.split(" ").length;
            var form_ok = 0;
            if (x == "") {
                document.getElementById("nameError").innerHTML = "Name is required";
                document.getElementById("name").focus();
                form_ok = 1;
            } else {
                if ((/[A-Za-z]/.test(x[0])) == false) {
                    document.getElementById("nameError").innerHTML = "Name must have start with a letter";
                    document.getElementById("name").focus();
                    form_ok = 1;
                } else if (z < 2) {
                    document.getElementById("nameError").innerHTML = " At least two words  needed";
                    document.getElementById("name").focus();
                    form_ok = 1;
                }
                /*else if ((/[A-Za-z]/.test(name)) == false) {
            document.getElementById("nameError").innerHTML=" bnbnbnb";
            document.getElementById("name").focus();
            form_ok=1;
     }*/
                else {
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

        function passVerification() {
            var form_ok = 0;
            var pass = document.getElementById("pas").value;
            if (pass == "") {
                document.getElementById("passError").innerHTML = "Password is required";
                form_ok = 1;
            } else {
                if ((/[a-z]+/.test(pass)) == false) {
                    document.getElementById("passError").innerHTML = " Password must contain at least one small letter";
                    document.getElementById("pas").focus();
                    form_ok = 1;
                } else if ((/['^£$%&*()}{@#~?><>,|=+¬-]/.test(pass)) == false) {
                    document.getElementById("passError").innerHTML = " Password must contain at least one special character";
                    document.getElementById("pas").focus();
                    form_ok = 1;
                } else if ((/[0-9]+/.test(pass)) == false) {
                    document.getElementById("passError").innerHTML = "Password must contain at least one number";
                    document.getElementById("pas").focus();
                    form_ok = 1;
                } else if (pass.length < 8) {
                    document.getElementById("passError").innerHTML = "Password must contain at least 8 characters";
                    document.getElementById("pas").focus();
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

        function cpassVerification() {

            var form_ok = 0;

            var pass = document.getElementById("pas").value;

            var Cpass = document.getElementById("Cpass").value;

            if (Cpass == "") {
                document.getElementById("cpassError").innerHTML = "Confirm password is required";
                document.getElementById("Cpass").focus();
                form_ok = 1;
            } else {
                if (Cpass != pass) {
                    document.getElementById("cpassError").innerHTML = "Your Passwords does not match";
                    document.getElementById("Cpass").focus();
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

        function emailVerification() {

            var emailError = "";

            email = document.getElementById("email").value;
            var validRegex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

            if (email == "") {
                document.getElementById("emailError").innerHTML = "Email is required";
                document.getElementById("email").focus();
                emailError = "Error";

            } else {
                if (!document.getElementById("email").value.match(validRegex)) {
                    document.getElementById("emailError").innerHTML = "This is not a valid e-mail address";
                    document.getElementById("email").focus();
                    emailError = "Error";
                } else if (mail != "") {
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        if (this.responseText == "true") {
                            emailErr = "Email Already Exists.";
                            document.getElementById("emailError").innerHTML = emailErr;
                        } else if (this.responseText == "false") {
                            emailErr = "";
                            document.getElementById("emailError").innerHTML = emailErr;
                        }
                    };
                    xhttp.open("GET", "../controller/check_dup_email.php?mail=" + mail);
                    xhttp.send();
                } else {
                    emailError = "";
                    document.getElementById("emailError").innerHTML = "";
                }
            }
            if (emailError != "") {
                return false;
            } else if (emailError == "") {
                return true;
            }
        }

        function genderVerification() {


            if (document.getElementById("m").checked == false && document.getElementById("f").checked == false && document.getElementById("p").checked == false) {
                document.getElementById("genderError").innerHTML = "Gender is required";
                genderError = "Error";
                return false;

            } else {
                genderError = "";
                document.getElementById("genderError").innerHTML = "";
                return true;
            }
        }

        function editprofilevalidation() {

            var x = document.getElementById("name").value;
            x = x.replace(/(^\s*)|(\s*$)/gi, "");
            x = x.replace(/[ ]{2,}/gi, " ");
            x = x.replace(/\n /, "\n");
            var z = x.split(" ").length;
            var nameError = "";
            var passError = "";
            var cpassError = "";
            var emailError = "";
            var genderError = "";

            if (x == "") {
                document.getElementById("nameError").innerHTML = "Name is required";
                nameError = "Error";
            } else {
                if ((/[A-Za-z]/.test(x[0])) == false) {
                    document.getElementById("nameError").innerHTML = "Name must start with a letter";
                    nameError = "Error";
                } else if (z < 2) {
                    document.getElementById("nameError").innerHTML = "Name must contain at least two words";
                    nameError = "Error";
                } else {
                    nameError = "";
                    document.getElementById("nameError").innerHTML = "";
                }
            }
            var pass = document.getElementById("pas").value;
            if (pass == "") {
                document.getElementById("passError").innerHTML = "Password is required";
                passError = "Error";
            } else {
                if ((/[a-z]+/.test(pass)) == false) {
                    document.getElementById("passError").innerHTML = "Password must contain at least one small letter";
                    passError = "Error";
                } else if ((/[0-9]+/.test(pass)) == false) {
                    document.getElementById("passError").innerHTML = "Password must contain at least one number";
                    passError = "Error";
                } else if (pass.length < 8) {
                    document.getElementById("passError").innerHTML = "Password should contain at least 8 characters";
                    passError = "Error";
                } else {
                    passError = "";
                    document.getElementById("passError").innerHTML = "";
                }
            }
            var Cpass = document.getElementById("Cpass").value;
            if (Cpass == "") {
                document.getElementById("cpassError").innerHTML = "Confirm Password is required";
                cpassError = "Error";
            } else {
                if (Cpass != pass) {
                    document.getElementById("cpassError").innerHTML = "Re-type password must be matched with password";
                    cpassError = "Error";
                } else {
                    cpassError = "";
                    document.getElementById("cpassError").innerHTML = "";
                }
            }

            email = document.getElementById("email").value;
            var validRegex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

            if (email == "") {
                document.getElementById("emailError").innerHTML = "Email is required";
                document.getElementById("email").focus();
                emailError = "Error";

            } else {
                if (!document.getElementById("email").value.match(validRegex)) {
                    document.getElementById("emailError").innerHTML = "This is not a valid e-mail address";
                    document.getElementById("email").focus();
                    emailError = "Error";
                } else if (email != "") {
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        if (this.responseText == "true") {
                            emailErr = "Email Already Exists.";
                            document.getElementById("emailError").innerHTML = emailErr;
                        } else if (this.responseText == "false") {
                            emailErr = "";
                            document.getElementById("emailError").innerHTML = emailErr;
                        }
                    };
                    xhttp.open("GET", "../controller/check_dup_email.php?mail=" + email);
                    xhttp.send();
                } else {
                    emailError = "";
                    document.getElementById("emailError").innerHTML = "";
                }
            }


            if (document.getElementById("m").checked == false && document.getElementById("f").checked == false && document.getElementById("p").checked == false) {
                document.getElementById("genderError").innerHTML = "Gender is required";
                genderError = "Error";
            } else {
                genderError = "";
                document.getElementById("genderError").innerHTML = "";
            }
            if (nameError != "" || passError != "" || cpassError != "" || genderError != "" || emailError != "") {
                return false;
            } else if (nameError == "" && passError == "" && cpassError == "" && genderError == "" && emailError == "") {
                return true;
            }


        }
    </script>

</body>

</html>