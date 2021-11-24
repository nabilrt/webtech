<?php
session_start();
$NID="";
$Full_Name=$Email=$Gender=$Password=$Image="";
$noticeIDErr=$renterIDErr=$messageErr="";
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

    $owner=$h_owner_dashboard->checkFromFiles($data);

    $Full_Name = $owner['Name'];
    $Gender = $owner['Gender'];
    $Email = $owner['Email'];
    $Password = $owner['Password'];
    $Image = $owner['Image'];

    require_once '../controller/get_renters.php';

    $manage_ads = new getRN($data);

    $ads = $manage_ads->get_RN($data);

    if(isset($_POST["post_notice"])){

        $data_n=array(
        'HO_ID'=>$_SESSION["NID"],
        'AD_ID'=>$_POST["a_id"],
        'Renter_ID'=>$_POST["rid"],
        'Message'=>$_POST["msg"]
        );

        require_once '../controller/create_notice.php';

        $give_notice=new giveNotice($data_n);

        $give_notice->g_notice($data_n);

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
include 'new_header.php';
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Give Notice</title>
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet"  href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
</head>
<body class="bd">
      <br>
      <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;">Account<hr></legend>
  <div style="display:flex">
            <div>
            <?php include 'menu.php'; ?>
            </div>
        <div style="display:inline-block; padding-left:45px">
        <h3><b>Post Notice</b></h3><br>
        <div class="form-group">
           <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return give_notice_validation()">
           <label>AD ID</label><br>
           <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="a_id" id="a_id" onchange="get_spec_data()">
           <option value="" selected>Select A Renter</option>
           <?php if(!empty($ads))
           foreach ($ads as $ad) : ?>
           <?php echo '<option id="val" value='.$ad["AD_No"].'>'.$ad['AD_No'].'</option>';?>
           <?php endforeach; ?>
           </select>
           <label>Renter ID</label><br>
           <input type="text" name="rid" id="rid" onkeyup="return renter_id_validate()" onblur="return renter_id_validate()" value="" class="form-control"><span id="renterIDErr" style="color:red" >
           <?php
           if($renterIDErr!=""){
               echo $renterIDErr;
           }
           ?>

           </span><br>
           <label>Message</label><br>
           <input type="textarea" name="msg" id="msg" onkeyup="return message_validate()" onblur="return  message_validate()" rows="7" cols="200" class="form-control"><span id="messageErr" style="color:red">
           <?php
           if($messageErr!=""){
               echo $messageErr;
           }
           ?>
           </span><br>
           <input type="submit" name="post_notice" id="pn" value="Post" class="btn btn-success"><br><br>
           <?php
           if(isset($message)){
               echo "<span style='color:green'>".$message."</span>";
           }
           ?>
           </form>
        </div>
        </div>
   </div><br>
   <?php
   include 'footer.php';
   ?>
   <script type="text/javascript" src="../js/form_validations.js"></script>
</body>
</html>