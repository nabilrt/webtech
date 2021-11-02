<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";

if (!isset($_SESSION["NID"])) {
    session_destroy();
    header("location:howner_login.php");
}

if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $NID
    );

    require_once '../controller/getUserData.php';

    $h_owner_dashboard = new getDataFromFile($data);

    $h_owner_dashboard->checkFromFiles($data);

    $Full_Name = $_SESSION['FullName'];
    $Gender = $_SESSION['Gender'];
    $Email = $_SESSION['Email'];
    $Password = $_SESSION['Password'];
    $Image = $_SESSION['Image'];
}



?>

<br></br>
<?php
include 'header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Manage Payments</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body>

    <br>
    <div class="intro">

        <br>
        <span style="font-family: Rockwell;">
            <?php



            echo "Hi , " . $Full_Name;

            ?>

        </span>
        <br>
        <a href="log_out.php" target="_self" class="button2">Log out</a>
        <img class="intro2" src="<?php echo $Image; ?>" width="120px" height="120px"><br><br>

    </div>



    <div>
        <table border=1 style="width:800px; border-style: none;border-collapse: collapse; border: 2px solid blue;">

            <tr>

                <td style="width:250px">
                    <legend>Account
                        <hr>
                    </legend>
                    <ul>
                        <a href="h_owner_dashboard.php" class="button">Dashboard</a>
                        <a href="post_ads.php" class="button">Post Ads</a>
                        <a href="manage_ads.php" class="button">Manage Ads</a>
                        <a href="search_ad.php" class="button">Search Ad</a>
                        <a href="chatting.php" class="button">Chat</a>
                        <a href="manage_payments.php" class="button">Manage Payments</a>
                        <a href="give_notice.php" class="button">Give Notice</a>
                        <a href="manage_notices.php" class="button">Manage Notices</a>
                        <a href="view_profile.php" class="button">View Profile</a>
                        <a href="h_owner_edit_profile.php" class="button">Edit Profile</a>
                        <a href="change_dp.php" class="button">Change Picture</a>
                        <a href="log_out.php" class="button">Log out</a>
                    </ul>
                </td>
                <td style="width:550px; vertical-align:top;">
                    <h3>Rent Records</h3>
                    <table style="border: 2px solid black; width: 100%; text-align:center; border-collapse: collapse;">
                        <thead style="border: 2px solid black">
                            <tr style="border: 2px solid black">
                                <th style="border: 2px solid black">Renter ID&nbsp;&nbsp;&nbsp;</th>
                                <th style="border: 2px solid black">Rent Amount&nbsp;&nbsp;&nbsp;</th>
                                <th style="border: 2px solid black">AD No.&nbsp;&nbsp;&nbsp;</th>
                                <th style="border: 2px solid black">Month Paid For&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border: 2px solid black">
                                <td style="border: 2px solid black">123</td>
                                <td style="border: 2px solid black">15000</td>
                                <td style="border: 2px solid black">AD1</td>
                                <td style="border: 2px solid black">January</td>
                            </tr>
                            <tr style="border: 2px solid black">
                                <td style="border: 2px solid black">333</td>
                                <td style="border: 2px solid black">18000</td>
                                <td style="border: 2px solid black">AD2</td>
                                <td style="border: 2px solid black">June</td>
                            </tr>
                        </tbody>
                    </table>
                </td>

            </tr>
        </table>
    </div><br>
    <?php
    include 'footer.php';
    ?>

</body>

</html>