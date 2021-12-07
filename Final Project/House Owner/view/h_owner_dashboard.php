<?php
session_start();
date_default_timezone_set("Asia/Dhaka");
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

    $owner = $h_owner_dashboard->checkFromFiles($data);

    $Full_Name = $owner['Name'];
    $Gender = $owner['Gender'];
    $Email = $owner['Email'];
    $Password = $owner['Password'];
    $Image = $owner['Image'];

    require_once '../controller/get_rented_count.php';

    $rented_count=check_rented($_SESSION["NID"]);

    require_once '../controller/get_request_count.php';

    $requested_count=get_request($_SESSION["NID"]);


}

$hour = date('H', time());
$wish = "";
$short_wish = "";
if ($hour > 6 && $hour <= 11) {
    $wish = "Good Morning";
    $short_wish = "morning";
} else if ($hour > 11 && $hour <= 16) {
    $wish = "Good Afternoon";
    $short_wish = "afternoon";
} else if ($hour > 16 && $hour <= 23) {
    $wish = "Good Evening";
    $short_wish = "evening";
} else {
    $wish = "Why aren't you asleep?  Are you programming?";
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
    <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;">Account
        <hr>
    </legend>
    <div style="display: flex">
        <div>
            <?php include 'menu.php'; ?>
        </div>
        <div style="display: inline-block; padding-left: 20px; font-family: 'Rubik', sans-serif; font-size:20px">
            &nbsp;&nbsp;&nbsp;
            <?php
            echo " $wish , " . $Full_Name . "";
            ?><br>
            &nbsp;&nbsp;&nbsp;&nbsp;Have a nice <?php echo $short_wish; ?>!&nbsp;&#128521; <br><br>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card" style="width: 16rem; font-family: Roboto, sans-serif;">
                            <img src="../images/house1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><b>Post Ads</b></h5>
                                <p class="card-text" style="font-size:12px">Post your house for rent with proper details to get renters in a convenient way.</p>
                                <a href="post_ads.php" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Navigates you to the post ads page">Go There</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 16rem; font-family: Roboto, sans-serif;">
                            <img src="../images/pay.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><b>Manage Payments</b>
                                    <h5>
                                        <p class="card-text" style="font-size:12px">Check the history of all the rents received from your renters.</p>
                                        <a href="manage_payments.php" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Navigates you to the manage payments page">Go There</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 16rem; font-family: Roboto, sans-serif;">
                            <p style="font-size:60px; text-align:center;"><?php echo $rented_count; ?></p>
                            <div class="card-body">
                                <h5 class="card-title"><b>Number of Renters</b>
                                    <h5>
                                        <p class="card-text" style="font-size:12px">Check the number of renters who are living in your houses.</p>
                                        <a href="manage_rents.php" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Navigates you to the manage payments page">Go There</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 16rem; font-family: Roboto, sans-serif;">
                            <p style="font-size:60px; text-align:center;"><?php echo $requested_count; ?></p>
                            <div class="card-body">
                                <h5 class="card-title"><b>Received Requests</b>
                                    <h5>
                                        <p class="card-text" style="font-size:12px">Check the request received from different renters for your posted ads.</p>
                                        <a href="chatting.php" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Navigates you to the manage payments page">Go There</a>
                            </div>
                        </div>
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