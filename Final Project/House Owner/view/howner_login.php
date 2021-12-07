<?php
session_start();
$NIDNo = $Password = "";
$nidErr = $passErr = "";
$ErrorLogin = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["login"])) {

    $NIDNo = test_input($_POST["nid"]);
    $Password = test_input($_POST["pass"]);

    $data = array(
        'NID' => $NIDNo,
        'Password' => $Password,
        'Message' => ""
    );

    require_once '../controller/login_validate.php';

    $h_owner_login = new login($data);

    $h_owner_login->check_login($data);
    $error = $h_owner_login->get_error();
    $message = $h_owner_login->get_message();
    $err_msg = $h_owner_login->error_message();

    $nidErr = $error["nidErr"];
    $passErr = $error["passwordErr"];


    if (isset($_POST["remember"])) {
        setcookie('nid', $_POST['nid'], time() + 20);
        setcookie('password', $_POST['pass'], time() + 20);
        if ($message != "") {
            $_SESSION["NID"] = $NIDNo;
            header("location:h_owner_dashboard.php");
        } else {
            $ErrorLogin = $err_msg;
        }
    } else {
        if ($message != "") {
            $_SESSION["NID"] = $NIDNo;
            header("location:h_owner_dashboard.php");
        } else {
            $ErrorLogin = $err_msg;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../css/login_styles.css">

<body>
    <div class="center">
        <h1>House Owner Login</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return login_validation()">
            <div class="text-field">
                <label>NID No.</label><br>
                <input type="text" name="nid" id="login_nid" onkeyup="return nid_validate()" onblur="return nid_validate()" value="<?php if (isset($_COOKIE['nid'])) {
                                                                                                                                        echo $_COOKIE['nid'];
                                                                                                                                    } ?>"><br>
            </div>
            <div class="text-field">
                <span id="nid_Error" style="color:red">
                    <?php
                    if ($nidErr != "") {
                        echo $nidErr;
                    }
                    ?>
                </span><br><br>
                <label>Password</label><br>
                <input type="password" name="pass" id="login_pass" onkeyup="return pass_validate()" onblur="return pass_validate()" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                                echo $_COOKIE['password'];
                                                                                                                                            } ?>"><br>
                <script>
                    function myFunction() {
                        var x = document.getElementById("login_pass");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
            </div>
            <span id="pass_Error" style="color:red">
                <?php
                if ($passErr != "") {
                    echo $passErr;
                }
                ?>
            </span><br><br>
            <div>
                <input type="checkbox" onclick="myFunction()"> Show Password <br><br>
                <input type="checkbox" name="remember"> Remember Me
            </div> <br><br>
            <input type="submit" id="login" value="Login" name="login"><br><br>
            <?php
            if ($ErrorLogin != "") {
                echo "<span style='color:red'>" . $ErrorLogin . "</span>";
            }
            ?>
            <div class="sign-up">Not a Member Yet? <a href="howner_reg.php">Sign Up</a></div>
        </form>
    </div>
    <script type="text/javascript" src="../js/form_validations.js"></script>
</body>

</html>