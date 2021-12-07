<?php
session_start();
if (!isset($_SESSION['NID'])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
$NID = "";
$Name = $Email = $Gender = $Password = $Image = "";
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $NID
    );

    require_once '../controller/getuserData.php';

    $renterdashboard = new getDataFromFile($data);

    $renter = $renterdashboard->checkFromFiles($data);

    $Name = $renter['name'];
    $Gender = $renter['gender'];
    $Email = $renter['email'];
    $Password = $renter['password'];
    $Image = $renter['Image'];

    require_once '../controller/fetch_house_count.php';

    $h_count = get_h_c($_SESSION["NID"]);

    require_once '../controller/fetch_req_count.php';

    $r_count =get_r_count($_SESSION["NID"]);
}



?>
<?php

include '../header.php';

?>
<br></br>


<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">

</head>

<body class="bd">

    <br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account
        <hr>
    </legend>



    <div style="display: flex;">

        <div>
            <?php
            include "menu.php";

            ?>
        </div>
        <div style="display: inline-block; padding-left: 40px;">

            <br> </br>
            &nbsp; &nbsp;
            <?php
            echo " <b>   Welcome , " . $Name . "</b>";
            ?>
            <br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <p style="font-size:60px; text-align:center; color:blue"><?php echo $h_count; ?></p>
                            <div class="card-body">
                                <h5 class="card-title"><b>House Rented</b></h5>
                                <p class="card-text">This stats shows how many houses you have rented through the application</p>
                                <a href="rented_houses.php" class="btn btn-outline-primary">Show Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                    <div class="card" style="width: 18rem;">
                            <p style="font-size:60px; text-align:center; color:blue"><?php echo $r_count; ?></p>
                            <div class="card-body">
                                <h5 class="card-title"><b>Sent Requests</b></h5>
                                <p class="card-text">This stats shows how many requested you have made for houses.</p>
                                <a href="chat.php" class="btn btn-outline-primary">Show Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <?php
    include "footer.php";
    ?>

</body>

</html>