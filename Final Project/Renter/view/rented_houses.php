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

    require_once '../controller/get_rented_houses.php';

    $r_house=new getRented($_SESSION["NID"]);

    $c_ads=$r_house->get_Rented($_SESSION["NID"]);
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

        <h3><b>Current Rented Houses</b></h3>
            <table class="table table-bordered">
                <tr class="table-danger">
                    <th class="table-danger">Owner ID&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-danger">Rent Amount&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-danger">Area&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-danger">AD No.&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-danger"></th>
                </tr>
                <?php
                if (!empty($c_ads))
                    foreach ($c_ads as $chat) : ?>
                    <tr class="table-primary">
                        <td class="table-primary"><?php echo $chat['Owner_ID']; ?></td>
                        <td class="table-primary"><?php echo $chat['Rent']; ?></td>
                        <td class="table-primary"><?php echo $chat['Area']; ?></td>
                        <td class="table-primary"><?php echo $chat['AD_No']; ?></td>
                        <td><a href="../controller/leave_house.php?id=<?php echo $chat['AD_No'] ?>" class="btn btn-outline-info">Leave House</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

    </div>
    </div>
    <?php
    include "footer.php";
    ?>

</body>

</html>