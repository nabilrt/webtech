<?php
session_start();
$NIDNo=$Password="";
$nidErr=$passErr="";
$ErrorLogin="";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST["login"])){

    $NIDNo=test_input($_POST["nid"]);
    $Password=test_input($_POST["pass"]);

    $data=array(
        'NID'=>$NIDNo,
        'Password'=>$Password,
        'Message'=>""
    );

    require_once '../controller/check_login.php';

    $accountant_login=new login($data);

    $accountant_login->check_login($data);
    $error=$accountant_login->get_error();
    $message=$accountant_login->get_message();
    $err_msg=$accountant_login->error_message();
    $nidErr=$error["nidErr"];
    $passErr=$error["passwordErr"];


    if(isset($_POST["remember"])){

        setcookie('nid',$_POST['nid'],time()+15);
        setcookie('password',$_POST['pass'],time()+15);
        if($message!=""){
            $_SESSION["NID"] = $NIDNo;
            header("location:accountant_dashboard.php");
        }
        else{
            $ErrorLogin=$err_msg;
        }
    }
    else{
        if($message!=""){
            $_SESSION["NID"] = $NIDNo;
            header("location:accountant_dashboard.php");
        }
        else{
            $ErrorLogin=$err_msg;
        }
    }

}
?>
<!DOCTYPE html>
<html>
    <title>Login</title>
    <div>
        <fieldset>
            <legend style="color:blue">Login</legend>
    <h1>Accountant Login Form</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div>
    <label>NID No.</label><br>
    <input type="text" name="nid" id="nid" value="<?php if(isset($_COOKIE['nid'])) {echo $_COOKIE['nid'];} ?>">
    <span style="color:red">
    <?php
    if($nidErr!=""){
        echo $nidErr;
    }
    ?>
    </span></div>
    <div>
    <label>Password</label><br>
    <input type="password" name="pass" id="pass" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>"> <span style="color:red">
    <?php
    if($passErr!=""){
        echo $passErr;
    }
    ?>
    </span><br>
     </div>
     <div><br>
    <input type="checkbox" name="remember"> Remember Me</div> <br><br>
    <input type="submit" id="login" value="Login" name="login"><br><br>
    <?php
    if($ErrorLogin!=""){
        echo "<span style='color:red'>Invalid Id or Password"."</span>";
    }
    ?>
    </form>
    </div>
</fieldset>
</html>