<?php
$o_p_Error=$n_passwordError=$cn_passwordError="";

if(isset($_POST["change"])){
    $O_Password=$_POST["o_password"];
    $N_Password=$_POST["n_password"];
    $CN_Password=$_POST["cn_password"];
    if (empty($_POST["o_password"])) {
        $o_p_Error = "Old Password Cannot be Empty";
    } else {
        if (strlen(($_POST["o_password"])) < 8) {
            $o_p_Error = "At least 8 character needed";
        } else {
            if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["o_password"])) {
                $o_p_Error = "At least one special character needed";
            }
        }
    } 
    
    if (empty($_POST["n_password"])) {
        $n_passwordError = "New Password Cannot be Empty";
    } else {
        if ($O_Password==$N_Password) {
            $n_passwordError = "Old Password and New Password Cannot be Same";
        } else {
            if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["n_password"])) {
                $n_passwordError = "At least one special character needed";
            }else if(strlen($_POST["n_password"])<8){
                $n_passwordError="At least 8 characters Needed";
            }
        }
    }

    if(empty($_POST["cn_password"])){
        $cn_passwordError="Confirm Password Cannot be Empty";
    }else{
        if($N_Password!=$CN_Password){
            $cn_passwordError="New and Confirm new password must be same";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="../css/change_password_styles.css">
    <body>
        <fieldset>
        <legend><b>Change Password</b></legend>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <br>
            <label>Old Password </label><br>
            <input type="text" id="o_password" name="o_password" placeholder="Old Password"><span class="errors">
                <?php
                if($o_p_Error!=""){
                    echo "* - ".$o_p_Error;
                }
                ?>
            </span><br><br>
            <label style="color: green;">New Password </label><br>
            <input type="text" id="n_password" name="n_password" placeholder="New Password"><span class="errors">
                <?php
                if($n_passwordError!=""){
                    echo "* - ".$n_passwordError;
                }
                ?>
            </span><br><br>
            <label style="color:red">Confirm New Password </label><br>
            <input type="text" id="cn_password" name="cn_password" placeholder="Confirm New Password"><span class="errors">
               <?php
               if($cn_passwordError!=""){
                   echo "* - ".$cn_passwordError;
               }
               ?>
            </span><br><br>
            <input type="submit" value="Change Password" name="change" class="button1">
            <a href="login_page.php" target="_self"><label class="lg_style">Go to Login Page</label></a>
            </form>
        </fieldset>
    </body>
</html>