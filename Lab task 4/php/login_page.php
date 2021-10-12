<?php
session_start();

$usernameError=$passwordError="";
$ConfirmMessage=$ErrorMessage="";
$Name=$Gender=$DOB=$Username="";
$image_link="";

if(isset($_POST["login"])){
    if(isset($_POST["remember"])){
        setcookie('uname',$_POST['username'],time()+20);
        setcookie('c_pass',$_POST['password'],time()+20);
        $_SESSION['Username']=$_POST["username"];
        $_SESSION['Password']=$_POST["password"];
        $user=$_SESSION['Username'];
        $pass=$_SESSION['Password'];
        if (empty($_POST["username"])) {
            $usernameError = "Username is Required";
        } else {
            if (((!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $Username))) && (strlen($_POST["username"]) < 2)) {
                $usernameError = "Username can only contain alphanumeric characters dash and underscore only and at least 2 characters";
            }
        }
        
        if (empty($_POST["password"])) {
            $passwordError = "Password is Required";
        } else {
            if (strlen(($_POST["password"])) < 8) {
                $passwordError = "At least 8 character needed";
            } else {
                if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
                    $passwordError = "At least one special character needed";
                }
            }
        }
        
        $isFound=false;
    
        if($usernameError=="" && $passwordError==""){
            $data_s = file_get_contents("../json/data.json");  
            $data_s = json_decode($data_s, true); 
                foreach($data_s as $row){
                    if($row["Username"]==$user && $row["Password"]==$pass){
                    $isFound=true;
                    break;
                    }
                }
            }
    
            if($isFound){
                 $ConfirmMessage="";
                 header("location:dashboard.php");
            }else{
                 $ErrorMessage="Wrong Username or Password";
            }
    }else{
        $_SESSION['Username']=$_POST["username"];
        $_SESSION['Password']=$_POST["password"];
        $user=$_SESSION['Username'];
        $pass=$_SESSION['Password'];
        if (empty($_POST["username"])) {
            $usernameError = "Username is Required";
        } else {
            if (((!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $Username))) && (strlen($_POST["username"]) < 2)) {
                $usernameError = "Username can only contain alphanumeric characters dash and underscore only and at least 2 characters";
            }
        }
        
        if (empty($_POST["password"])) {
            $passwordError = "Password is Required";
        } else {
            if (strlen(($_POST["password"])) < 8) {
                $passwordError = "At least 8 character needed";
            } else {
                if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
                    $passwordError = "At least one special character needed";
                }
            }
        }
        
        $isFound=false;
    
        if($usernameError=="" && $passwordError==""){
            $data_s = file_get_contents("../json/data.json");  
            $data_s = json_decode($data_s, true); 
                foreach($data_s as $row){
                    if($row["Username"]==$user && $row["Password"]==$pass){
                    $isFound=true;
                    break;
                    }
                }
            }
    
            if($isFound){
                 $ConfirmMessage="";
                 header("location:dashboard.php");
            }else{
                 $ErrorMessage="Wrong Username or Password";
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
            <h1>Log into the system</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div class="text-field">
            <label>Username</label>
                <input type="text" id="username" name="username" value="<?php if(isset($_COOKIE['uname'])) {echo $_COOKIE['uname'];} ?>"><br>
                <span style="color:red">
                <?php
                if($usernameError!=""){
                    echo $usernameError;
                }
                ?>
                </span>
            </div>
            <div class="text-field">
                <label>Password</label>
            <input type="password" id="pass" name="password" value="<?php if(isset($_COOKIE['c_pass'])) {echo $_COOKIE['c_pass'];} ?>">&nbsp;
            
            <br> 
            
            <span>
                <?php
                if($passwordError!=""){
                    echo $passwordError;
                }
                ?>
             </span>
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

            </div>
            <div>
            <input type="checkbox" onclick="myFunction()"> Show Password <br><br>
                <input type="checkbox" id="remember" name="remember"> Remember Password
            </div><br><br>
            <a href="forgot_password.php" style="text-decoration: none;"><div class="pass">Forgot Password?</div></a>
            <input type="submit" name="login" value="Login"><br><br>
            <span style="color:red">
                <?php
                if($ErrorMessage!=""){
                    echo $ErrorMessage;
                }
                ?>
            </span>
            <div class="sign-up">Not a Member Yet? <a href="registration_form.php">Sign Up</a></div>
      </form>
      </div>

    </body>
</html>