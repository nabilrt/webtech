<?php
session_start();
$NID="";
$Full_Name=$Email=$Gender=$Password=$Image="";
$rentError=$areaError=$addressError=$ImageError="";
$ad_rent=$ad_address=$ad_area=$ad_des=$p1=$p2=$p3="";
$noImageError="";
$noImageError1="";
$noImageError2="";
if(!isset($_SESSION["NID"])){
    session_destroy();
    header("location:howner_login.php");
}
if(isset($_SESSION["NID"])){
    $NID=$_SESSION["NID"];

    $data=array(
        'NID'=>$NID
    );

    require_once '../controller/getUserData.php';

    $h_owner_dashboard=new getDataFromFile($data);

    $h_owner_dashboard->checkFromFiles($data);

    $Full_Name=$_SESSION['FullName'];
    $Gender=$_SESSION['Gender'];
    $Email=$_SESSION['Email'];
    $Password=$_SESSION['Password'];
    $Image=$_SESSION['Image'];

    require_once '../controller/get_the_ad.php';
    $ad_id=$_GET["id"];
    $show_Ad=new getTheAd($ad_id);
    $ad=$show_Ad->fetchAnAd($ad_id);
    $ad_owner=$ad["H_Owner_ID"];
    $ad_rent=$ad["AD_Rent"];
    $ad_address=$ad['AD_Address'];
    $ad_area=$ad['AD_Area'];
    $ad_des=$ad['AD_des'];
    $p1=$ad['Picture1'];
    $p2=$ad['Picture2'];
    $p3=$ad['Picture3'];


    if(isset($_POST["edit"])){
        if(!empty($_FILES["fileToUpload"]["name"]) || !empty($_FILES["fileToUpload1"]["name"]) || !empty($_FILES["fileToUpload2"]["name"])){
            $target_dir = "../files/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $target_file1 = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
            $target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
            $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            $check1 = getimagesize($_FILES["fileToUpload1"]["tmp_name"]);
            $check2 = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
            $Temp=$_FILES["fileToUpload"]["tmp_name"];
            $Temp1=$_FILES["fileToUpload1"]["tmp_name"];
            $Temp2=$_FILES["fileToUpload2"]["tmp_name"];
            $img_size=$_FILES["fileToUpload"]["size"];
            $img_size1=$_FILES["fileToUpload1"]["size"];
            $img_size2=$_FILES["fileToUpload2"]["size"];
            $filename=$_FILES['fileToUpload']['name']; 
            $filename1=$_FILES['fileToUpload1']['name']; 
            $filename2=$_FILES['fileToUpload2']['name']; 
            $data_p=array(
              'House_Owner'=>$_SESSION["NID"],  
              'AD_rent'=>$_POST["ad_rent"],
              'AD_area'=>$_POST["ad_area"],
              'AD_address'=>$_POST["ad_address"],
              'AD_description'=>$_POST["msg"],
              'AD_iD'=>$_POST["id"],
              'displayable'=>"Yes",
              'Directory'=>$target_dir,
              'Target_File'=>$target_file,
              'Target_File1'=>$target_file1,
              'Target_File2'=>$target_file2,
              'ImageType'=>$imageFileType,
              'ImageType1'=>$imageFileType1,
              'ImageType2'=>$imageFileType2,
              'Image_Size'=>$check,
              'Image_Size1'=>$check1,
              'Image_Size2'=>$check2,
              'Img_Size'=>$img_size,
              'Img_Size1'=>$img_size1,
              'Img_Size2'=>$img_size2,
              'File_Name'=>$filename,
              'File_Name1'=>$filename1,
              'File_Name2'=>$filename2,
              'FilePath'=>"",
              'FilePath1'=>"",
              'FilePath2'=>"",
              'Temporary'=>$Temp,
              'Temporary1'=>$Temp1,
              'Temporary2'=>$Temp2
            );

            
            

            require_once '../controller/edit_the_ad.php';
            $edit_ad=new editAds($data_p);
            $edit_ad->editAd($data_p);
            $error=$edit_ad->get_error();
            $message=$edit_ad->get_message();
            $rentError=$error["rentErr"];
            $addressError=$error["addressErr"];
            $areaError=$error["areaErr"];
            $ImageError=$error["ImageErr"];
        }else{
            $ImageError="3 Pictures Needs to be Selected";
            $rentError="Rent Cannot Be Empty";
            $addressError="Address Cannot Be Empty";
            $areaError="Area Cannot Be Empty";
        }
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
	<title>Dashboard</title>
	<link rel="stylesheet"  href="../css/dashboard_styles.css">
</head>
<body>
    
      <br>
	<div class="intro">
        
        <br>
        <span style="font-family: Rockwell;">
    <?php  
    
    
    echo "Hi, ".$Full_Name;

    ?>
        </span>
    
    <br>
    <a href="log_out.php" target="_self" class="button2" >Log out</a>
    <img class="intro2" src="<?php echo $Image; ?>" width="120px" height="120px"><br><br>

    </div>

    

  <div>
   <table border=1 style="width:800px; border-style: none;border-collapse: collapse; border:2px solid blue">
            
          <tr>
            
        <td  style="width:250px">
            <legend>Account<hr></legend>
            <ul >
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
        <td  style="width:550px; vertical-align:top;">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <?php echo $ad_id; ?>
            <label>AD Rent</label><br>
            <input type="text" name="ad_rent"  value="<?php echo $ad_rent; ?>"><br> <span style="color:red">
            <?php
            if($rentError!=""){
                echo $rentError;
            }
            ?>
            </span><br><br>
            <label>Area</label><br>
            <input type="text" name="ad_area" value="<?php  echo $ad_area; ?>">
            <br><span style="color:red">
            <?php
            if($areaError!=""){
                echo $areaError;
            }
            ?>
            </span><br><br>
            <label>Address</label><br>
            <input type="text" name="ad_address" id="ad_address" value="<?php echo $ad_address; ?>"><br><span style="color:red">
            <?php
            if($addressError!=""){
                echo $addressError;
            }
            ?>
            </span><br><br>
            <label>Description</label><br>
            <input type="text" name="msg" value="<?php echo $ad_des; ?>"><br><br>
            <label>Picture 1</label><br>
            <input type="file" name="fileToUpload" value="<?php echo $p1;?>"><span>            
            </span><br><br>
            <label>Picture 2</label><br>
            <input type="file" name="fileToUpload1" value="<?php echo $p2; ?>"><span>
            </span><br><br>
            <label>Picture 3</label><br>
            <input type="file" name="fileToUpload2" value="<?php echo $p3; ?>"><span>            
            </span><br><br>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <input type="submit" name="edit" value="Edit"><br><br>
            <?php
            if(isset($message)){
                echo '<span style="color:green;">'.$message.'</span>';
            }else if(isset($error)){
                echo $error;
            }
            ?>
            <span style="color:red">
            <?php
            if($ImageError!=""){
                echo $ImageError;
            }
            ?>
            </span><br><br>
            <a href="manage_ads.php">Go Back</a>
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