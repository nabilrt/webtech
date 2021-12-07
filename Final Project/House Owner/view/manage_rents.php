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

    $owner = $h_owner_dashboard->checkFromFiles($data);

    $Full_Name = $owner['Name'];
    $Gender = $owner['Gender'];
    $Email = $owner['Email'];
    $Password = $owner['Password'];
    $Image = $owner['Image'];

    require_once '../controller/current_renters.php';

    $adn = new cRenters($_SESSION['NID']);

    $c_ads = $adn->getTheAD_ID($_SESSION["NID"]);
}

?>

<br></br>

<?php
include 'new_header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Manage Rents</title>
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
        <div style="display: inline-block; padding-left: 40px; font-family: 'Rubik', sans-serif; font-size:20px">
            <h3><b>Current Renters and House Details</b></h3>
            <table class="table table-bordered">
                <tr class="table-danger">
                    <th class="table-danger">Renter ID&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-danger">Rent Amount&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-danger">Area&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-danger">AD No.&nbsp;&nbsp;&nbsp;</th>
                </tr>
                <?php
                if (!empty($c_ads))
                    foreach ($c_ads as $chat) : ?>
                    <tr class="table-primary">
                        <td class="table-primary"><?php echo $chat['Renter_ID']; ?></td>
                        <td class="table-primary"><?php echo $chat['Rent']; ?></td>
                        <td class="table-primary"><?php echo $chat['Area']; ?></td>
                        <td class="table-primary"><?php echo $chat['AD_No']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
</body>

</html>