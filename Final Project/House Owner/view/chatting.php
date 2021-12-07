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

    require_once '../controller/get_chats.php';

    $chatting = new getChats($data);

    $chats = $chatting->get_the_chats($data);

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
    <title>Chats</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro&display=swap" rel="stylesheet">
</head>

<body class="bd">

    <br>
    <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;">Account
        <hr>
    </legend>
    <div style="display:flex">
        <div>
            <?php include 'menu.php'; ?>
        </div>
        <div style="display:inline-block; padding: 45px; font-family: 'Readex Pro', sans-serif;">
            <h3><b>Rent Requests</b></h3><br>
            <table class="table table-bordered">
                <tr class="table-primary">
                    <th class="table-primary">House Owner ID&nbsp;&nbsp;&nbsp;<vr>
                    </th>
                    <th class="table-primary">Renter ID&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">Message ID&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">Message&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">Reply&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">AD No.&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary"></th>
                    <th class="table-primary"></th>
                </tr>
                <?php
                if (!empty($chats))
                    foreach ($chats as $chat) : ?>
                    <tr class="table-info">
                        <td class="table-info"><?php echo $chat['Owner_ID']; ?></td>
                        <td class="table-info"><?php echo $chat['Renter_ID']; ?></td>
                        <td class="table-info"><?php echo $chat['Message_No']; ?></td>
                        <td class="table-info"><?php echo $chat['RMessage']; ?></td>
                        <td class="table-info"><?php echo $chat['HMessage']; ?></td>
                        <td class="table-info"><?php echo $chat['AD_No']; ?></td>
                        <td class="table-info"><a href="send_reply.php?id=<?php echo $chat['Message_No'] ?>" class="btn btn-outline-dark">Reply</a></td>
                        <td class="table-info"><a href="confirm_renter.php?id=<?php echo $chat['AD_No']; ?>&rid=<?php echo $chat['Renter_ID'] ?>" class="btn btn-outline-success">Confirm Renter</a></td>
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