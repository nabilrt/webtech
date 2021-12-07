<?php
$Name = $Email = $Password = $Confirm_Password = $Gender = $NID = "";
$day = $month = $year = 0;
$nameError = $emailError = $dobError = $usernameError = $genderError = $nidError = "";
$passError = $cpassError = "";
$ImageError = $UploadConfirmation = "";
$imageError = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["register"])) {
    if (!empty($_FILES["fileToUpload"]["name"])) {

        $Name = test_input($_POST["name"]);
        $Email = test_input($_POST["email"]);
        $NID =  test_input($_POST["nid"]);
        $Password = $_POST["pass"];
        $Confirm_Password = $_POST["c_pass"];
        if (!empty($_POST["gender"])) {
            $Gender = $_POST["gender"];
        } else {
            $Gender = "";
        }

        $target_dir = "../files/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $Temp = $_FILES["fileToUpload"]["tmp_name"];
        $img_size = $_FILES["fileToUpload"]["size"];
        $filename = $_FILES['fileToUpload']['name'];

        $data = array(
            'Name' => $Name,
            'Email' => $Email,
            'NID' => $NID,
            'Password' => $Password,
            'Confirm_Password' => $Confirm_Password,
            'Gender' => $Gender,
            'Directory' => $target_dir,
            'Target_File' => $target_file,
            'ImageType' => $imageFileType,
            'Image_Size' => $check,
            'Img_Size' => $img_size,
            'File_Name' => $filename,
            'FilePath' => "",
            'Temporary' => $Temp
        );


        require_once "../controller/create_accountant.php";
        $accountant = new addAccountant($data);

        $accountant->addData($data);

        $error = $accountant->get_error();
        $message = $accountant->get_message();



        $nameError = $error["nameErr"];
        $emailError = $error["emailErr"];
        $nidError = $error["nidErr"];
        $passError = $error["passwordErr"];
        $cpassError = $error["confirm_passwordErr"];
        $genderError = $error["genderErr"];
        $imageError = $error["ImageErr"];
    } else {

        $imageError = "Select an Image First";
    }
}



?>
<br>
<!DOCTYPE html>
<html>
<title>Manager Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Murecho&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/registration_styles.css">

<body>
    <div class="container-sm mb-6 mt-3 bg-light shadow" style="background: linear-gradient(to right, #fceabb, #f8b500);">
        <div class="container">
            <h1 style="font-family: 'Murecho', sans-serif;">Manager Registration Form</h1>
            <h6 style="color:#ed213a; font-family: 'Dancing Script', cursive; font-size:25px">Please provide accurate information to join</h6>
            <br>
            <form method="POST" id="m_form" onsubmit="return dp_validate()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label><br>
                    <input type="text" name="name" id="name" value="" placeholder="Full Name" class="form-control" onkeyup="return name_verify()"><span id="nameError" style="color: red;"><?php
                                                                                                                                                                                            if ($nameError != "") {
                                                                                                                                                                                                echo "* - " . $nameError;
                                                                                                                                                                                            }
                                                                                                                                                                                            ?></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label">National ID</label><br>
                    <input type="text" name="nid" id="nid" value="" placeholder="NID No." class="form-control" onkeyup="return nidVerify()"><span id="nidError" style="color: red;"><?php
                                                                                                                                                                                    if ($nidError != "") {
                                                                                                                                                                                        echo "* - " . $nidError;
                                                                                                                                                                                    }
                                                                                                                                                                                    ?></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label><br>
                    <input type="password" name="pass" id="pass" placeholder="Password" value="" class="form-control" onkeyup="return passVerify()"><span id="passError" style="color:red">
                        <?php
                        if ($passError != "") {
                            echo "* - " . $passError;
                        }
                        ?>
                    </span>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label><br>
                    <input type="password" name="c_pass" id="c_pass" value="" placeholder="Confirm Password" class="form-control" onkeyup="return cpassVerify()"><span id="cpassError" style="color: red;"><?php
                                                                                                                                                                                                            if ($cpassError != "") {
                                                                                                                                                                                                                echo "* - " . $cpassError;
                                                                                                                                                                                                            }
                                                                                                                                                                                                            ?></span>
                </div>
                <div class="col-12">
                    <label class="form-label">Email</label><br>
                    <input type="text" name="email" id="email" value="" placeholder="Email" class="form-control" onkeyup="return emailVerify()">
                    <span id="emailError" style="color: red;"><?php
                                                                if ($emailError != "") {
                                                                    echo "* - " . $emailError;
                                                                }
                                                                ?></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bachelors Degree Picture</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control"><span id="ImageError" style="color:red">
                        <?php
                        if ($imageError != "") {
                            echo $imageError;
                        }
                        ?>
                    </span>
                </div>
                <div class="col-12">
                    <label class="form-check-label">Gender&nbsp;</label>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="m" name="gender" value="Male"><label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="f" name="gender" value="Female"><label class="form-check-label">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="p" name="gender" value="Prefer not to Say"><label class="form-check-label">Prefer not to say</label>
                    </div>
                    <span id="genderError" style="color: red;"><?php
                                                                if ($genderError != "") {
                                                                    echo "* - " . $genderError;
                                                                }
                                                                ?></span>
                </div>
                <div class="col-md-6">
                    <input type="submit" name="register" value="Submit" class="btn btn-warning">
                    <a href="../../Login Module/view/homepage.php" target="_self" class="btn btn-outline-dark">Go to Homepage</a>
                </div><br><br><br><br>
                <?php
                if (isset($message)) {
                    echo "<span style='color:green'><b>" . $message . "</b></span><br>";
                }
                ?>
            </form>
        </div>
    </div><br><br>
    <?php
    include 'footer.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function dp_validate() {

            var x = document.getElementById("name").value;
            x = x.replace(/(^\s*)|(\s*$)/gi, "");
            x = x.replace(/[ ]{2,}/gi, " ");
            x = x.replace(/\n /, "\n");
            var z = x.split(" ").length;
            var nameErr = "";
            var passErr = "";
            var cpassErr = "";
            var nidErr = "";
            var genderErr = "";
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
            var y = document.getElementById("nid").value;
            if (y == "") {
                document.getElementById("nidError").innerHTML = "NID Field Cannot Be Empty";
                nidErr = "Error";
            } else {
                if (isNaN(y) == true) {
                    document.getElementById("nidError").innerHTML = "NID can be numbers only";
                    nidErr = "Error";
                } else if (y.length != 10) {
                    document.getElementById("nidError").innerHTML =
                        "NID can consist of 10 digits only";
                    nidErr = "Error";
                } else {
                    nidErr = "";
                    document.getElementById("nidError").innerHTML = "";
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
            if (
                document.getElementById("m").checked == false &&
                document.getElementById("f").checked == false &&
                document.getElementById("p").checked == false
            ) {
                document.getElementById("genderError").innerHTML =
                    "Gender Field cannot be empty";
                genderErr = "Error";
            } else {
                genderErr = "";
                document.getElementById("genderError").innerHTML = "";
            }

            mail = document.getElementById("email").value;
            var validRegex =
                /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

            if (mail == "") {
                document.getElementById("emailError").innerHTML =
                    "Email Field cannot be empty";
                emailErr = "Error";
            } else {
                if (!document.getElementById("email").value.match(validRegex)) {
                    document.getElementById("emailError").innerHTML =
                        "Please enter a valid e-mail address";
                    emailErr = "Error";
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
                }
            }
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

            if (
                nameErr != "" ||
                nidErr != "" ||
                passErr != "" ||
                cpassErr != "" ||
                genderErr != "" ||
                emailErr != "" ||
                imgError != ""
            ) {
                return false;
            } else if (
                nameErr == "" &&
                nidErr == "" &&
                passErr == "" &&
                cpassErr == "" &&
                genderErr == "" &&
                emailErr == "" &&
                imgError == ""
            ) {
                return true;
            }

        }

        $('#fileToUpload').change(function() {

            $("#ImageError").html("");
        })

        $('#m').change(function() {
            $('#genderError').html("");
        })

        $('#f').change(function() {
            $('#genderError').html("");
        })

        $('#p').change(function() {
            $('#genderError').html("");
        })

        function nidVerify() {
            var form_ok = 0;
            var y = document.getElementById("nid").value;
            if (y == "") {
                document.getElementById("nidError").innerHTML = "NID Field Cannot Be Empty";
                document.getElementById("nid").focus();
                form_ok = 1;
            } else {
                if (isNaN(y) == true) {
                    document.getElementById("nidError").innerHTML = "NID can be numbers only";
                    document.getElementById("nid").focus();
                    form_ok = 1;
                } else if (y.length != 10) {
                    document.getElementById("nidError").innerHTML =
                        "NID can consist of 10 digits only";
                    document.getElementById("nid").focus();
                    form_ok = 1;
                } else if (y != "") {
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        if (this.responseText == "true") {
                            form_ok = 1;
                            er = true;
                            document.getElementById("nidError").innerHTML = "NID Already Exists";
                            document.getElementById("nid").focus();

                        } else if (this.responseText == "false") {
                            form_ok = 0;
                            er = false;
                            document.getElementById("nidError").innerHTML = "";
                        }
                    };
                    xhttp.open("GET", "../controller/check_dup_nid.php?nid=" + y);
                    xhttp.send();
                } else {
                    form_ok = 0;
                    document.getElementById("nidError").innerHTML = "";
                }
            }
            if (form_ok == 1 && er == true) {
                return false;
            } else if (form_ok == 0 && er == false) {
                return true;
            }
        }

        function emailVerify() {
            var emailErr = "";

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
                } else if (mail != "") {
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        if (this.responseText == "true") {
                            emailErr = "Email Already Exists.";
                            document.getElementById("emailError").innerHTML = emailErr;
                            document.getElementById("email").focus();
                        } else if (this.responseText == "false") {
                            emailErr = "";
                            document.getElementById("emailError").innerHTML = emailErr;
                        }
                    };
                    xhttp.open("GET", "../controller/check_dup_email.php?mail=" + mail);
                    xhttp.send();
                }
            }
            if (emailErr != "") {
                return false;
            } else if (emailErr == "") {
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
    </script>
</body>

</html>