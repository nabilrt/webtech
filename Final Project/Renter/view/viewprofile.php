<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:../../Login Module/view/login.php");
    }
$NID = "";

$name = $email =$un=$gender=$pass=$Cpass=$dob=$nid="";
    
    $UploadConfirmation = "";
    $target_file="";
$nameErr =$emailErr=$unErr=$genderErr=$passErr=$CpassErr=$dobErr=$pictureErr=$ImgErr=$nidErr="";
$Name = $Email = $Gender = $Password = $Image = "";
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $_SESSION["NID"],
    );
    require_once '../controller/getuserData.php';

    $editprofile=new getDataFromFile($data);

    $renter=$editprofile->checkFromFiles($data);

    

    $Name=$renter['name'];
    $Gender=$renter['gender'];
    $Email=$renter['email'];
    $Password=$renter['password'];
    $Image=$renter['Image'];
    $dob=$renter['dob'];
    

   
   if(isset($_POST["edit"])){
       
        $data_s= array(
            'name'=> $_POST['name'],
            'email'=>$_POST['email'],
            'pass'=>$_POST['pass'],
            'Cpass'=>$_POST['Cpass'],
            'gender'=>$_POST['gender'],
            'dob'=>$_POST['dob'],
            'nid'=>$_POST['nid'],
            

        );
   require_once "../controller/editprofile.php";
        $editprofile= new editData($data_s);
    
        $editprofile->edit($data_s);
    
        $error=$editprofile->get_error();
        $message=$editprofile->get_message();


        $nameErr=$error["nameError"];
        $emailErr=$error["emailError"];
        $passErr=$error["passError"];
        $CpassErr=$error["cpasswordError"];
        $genderErr=$error["genderError"];
        $dobErr=$error["dobError"];
        $nidErr=$error["nidError"];
    
        $Name = $_SESSION['Name'];
        $Gender = $_SESSION['Gender'];
        $Email = $_SESSION['Email'];
        $Password = $_SESSION['Password'];
        $Image = $_SESSION['Image'];
        $DOB= $_SESSION['DOB'];
        $NID= $_SESSION['NID'];
        
        
    }
}
?>
 <?php

 include '../header.php';

   ?>
<html>

<head>
    <meta charset="utf-8">
    <title>View Profile</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body class="bd">

    <br><br><br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account<hr></legend>

       <div style="display: flex;">

        <div>

            <?php
         include "menu.php";

         ?>
        </div>
    
            <div style="display: inline-block; padding-left: 40px;">
        


            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                       
                        
                        <?php
                        echo "<img src= ".$Image." height='130px' width='150px'><br>";
                        ?>
                         <br>
                        <label><b> Name</b></label>
                        <?php
                        echo $Name;
                        ?>
                         <?php 

                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                    <br><br>

                 <label><b>Email:</b>&nbsp; </label>
               
                  <?php
                        echo $Email;
                        ?>
                         <?php 
                   
                    if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
                    
                    <br></br>
                    <label><b>NID:</b>&nbsp; </label>
                    <?php
                        echo $NID;
                        ?>
                         

                
                    <?php 
                    if ($nidErr != "") 
                        {
                        echo "*";
                        echo $nidErr;
                    }
                    ?>
                    
                    <br></br>
                        
                        
                        <label><b>Gender:</b>&nbsp;</label>
                         
               
                        <?php
                       if($Gender=="Male")
                        {echo $Gender;
                        }
                       else if($Gender=="Female")
                        {echo $Gender;
                        }

                        ?>
                <?php 
               if($genderErr)
               {  
                echo "* ";
                echo $genderErr;

                    }
                ?><br></br>
                <label><b>Date of birth:</b>&nbsp;</label>
                    
                  <?php
                        if(empty($dob))
                            {echo $dob;
                    }
                    else{echo $dob;}
                        ?>
                         
                    <?php 
               if($dobErr)
               {  
                echo "* ";
                echo $dobErr;

                    }
                ?>
                <br>
                 </form>
           </div>    
    </div>
                    <?php
                      include "footer.php";
                    ?>

</body>
</html>

