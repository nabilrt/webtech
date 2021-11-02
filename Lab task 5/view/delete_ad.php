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

    require_once '../controller/get_the_ad.php';
    $show_Ad=new getTheAd($_GET["id"]);
    $ad=$show_Ad->fetchAnAd($_GET["id"]);

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
              <?php
              echo "AD ID           :".$ad["AD_ID"]."<br>";
              echo "AD Rent         :".$ad["AD_Rent"]."<br>";
              echo "AD Area         :".$ad["AD_Area"]."<br>";
              echo "AD Address      :".$ad["AD_Address"]."<br>";
              echo "AD Address      :".$ad["AD_Address"]."<br>";
              echo "AD Description  :".$ad["AD_des"]."<br><br>";
              echo "Picture 1<br>";
              echo "<img src= ".$ad["Picture1"]." height='150px' width='150px'><br><br>";
              echo "Picture 2<br>";
              echo "<img src= ".$ad["Picture2"]." height='150px' width='150px'><br><br>";
              echo "Picture 3<br>";
              echo "<img src= ".$ad["Picture3"]." height='150px' width='150px'><br><br>";
              ?>
              <br>
              <a href="../controller/delete_ad.php?id=<?php echo $ad['AD_ID'] ?>" class="button1" onclick="return confirm('Are you sure want to delete this ?')">Delete</a>
              <a href="manage_ads.php">Go Back</a>
    </td>
        
        </tr>
    </table> 
   </div><br>
   <?php
   include 'footer.php';
   ?>

</body>
</html>