<?php
session_start();
date_default_timezone_set("Asia/Dhaka");
$NID = "";
$nameError = $emailError = $dobError = $usernameError = $genderError = $nidError = "";
$passError = $cpassError = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
if(!isset($_SESSION["NID"])){
    session_destroy();
    header("location:howner_login.php");
}
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $_SESSION["NID"],
    );

    require_once '../controller/getUserData.php';

    $h_owner_edit_profile=new getDataFromFile($data);

    $h_owner_edit_profile->checkFromFiles($data);

    $Full_Name = $_SESSION['FullName'];
    $Gender = $_SESSION['Gender'];
    $Email = $_SESSION['Email'];
    $Password = $_SESSION['Password'];
    $Image = $_SESSION['Image'];


    if(isset($_POST["edit"])){
        $timenow=date("Y-m-d")." ".date("h:i:sa");
        setcookie('last_edited',$timenow,time()+100000);
        $times=$_COOKIE['last_edited'];
        $data_s= array(
            'Name'=> $_POST['name'],
            'Email'=>$_POST['email'],
            'Password'=>$_POST['pass'],
            'Confirm_Password'=>$_POST['c_pass'],
            'Gender'=>$_POST['gender'],
        );

       require_once "../controller/editUserData.php";
        $h_owner_edit_profile= new editData($data_s);
    
        $h_owner_edit_profile->edit($data_s);
    
        $error=$h_owner_edit_profile->get_error();
        $message=$h_owner_edit_profile->get_message();
    
        $nameError=$error["nameErr"];
        $emailError=$error["emailErr"];
        $passError=$error["passwordErr"];
        $cpassError=$error["confirm_passwordErr"];
        $genderErr=$error["genderErr"];
    
        $Full_Name = $_SESSION['FullName'];
        $Gender = $_SESSION['Gender'];
        $Email = $_SESSION['Email'];
        $Password = $_SESSION['Password'];
        $Image = $_SESSION['Image'];
        
    }
}



?>

<br></br>
<?php
include 'header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body>

    <br>
    <div class="intro">

        <br>
        <span style="font-family: Rockwell;">
        <?php


        echo "Hi , " . $Full_Name;

        ?>

        </span>
        <br>
        <a href="log_out.php" target="_self" class="button2">Log out</a>
        <img class="intro2" src="<?php echo $Image ?>" width="120px" height="120px"><br><br>

    </div>



    <div>
        <table border=1 style="width:800px; border-style: none;border-collapse: collapse; border: 2px solid blue;">

            <tr>

                <td style="width:250px">
                    <legend>Account
                        <hr>
                    </legend>
                    <ul>
                    <a href="h_owner_dashboard.php" class="button">Dashboard</a>
                <a href="post_ads.php" class="button">Post Ads</a>
                <a href="manage_ads.php" class="button">Manage Ads</a>
                <a href="search_ad.php" class="button">Search Ad</a>
                <a href="chatting.php" class="button">Chat</a>
                <a href="manage_payments.php" class="button">Manage Payments</a>
                <a href="give_notice.php" class="button">Give Notice</a>
                <a href="manage_notices.php" class="button">Manage Notices</a>
                <a href="h_owner_edit_profile.php" class="button">Edit Profile</a>
                <a href="change_dp.php" class="button">Change Picture</a>
                <a href="log_out.php" class="button">Log out</a>
                    </ul>
                </td>
                <td style="width:550px; vertical-align:top; padding: 10px 15px;">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <label>Name</label><br>
                        <input type="text" name="name" id="name" placeholder="Full Name" value="<?php echo $Full_Name;?>"><span style="color: red;"><?php
                            if ($nameError != "") {
                            echo "* - " . $nameError;
                            }
                            ?></span><br><br>
                        <label>Password</label><br>
                        <input type="password" name="pass" id="pass" placeholder="Password" value="<?php echo $Password; ?>"><span style="color: red;"><?php
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
                        <input type="password" name="c_pass" id="c_pass" placeholder="Confirm Password" value="<?php echo $Password; ?>"><span style="color: red;"><?php
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
                        <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $Email; ?>"><span style="color: red;"><?php
                            if ($emailError != "") {
                            echo "* - " . $emailError;
                            }
                            ?></span><br><br>
                        <label>Gender</label>&nbsp;
                        <input type="radio" id="gender" name="gender" value="Male" <?php if($Gender=="Male"){echo "checked";} ?>>Male&nbsp;
                        <input type="radio" id="gender" name="gender" value="Female" <?php if($Gender=="Female"){echo "checked";} ?>>Female&nbsp;
                        <input type="radio" id="gender" name="gender" value="Prefer not to Say" <?php if($Gender=="Prefer not to Say"){echo "checked";} ?>>Prefer not to say&nbsp;<span style="color: red;"><?php
                            if ($genderError != "") {
                            echo "* - " . $genderError;
                            }
                            ?></span><br><br>
                        <input type="submit" name="edit" value="Submit"><br>
                        <?php
                        if (isset($message)) {
                            echo "<span style='color:green'><b>" . $message . "</b></span><br>";
                        }
                        ?>
                        <?php
                            echo "Last Updated ".$_COOKIE['last_edited'];
                        ?>
                    </form>
                </td>
            </tr>
        </table>
    </div><br>
    <?php
   include 'footer.php';
   ?>
</body>
</html>