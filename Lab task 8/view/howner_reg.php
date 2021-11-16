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
<!--Importing bootstrap 5-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/registration_styles.css">

<body class="bd">
<div class="container-sm mb-6 mt-3 bg-light shadow">
    <div>
    <h1><b>House Owner Registration Form</b></h1>
    <h4 style="color:red">Please Fill it with correct informations</h4>
</div>

    <div class="form-group">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return form_validate()">
        <label>Name</label><br>
        <input type="text" name="name" id="name" value="" placeholder="Full Name" class="form-control" onkeyup="return name_verify()" onblur="return name_verify()"  data-toggle="tooltip" data-placement="top" title="Enter your name (must have two words at least and no special characters)">
        <span id="nameError" style="color: red;"><?php
        if ($nameError != "") {
        echo "* - " . $nameError;
        }
        ?></span><br><br>
        <label>National ID</label><br>
        <input type="text" name="nid" id="nid" value="" placeholder="NID No." class="form-control" onkeyup="return nidVerify()" onblur="return nidVerify()" data-toggle="tooltip" data-placement="top" title="Enter your nid (should be numbers and must have 10 digits)">
        <span id="nidError" style="color: red;"><?php
        if ($nidError != "") {
        echo "* - " . $nidError;
        }
        ?></span><br><br>
        <label>Password</label><br>
        <input type="password" name="pass" id="pass" placeholder="Password" value="" class="form-control" onkeyup="return passVerify()" onblur="return passVerify()" data-toggle="tooltip" data-placement="top" title="Enter password (should be 8 characters at least and one special character in it)">
        <span id="passError" style="color: red;"><?php
        if ($passError != "") {
        echo "* - " . $passError;
        }
        ?></span>
        <br><br>
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
        <input type="checkbox" onclick="myFunction()"> Show Password <br><br>
        <label>Confirm Password</label><br>
        <input type="password" name="c_pass" id="c_pass" value="" placeholder="Confirm Password" class="form-control" onkeyup="return cpassVerify()" onblur="return cpassVerify()" data-toggle="tooltip" data-placement="top" title="Re-enter password (must match with original password)">
        <span id="cpassError" style="color: red;">
        <?php
         if ($cpassError != "") {
         echo "* - " . $cpassError;
         }
        ?></span><br><br>
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
        <input type="checkbox" onclick="myFunction1()"> Show Password <br><br>
        <label>Email</label><br>
        <input type="text" name="email" id="email" value="" placeholder="Email" class="form-control" onkeyup="return emailVerify()" onblur="return emailVerify()" data-toggle="tooltip" data-placement="top" title="Enter a valid email address">
        <span id="emailError" style="color: red;"><?php
         if ($emailError != "") {
         echo "* - " . $emailError;
         }
        ?></span><br>
        <label>Gender</label>&nbsp;
        <input type="radio" id="m" name="gender" value="Male"> Male&nbsp;
        <input type="radio" id="f" name="gender" value="Female"> Female&nbsp;
        <input type="radio" id="p" name="gender" value="Prefer not to Say"> Prefer not to say&nbsp;
        <span id="genderError" style="color: red;">
        <?php
        if ($genderErr != "") {
        echo "* - " . $genderErr;
        }
        ?></span><br>
        <input type="submit" name="register" value="Submit" class="btn btn-success">&nbsp; <a href="homepage.php" class="btn btn-outline-dark" target="_self" class="button1"> Go to Homepage</a><br>
        <?php
        if (isset($message)) {
            echo "<span style='color:green'><b>" . $message . "</b></span><br>";
        }
        ?>
    </form>
    </div>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script type="text/javascript" src="../js/form_validations.js"></script>
</body>
</html>