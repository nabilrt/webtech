<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
if (!isset($_SESSION["NID"])) {
    session_destroy();
    header("location:howner_login.php");
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
        &nbsp;&nbsp;&nbsp;
        <?php
        echo "    Welcome , " . $Full_Name . "";
        ?><br>
        &nbsp;&nbsp;&nbsp;&nbsp;Have a nice day!&nbsp;&#128521; <br><br>
        <div class="row">
        &nbsp; &nbsp;&nbsp;&nbsp;   &nbsp;      
        <div class="card" style="width: 18rem; font-family: Roboto, sans-serif;">
        <img src="../images/house1.jpg" class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title"><b>Post Ads</b></h5>
        <p class="card-text" style="font-size:12px">Post your house for rent with proper details to get renters in a convenient way.</p>
        <a href="post_ads.php" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Navigates you to the post ads page">Go There</a>
       </div>
       </div>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;   
       <div class="card" style="width: 18rem; font-family: Roboto, sans-serif;">
        <img src="../images/pay.jpg" class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title"><b>Manage Payments</b><h5>
        <p class="card-text" style="font-size:12px">Check the history of all the rents received from your renters.</p>
        <a href="manage_payments.php" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Navigates you to the manage payments page">Go There</a>
       </div>
       </div>
        </div>
    </div>  
    </div><br>
    <?php
    include 'footer.php';
    ?>
</body>
</html>