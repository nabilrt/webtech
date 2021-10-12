<?php

    session_start();
    $isFound=false;
    $confirm_msg="";

    if(isset($_SESSION['Username'])){
     
        $data = file_get_contents("../json/data.json");  
        $data = json_decode($data, true); 
        foreach($data as $key=>$value){
            if($value['Username']==$_SESSION["Username"]){
            $Name=$value['Name'];
            $image_link=$value['Image']; 
            $Gender=$value['Gender'];
            $Username=$value['Username']; 
            $DOB=$value['DOB'];
            $Password=$value['Password'];
            $isFound=true;
            break;
            }
        }
        if($isFound){
             $ConfirmMessage="";
        }else{
             $ErrorMessage="Wrong Username or Password";
        }

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



    if($n_passwordError=="" && $o_p_Error=="" && $cn_passwordError==""){
        $confirm_msg = "Password Changed Successfully";
    }
}
    

    }else{
        header("location:login_page.php");
    }
       


?>

<?php

include 'top-navbar1.php';

?>

<html>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard_styles.css">
    <body>
    <br><br>
    <div class="sign-up" style="font-family: Arial;">
    <?php  
    echo "<img src= ".$image_link." height='150px' width='150px'><br><br>";
    echo "Welcome , ".$Name;
    ?>
    <br>
    <a href="login_page.php" target="_self" class="links">Log out</a>
    </div>
    <div>
    <table class="table">
        <thead>
            <th style="color: black;">Account<hr></th>
            <th> </th>
        </thead>
        <tr>
        <td style="color: black; font-family:Century Gothic">
            <ul style="list-style-type:none">
                <ii><a href="dashboard.php" style="text-decoration: none; color:royalblue; list-style-type:none">Dashboard</a></ii>
                <li><a href="view_profile.php" style="text-decoration: none; color:royalblue; list-style-type:none">View Profile</a></li>
                <li><a href="edit_profile.php" style="text-decoration: none; color:royalblue; list-style-type:none">Edit Profile</a></li>
                <li><a href="change_dp.php" style="text-decoration: none; color:royalblue; list-style-type:none">Change Profile Picture</a></li>
                <li><a href="change_pass.php" style="text-decoration: none; color:royalblue; list-style-type:none">Change Password</a></li>
                <li><a href="logout.php" style="text-decoration: none; color:royalblue; list-style-type:none">Log out</a></li>
            </ul>
        </td>
        <td>
        <fieldset>
        <legend style="color: black; font-family:Footlight MT; font-size:20px"><b>Change Password</b></legend>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <br>
            <label style="color: black; font-family:Footlight MT; font-size:20px">Old Password </label><br>
            <input type="password" id="o_password" name="o_password" placeholder="Old Password" value=<?php
            echo $Password;
            ?>
            >
            <span class="errors">
                <?php
                if($o_p_Error!=""){
                    echo "* - ".$o_p_Error;
                }
                ?>
            </span><br><br>
            <script>
            function myFunction1() {
            var x = document.getElementById("o_password");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
            }
           </script>
           <input type="checkbox" onclick="myFunction1()"> Show Password <br><br>
            <label style="color: green; font-family:Footlight MT; font-size:20px">New Password </label><br>
            <input type="password" id="n_password" name="n_password" placeholder="New Password"><span class="errors">
                <?php
                if($n_passwordError!=""){
                    echo "* - ".$n_passwordError;
                }
                ?>
            </span><br><br>
            <script>
            function myFunction2() {
            var x = document.getElementById("n_password");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
            }
           </script>
           <input type="checkbox" onclick="myFunction2()"> Show Password <br><br>
            <label style="color:red; font-family:Footlight MT; font-size:20px">Confirm New Password </label><br>
            <input type="password" id="cn_password" name="cn_password" placeholder="Confirm New Password"><span class="errors">
               <?php
               if($cn_passwordError!=""){
                   echo "* - ".$cn_passwordError;
               }
               ?>
            </span><br><br>
            <script>
            function myFunction3() {
            var x = document.getElementById("cn_password");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
            }
           </script>
           <input type="checkbox" onclick="myFunction3()"> Show Password <br><br>
            <input type="submit" value="Change Password" name="change" class="button1">
            <span style="color:green">
                <?php

                if($confirm_msg!=""){
                    echo $confirm_msg;
                }
                
                ?>
            </span>
            </form>
        </fieldset>
        </td>
        </tr>
    </table> 
    </div><br><br><br><br><br><br><br><br>
    <?php
    include 'footer.php';
    ?>
    </body>
</html>