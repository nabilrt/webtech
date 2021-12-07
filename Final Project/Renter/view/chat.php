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

    require_once '../controller/get_messages.php';

    $chats = new getMessages($_SESSION['NID']);

    $ch = $chats->get_msg($_SESSION['NID']);
}



?>
<?php

include '../header.php';

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rent Request</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
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

            <br>
            <table class="table table-bordered">
                <tr class="table-primary">
                    <th class="table-primary">House Owner ID&nbsp;&nbsp;&nbsp;<vr></th>
                    <th class="table-primary">Message ID&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">Renter Message&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">Owner Reply&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">AD No.&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary"></th>
                    <th class="table-primary"></th>
                </tr>
                <?php
                if (!empty($ch))
                    foreach ($ch as $chat) : ?>
                    <tr class="table-info">
                        <td class="table-info"><?php echo $chat['Owner_ID']; ?></td>
                        <td class="table-info"><?php echo $chat['Message_No']; ?></td>
                        <td class="table-info"><?php echo $chat['RMessage']; ?></td>
                        <td class="table-info"><?php echo $chat['HMessage']; ?></td>
                        <td class="table-info"><?php echo $chat['AD_No']; ?></td>
                        <td class="table-info"><a href="new_message.php?id=<?php echo $chat['Message_No'];?>" class="btn btn-outline-success">New Message</a></td>
                        <td class="table-info"><a href="../controller/delete_message.php?id=<?php echo $chat['Message_No'];?>" class="btn btn-outline-danger">Delete Message</a></td>
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