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

    require_once '../controller/get_all_ads.php';

    $all_ads = new get_all_ads();

    $all = $all_ads->get_a_ads();
}



?>
<?php

include '../header.php';

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Explore Ads</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body class="bd">
    <br><br><br>
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
        <h4 style="font-family: 'Baloo Bhaijaan 2', cursive;"> All Advertisements </h4><br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr class="table-dark">
                        <th class="table-dark"></th>
                        <th class="table-dark">AD Rent</th>
                        <th class="table-dark">AD Area</th>
                        <th class="table-dark">AD Address</th>
                        <th class="table-dark"></th>

                    </tr>
                    <?php
                    if (!empty($all))
                        foreach ($all as $ad) : ?>
                        <tr class="table-dark">
                            <td class="table-light"><a href="show_gen_ads.php?id=<?php echo $ad['AD_ID'] ?>" class="btn btn-outline-info">View Details</a></td>
                            <td class="table-light"><?php echo $ad['AD_Rent'] ?></td>
                            <td class="table-light"><?php echo $ad['AD_Area'] ?></td>
                            <td class="table-light"><?php echo $ad['AD_Address'] ?></td>
                            <td class="table-light"><a href="send_request.php?id=<?php echo $ad['AD_ID'] ?>" class="btn btn-outline-info">Send Rent Request</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

    </div>
    <?php
    include "footer.php";
    ?>

</body>

</html>