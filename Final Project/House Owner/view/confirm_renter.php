<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
if (!isset($_SESSION["NID"])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $NID
    );

    require_once '../controller/getUserData.php';

    $h_owner_dashboard = new getDataFromFile($data);

    $owner=$h_owner_dashboard->checkFromFiles($data);

    $Full_Name = $owner['Name'];
    $Gender = $owner['Gender'];
    $Email = $owner['Email'];
    $Password = $owner['Password'];
    $Image = $owner['Image'];

    require_once '../controller/get_det.php';

    $ad_id=$_GET["id"];
    $renter_id=$_GET["rid"];

    $c_renter=new getRentData($ad_id);

    $details=$c_renter->get_Data($ad_id);

    if(isset($_POST["add"])){

        $data_c=array(

            'AD_ID'=>$_POST["a_id"],
            'Owner_ID'=>$_POST["owner"],
            'Renter_ID'=>$_POST["r_id"],
            'Rent'=>$_POST["rent"],
            'Area'=>$_POST["area"]
        );

        require_once '../controller/cn_renter.php';

        $c_r=new ConfirmRenter($data_c);

        $c_r->confirm_renter($data_c);
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
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
</head>

<body class="bd">

    <br>
    <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;">Account<hr></legend>
    <div style="display: flex">
        <div>
        <?php include 'menu.php'; ?>  
        </div>
        <div style="display: inline-block; padding-left: 20px; font-family: 'Rubik', sans-serif; font-size:20px">
        <h3><b>Check Details Before Confirming Renter</b></h3><br>
        <?php
        echo "<b>AD_ID</b>            :&nbsp;&nbsp;"  . $ad_id . "<br>";
        echo "<b>Renter_ID</b>        :&nbsp;&nbsp;"  . $renter_id . "<br>";
        echo "<b>Rent</b>             :&nbsp;&nbsp;"  . $details["AD_Rent"] . "<br>";
        echo "<b>Area</b>             :&nbsp;&nbsp;"  . $details["AD_Area"] . "<br>";
        ?><br>
        <form name="mine" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="a_id" id="a_id" value="<?php  echo $_GET["id"]; ?>">
        <input type="hidden" name="r_id" value="<?php  echo $_GET["rid"]; ?>">
        <input type="hidden" name="rent" value="<?php  echo $details["AD_Rent"]; ?>">
        <input type="hidden" name="area" value="<?php  echo $details["AD_Area"]; ?>">
        <input type="hidden" name="owner" value="<?php echo $details["H_Owner_ID"]; ?>">
        <input type="submit" value="Add to House" name="add" class="btn btn-outline-success"><br>
        <label style="color:red" id="insert_Error"></label>
        </form>
        <br><br><a href="back_to_chat.php" class="btn btn-outline-primary">Go Back</a> 
    </div>  
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script src="../js/form_validations.js"></script>
</body>
</html>