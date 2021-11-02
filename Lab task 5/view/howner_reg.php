<?php
$Name = $Email = $Password = $Confirm_Password = $Gender = $NID = "";
$day = $month = $year = 0;
$nameError = $emailError = $dobError = $usernameError = $genderErr = $nidError = "";
$passError = $cpassError = "";
$ImageError = $UploadConfirmation = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST["register"])){
    $Name = test_input($_POST["name"]);
    $Email = test_input($_POST["email"]);
    $NID =  test_input($_POST["nid"]);
    $Password = $_POST["pass"];
    $Confirm_Password = $_POST["c_pass"];
    if(!empty($_POST["gender"])){
        $Gender=$_POST["gender"];
    }
    else{
        $Gender="";
    }

    $data= array(
        'Name'=> $Name,
        'Email'=>$Email,
        'NID'=>$NID,
        'Password'=>$Password,
        'Confirm_Password'=>$Confirm_Password,
        'Gender'=>$Gender
    );


    require_once "../controller/create_h_owner.php";
    $h_owner= new addHouseOwner($data);

    $h_owner->addData($data);

    $error=$h_owner->get_error();
    $message=$h_owner->get_message();

    $nameError=$error["nameErr"];
    $emailError=$error["emailErr"];
    $nidError=$error["nidErr"];
    $passError=$error["passwordErr"];
    $cpassError=$error["confirm_passwordErr"];
    $genderErr=$error["genderErr"];

}



?>
<br>
<!DOCTYPE html>
<html>
    <title>House Owner Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/registration_styles.css">
    <body>
    <h1>House Owner Registration Form</h1>
    <h4 style="color:red">Please Fill it with correct informations</h4>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label>Name</label><br>
    <input type="text" name="name" id="name" value="" placeholder="Full Name"><span style="color: red;"><?php
                if ($nameError != "") {
                    echo "* - " . $nameError;
                }
                ?></span><br><br>
    <label>National ID</label><br>
    <input type="text" name="nid" id="nid" value="" placeholder="NID No."><span style="color: red;"><?php
                if ($nidError!="") {
                    echo "* - " . $nidError;
                }
                ?></span><br><br>
    <label>Password</label><br>
    <input type="password" name="pass" id="pass" placeholder="Password" value=""><span style="color: red;"><?php
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
    <input type="password" name="c_pass" id="c_pass" value="" placeholder="Confirm Password"><span style="color: red;"><?php
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
    <input type="text" name="email" id="email" value="" placeholder="Email"><span style="color: red;"><?php
                if ($emailError != "") {
                    echo "* - " . $emailError;
                }
                ?></span><br><br>
    <label>Gender</label>&nbsp;
    <input type="radio" id="gender" name="gender" value="Male">Male&nbsp;
    <input type="radio" id="gender" name="gender" value="Female">Female&nbsp;
    <input type="radio" id="gender" name="gender" value="Prefer not to Say">Prefer not to say&nbsp;<span style="color: red;"><?php
                if ($genderErr != "") {
                    echo "* - " . $genderErr;
                }
                ?></span><br><br>
    <input type="submit" name="register" value="Submit">&nbsp; <a href="homepage.php" target="_self" class="button1"> Go to Homepage</a><br>
    <?php
            if (isset($message)) {
                echo "<span style='color:green'><b>" . $message . "</b></span><br>";
            }
    ?>
    </form>
    <?php
    include 'footer.php';
    ?>
    </body>
</html>