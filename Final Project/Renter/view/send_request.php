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

    require_once '../controller/get_no_rows.php';

    $msg = new getNoOfRows();

    $mn = $msg->getNumber();

    $in = (int)$mn;

    $m_id = "M-" . strval($in + 1);

    require_once '../controller/get_the_ad.php';
    $show_Ad = new getTheAd($_GET["id"]);
    $ad = $show_Ad->fetchAnAd($_GET["id"]);

    if (isset($_POST["send"])) {

        $data_m = array(
            'Message_No' => $_POST['m_no'],
            'Owner_ID' => $_POST['h_id'],
            'Renter_ID' => $_SESSION['NID'],
            'RMessage' => $_POST['n_msg'],
            'HMessage' => $_POST['h_msg'],
            'AD_No' => $_POST['a_id']
        );

        require_once '../controller/create_new_request.php';

        $n_message = new createRequest($data_m);

        $n_message->send_newMessage($data_m);
    }
}



?>
<?php

include '../header.php';

?>
<br></br>


<html>

<head>
    <meta charset="utf-8">
    <title>Send Request</title>
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

            <h3><b>Are you sure to send request?</b></h3><br>
            <?php
            echo "<b>AD_ID</b>            :&nbsp;&nbsp;"  . $_GET['id'] . "<br>";
            echo "<b>Owner ID</b>        :&nbsp;&nbsp;"  .  $ad["H_Owner_ID"] . "<br>";
            ?><br>
            <form name="mine" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <label>Message No : <?php echo $m_id; ?></label><br>
                <input type="hidden" name="m_no" id="m_no" value="<?php echo $m_id; ?>"><br>
                <input type="hidden" name="n_msg" id="n_msg" value="I want to talk">
                <input type="hidden" name="a_id" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="h_id" value="<?php echo $ad["H_Owner_ID"]; ?>">
                <input type="hidden" name="h_msg" value="-"><br>
                <input type="submit" value="Send Request" name="send" class="btn btn-outline-success"><br>
                <label style="color:red" id="insert_Error"></label>
            </form>
            <br><br><a href="chat.php" class="btn btn-outline-primary">Go Back</a>
        </div>

    </div>
    <?php
    include "footer.php";
    ?>

</body>

</html>