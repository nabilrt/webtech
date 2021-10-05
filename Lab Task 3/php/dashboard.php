<?php

$usernameError=$passwordError="";
$ConfirmMessage=$ErrorMessage="";
$Name=$Gender=$DOB=$Username="";
$image_link="";

$Username=$_POST["username"];
$Password=$_POST["password"];

if(isset($_POST["login"])){
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
        $data = file_get_contents("../json/data.json");  
        $data = json_decode($data, true); 
        foreach($data as $key=>$value){
            if($value['Username']==$Username && $value['Password']==$Password){
            $Name=$value['Name'];
            $image_link=$value['Image']; 
            $Gender=$value['Gender'];
            $Username=$value['Username']; 
            $DOB=$value['DOB'];
            $isFound=true;
            break;
            }
        }
        if($isFound){
             $ConfirmMessage="";
        }else{
             $ErrorMessage="Wrong Username or Password";
        }
    }
}

?>

<html>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard_styles.css">
    <body>
    <?php
    if($usernameError!=""){
        echo $usernameError."<br>";
    }
    if($passwordError!=""){
        echo $passwordError;
    }
    if($ConfirmMessage!=""){
        echo $ConfirmMessage;
    }
    if($ErrorMessage!=""){
        echo $ErrorMessage;
    }
    ?>
    <div class="sign-up" style="font-family: Arial;">
    <?php  
    echo "<img src= ".$image_link." height='150px' width='150px'><br><br>";
    echo "Welcome , ".$Name;
    ?>
    <br>
    <a href="login_page.php" target="_self" class="links">Log out</a>
    </div>
    <div>
    <fieldset style="font-family: Arial, Helvetica, sans-serif;">
     <legend style="color: royalblue; font-family:Arial, Helvetica, sans-serif"> MY PROFILE </legend>
     <?php
      echo "Picture <br>";
      echo "<img src= ".$image_link." height='150px' width='150px'><br><br>";
      echo "Username       : ".$Username."<br><br>";
      echo "Name           : ".$Name."<br><br>";
      echo "Gender         : ".$Gender."<br><br>";
      echo "Date of Birth  : ".$DOB."<br><br>";
     ?>
     <a href="change_password.php" target="_self">Change Password</a>
    </fieldset>   
    </div>
    </body>
</html>