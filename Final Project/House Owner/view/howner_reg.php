<?php
$Name = $Email = $Password = $Confirm_Password = $Gender = $NID = "";
$nameError = $emailError = $dobError = $usernameError = $genderErr = $nidError = "";
$passError = $cpassError = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["register"])) {
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

    $data = array(
        'Name' => $Name,
        'Email' => $Email,
        'NID' => $NID,
        'Password' => $Password,
        'Confirm_Password' => $Confirm_Password,
        'Gender' => $Gender
    );


    require_once "../controller/create_h_owner.php";
    $h_owner = new addHouseOwner($data);

    $h_owner->addData($data);

    $error = $h_owner->get_error();
    $message = $h_owner->get_message();

    $nameError = $error["nameErr"];
    $emailError = $error["emailErr"];
    $nidError = $error["nidErr"];
    $passError = $error["passwordErr"];
    $cpassError = $error["confirm_passwordErr"];
    $genderErr = $error["genderErr"];
}



?>
<br>
<!DOCTYPE html>
<html>
<title>House Owner Registration</title>
<link rel="shortcut icon" href="../images/logo-home.ico">
<!--Importing bootstrap 5-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fuzzy+Bubbles&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/registration_styles.css">

<body class="bd">
    <div class="container-sm mb-6 mt-3 bg-light shadow" style="background: linear-gradient(to right, #c9d6ff, #e2e2e2);">
        <div>
            <h1 style="font-family: 'Lobster', cursive; color:#2193b0;">House Owner Registration Form</h1>
            <h4 style="color:red; font-family: 'Fuzzy Bubbles', cursive;">Please provide genuine informations</h4>
        </div>

        <div class="form-group">
            <form method="POST" class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return form_validate()">
                <div class="col-md-6">
                    <label class="form-label">Name</label><br>
                    <input type="text" name="name" id="name" value="" placeholder="Full Name" class="form-control" onkeyup="return name_verify()" onblur="return name_verify()" data-toggle="tooltip" data-placement="top" title="Enter your name (must have two words at least and no special characters)">
                    <span id="nameError" style="color: red;"><?php
                                                                if ($nameError != "") {
                                                                    echo "* - " . $nameError;
                                                                }
                                                                ?></span><br>
                </div>
                <div class="col-md-6">
                    <label class="form-label">National ID</label><br>
                    <input type="text" name="nid" id="nid" value="" placeholder="NID No." class="form-control" onkeyup="return nidVerify()" onblur="return nidVerify()" data-toggle="tooltip" data-placement="top" title="Enter your nid (should be numbers and must have 10 digits)">
                    <span id="nidError" style="color: red;"><?php
                                                            if ($nidError != "") {
                                                                echo "* - " . $nidError;
                                                            }
                                                            ?></span><br>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label><br>
                    <input type="password" name="pass" id="pass" placeholder="Password" value="" class="form-control" onkeyup="return passVerify()" onblur="return passVerify()" data-toggle="tooltip" data-placement="top" title="Enter password (should be 8 characters at least and one special character in it)">
                    <span id="passError" style="color: red;"><?php
                                                                if ($passError != "") {
                                                                    echo "* - " . $passError;
                                                                }
                                                                ?></span>
                    <br>
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
                    <input type="checkbox" onclick="myFunction()" class="form-check-input"> Show Password <br>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label><br>
                    <input type="password" name="c_pass" id="c_pass" value="" placeholder="Confirm Password" class="form-control" onkeyup="return cpassVerify()" onblur="return cpassVerify()" data-toggle="tooltip" data-placement="top" title="Re-enter password (must match with original password)">
                    <span id="cpassError" style="color: red;">
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
                    <input type="checkbox" onclick="myFunction1()" class="form-check-input"> Show Password <br>
                </div>
                <div class="col-12">
                <label class="form-label">Email</label><br>
                <input type="text" name="email" id="email" value="" placeholder="Email" class="form-control" onkeyup="return emailVerify()" onblur="return emailVerify()" data-toggle="tooltip" data-placement="top" title="Enter a valid email address">
                <span id="emailError" style="color: red;"><?php
                                                            if ($emailError != "") {
                                                                echo "* - " . $emailError;
                                                            }
                                                            ?></span><br>
                </div>

                <label class="form-check-label">Gender</label>
                <div class="form-check form-check-inline">
                <input type="radio" id="m" name="gender" value="Male" class="form-check-input"><label for="m" class="form-check-label">&nbsp;Male</label></div>
                <div class="form-check form-check-inline">
                <input type="radio" id="f" name="gender" value="Female" class="form-check-input"><label for="f" class="form-check-label">&nbsp;Female</label></div>
                <div class="form-check form-check-inline">
                <input type="radio" id="p" name="gender" value="Prefer not to Say" class="form-check-input"><label for="p" class="form-check-label">&nbsp;Prefer Not to Say</label></div>
                <span id="genderError" style="color: red;">
                    <?php
                    if ($genderErr != "") {
                        echo "* - " . $genderErr;
                    }
                    ?></span><br>
                    <div class="col-12">
                <input type="submit" name="register" value="Submit" class="btn btn-success" style="background: linear-gradient(to right, #2980b9, #6dd5fa, #ffffff); color:black">
                <a href="../../Login Module/view/homepage.php" class="btn btn-outline-dark" target="_self" class="button1"> Go to Homepage</a><br>
                <?php
                if (isset($message)) {
                    echo "<span style='color:green'><b>" . $message . "</b></span><br>";
                }
                ?>
                    </div>
            </form><br>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script type="text/javascript" src="../js/form_validations.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#m').change(function() {
            $('#genderError').html("");
        })

        $('#f').change(function() {
            $('#genderError').html("");
        })

        $('#p').change(function() {
            $('#genderError').html("");
        })
    </script>
</body>

</html>