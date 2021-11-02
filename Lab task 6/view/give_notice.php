<?php
session_start();
$NID="";
$Full_Name=$Email=$Gender=$Password=$Image="";
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

    if(isset($_POST["post_notice"])){

        $data=array(
        'HO_ID'=>$_SESSION["NID"],
        'Notice_ID'=>$_POST["notice_id"],
        'Renter_ID'=>$_POST["rid"],
        'Message'=>$_POST["msg"]
        );

        require_once '../controller/create_notice.php';

        $give_notice=new giveNotice($data);

        $give_notice->g_notice($data);

        $message=$give_notice->get_message();
        $error=$give_notice->get_error();

        $noticeIDErr=$error["NoticeIDErr"];
        $renterIDErr=$error["RenterIDErr"];
        $messageErr=$error["MessageErr"];


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
	<title>Give Notice</title>
	<link rel="stylesheet"  href="../css/dashboard_styles.css">
</head>
<body>
    
      <br>
	<div class="intro">
        
        <br>
        <span style="font-family: Rockwell;">
    <?php  
    
    
    echo "Hi , ".$Full_Name;

    ?>
        </span>
    
    <br>
    <a href="log_out.php" target="_self" class="button2" >Log out</a>
    <img class="intro2" src="<?php echo $Image; ?>" width="120px" height="120px"><br><br>

    </div>

    

  <div>
   <table border=1 style="width:800px; border-style: none;border-collapse: collapse; border: 2px solid blue;">
            
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
                <a href="view_profile.php" class="button">View Profile</a>
                <a href="h_owner_edit_profile.php" class="button">Edit Profile</a>
                <a href="change_dp.php" class="button">Change Picture</a>
                <a href="log_out.php" class="button">Log out</a>
            </ul>
        </td>
        <td  style="width:550px; vertical-align:top; padding: 10px 15px;">
           <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
           <label>Notice ID</label><br>
           <input type="text" name="notice_id" id="notice_id" value=""><br><span style="color:red">
           <?php

           if($noticeIDErr!=""){
               echo $noticeIDErr;
           }

           ?>
           </span><br><br>
           <label>Renter ID</label><br>
           <input type="text" name="rid" id="rid" value=""><br><span style="color:red">
           <?php
           if($renterIDErr!=""){
               echo $renterIDErr;
           }
           ?>

           </span><br><br>
           <label>Message</label><br>
           <input type="textarea" name="msg" rows="5" cols="100"><br><span style="color:red">
           <?php
           if($messageErr!=""){
               echo $messageErr;
           }
           ?>
           </span><br><br>
           <input type="submit" name="post_notice" id="pn" value="Post"><br><br>
           <?php
           if(isset($message)){
               echo "<span style='color:green'>".$message."</span>";
           }
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