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

    require_once '../controller/notice_info.php';

    $manage_notices = new getNotices($data);

    $notices = $manage_notices->getTheNotices($data);
}



?>
<?php

include '../header.php';

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>check notice</title>
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

        <h3><b>Notices Posted</b></h3><br>
            <table class="table table-bordered">
                <tr class="table-primary">
                    <th class="table-primary">AD ID</th>
                    <th class="table-primary">Owner ID</th>
                    <th class="table-primary">Message</th>
                </tr>
                <?php
                foreach ($notices as $row) {
                    echo '<tr><td class="table-info">' . $row["AD_ID"] . '</td>
                          <td class="table-info">' . $row["Owner_ID"] . '</td>
                         <td class="table-info">' . $row["Notice"] . '</td></tr>';
                }
                ?>
            </table>
        </div>

    </div>
    <?php
    include "footer.php";
    ?>

</body>

</html>