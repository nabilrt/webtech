<?php

    session_start();
    $isFound=false;
    $name=$dob=$gender=$email="";
    $error_m="";
    $conf="";
    $isUpdated=true;
    $slash="";
    $F_Name="";

    if(isset($_SESSION['Username'])){
        $sname=$_SESSION['Username'];

        $data = file_get_contents("../json/data.json");  
        $data = json_decode($data, true); 
        foreach($data as $key=>$value){
            if($value['Username']==$sname){
            $Name=$value['Name'];
            
            $image_link=$value['Image']; 
            $Email=$value['Email'];
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

        if(isset($_POST["submit"])){
        $name=$_POST["name"];
        $email=$_POST["email"];
        $dob=$_POST["dob"];
        $gender=$_POST["gender"];
        $slash=explode(" ",$_SESSION['FullName']);
        
        
        foreach($slash as $val){
           $F_Name = $val." ";
        }

        $S_Name=implode(" ",$slash);

        if($name!="" && $email!="" && $dob!="" && $gender!=""){

            if($isUpdated){
                $conf = "Data Updated";
            }
            else{
                $error_m="Error Occurred Try Again!";
            }
           
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
    <table>
        <thead>
            <th style="color: black;">Account<hr></th>
            <th> </th>
        </thead>
        <tr>
        <td style="color: black;  font-family:Century Gothic">
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
        <fieldset style="font-family: Arial, Helvetica, sans-serif; margin:50px;">
     <legend style="color: royalblue; font-family:Arial, Helvetica, sans-serif"> MY PROFILE </legend>
     <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
         <label style="color: black;">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> &nbsp; :
         <input type="text" id="text" name="name" value="<?php
         echo htmlspecialchars($Name);
         ?>"><br><br><hr>
         <label style="color: black;">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> &nbsp; : 
         <input type="text" id="email" name="email" value="<?php 
         echo $Email;
         ?>"><br><br><hr>
         <label style="color: black;">Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> &nbsp; : 
         <input type="radio" id="gender" name="gender" value="Male" <?php if($Gender=="Male"){echo "checked";} ?> > <span style="color:black">
         Male</span>
        <input type="radio" id="gender" name="gender" value="Female" <?php if($Gender=="Female"){echo "checked";} ?>><span style="color:black"> Female </span>
        <input type="radio" id="gender" name="gender" value="Other" <?php if($Gender=="Other"){echo "checked";} ?>><span style="color: black;"> Other </span> &nbsp;<br><br><hr>
        <label style="color: black;">Date of Birth</label> &nbsp; : 
        <input type="text" id="dob" name="dob" value=<?php
        echo $DOB;
        ?>><br><br><hr>
        <input type="submit" name="submit" value="Edit Profile" class="button"><br><br>
        <span style="color:red"><?php
        if($error_m!=""){
            echo $error_m;
        }
        else{
            echo $conf;
        }
        ?>
        </span>

     </form>
    </fieldset>  
        </td>
        </tr>
    </table> 
    </div><br><br>
    <?php
    include 'footer.php';
    ?>
    </body>
</html>