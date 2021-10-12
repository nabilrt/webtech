<?php

$EmailError="";
$Confirmation="";
$ErrorMessage="";

if(isset($_POST["submit"])){
    $Email=$_POST["email"];

    if(empty($_POST["email"])){
        $EmailError="Field Cannot be Empty";
    }else {
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $EmailError = "Invalid Email Format Type it correctly";
    }
    }

    $isFound=false;

    if($EmailError==""){
        $data = file_get_contents("../json/data.json");  
        $data = json_decode($data, true); 
        foreach($data as $key=>$value){
            if($value['Email']==$Email){
            $isFound=true;
            break;
            }
        }
        if($isFound){
             $Confirmation="Instructions Sent To Your Email";
        }else{
             $ErrorMessage="Email not Found";
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="../css/forgot_password_styles.css">
    <body>
        <div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
             <fieldset>
                 <br>
                 <legend><b>RESET PASSWORD</b></legend>
                 <label>Enter Your Email </label><br>
                 <input type="text" id="email" name="email" placeholder="Email"><span class="errors">
                     <?php
                     if($EmailError!=""){
                         echo "* - ".$EmailError;
                     }
                     else if($ErrorMessage!=""){
                         echo "* - ".$ErrorMessage;
                     }
                     ?>
                 </span><br><br>
                 <input type="submit" value="Reset Password" name="submit" class="button1"><br><br>
                 <span style="color: green;">
                 <?php
                 if($Confirmation!=""){
                     echo $Confirmation;
                 }
                 ?>
                 </span>
                 <a href="login_page.php">Go Back to Login Page</a>
             </fieldset>
            </form>
        </div>
        <?php
    include 'footer.php';
    ?>
    </body>
</html>