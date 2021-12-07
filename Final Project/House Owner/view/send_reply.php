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

    require_once '../controller/get_the_message.php';

    $msg_id = $_GET["id"];

    $s_reply = new getMessage($msg_id);

    $me = $s_reply->get_the_message($msg_id);

    $adNo = $me['AD_No'];
    $renter_id = $me['Renter_ID'];
    $o_id = $me['Owner_ID'];
    $r_message = $me['RMessage'];


    if (isset($_POST["rep"])) {

        $data_r = array(

            'AD_No' => $_POST['ad_id'],
            'Renter_ID' => $_POST['rid'],
            'Owner_ID' => $_POST['oid'],
            'Message_No' => $_POST['mid'],
            'RMessage' => $_POST['rm'],
            'HMessage' => $_POST['reply']
        );

        require_once '../controller/edit_the_message.php';

        $send = new EditMessage($data_r);

        $send->edit_msg($data_r);
    }
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
            <h3><b>Message Details</b></h3><br>
            <?php
            echo "<b>AD_ID</b>            :&nbsp;&nbsp;"  . $me["AD_No"] . "<br>";
            echo "<b>Renter_ID</b>        :&nbsp;&nbsp;"  . $me["Renter_ID"] . "<br>";
            echo "<b>Owner_ID</b>         :&nbsp;&nbsp;"  . $me["Owner_ID"] . "<br>";
            echo "<b>Message</b>          :&nbsp;&nbsp;"  . $me["RMessage"] . "<br>";
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <label>Reply</label><br>
                <input type="text" name="reply" id="reply" value="<?php echo $me["HMessage"]; ?>"><br><br>
                <input type="hidden" name="mid" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="ad_id" value="<?php echo $me["AD_No"]; ?>">
                <input type="hidden" name="rid" value="<?php echo $me["Renter_ID"]; ?>">
                <input type="hidden" name="oid" value="<?php echo $me["Owner_ID"]; ?>">
                <input type="hidden" name="rm" value="<?php echo $me["RMessage"]; ?>">
                <input type="submit" value="Send Reply" name="rep" class="btn btn-outline-success">
            </form>
            <br><br><a href="chatting.php" class="btn btn-outline-primary">Go Back</a>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
</body>

</html>