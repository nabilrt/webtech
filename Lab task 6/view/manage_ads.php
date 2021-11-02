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

    require_once '../controller/ad_info.php';

    $manage_ads = new getAds($data);

    $ads = $manage_ads->getTheAds($data);
}



?>

<br></br>
<?php
include 'header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Manage Ads</title>
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
        <table border=1 style="width:1000px; border-style: none;border-collapse: collapse; text-align: top; border: 2px solid blue;">

            <tr>

                <td style="width:250px">
                    <legend>Account
                        <hr style="color: blue;">
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
                <td style="text-align: top;">
                    <h3>Unapproved Ads</h3>
                    <table style="border: 2px solid black; width: 100%; text-align:center; border-collapse: collapse;">
                        <thead style="border: 2px solid black">
                            <tr style="border: 2px solid black">
                                <th style="border: 2px solid black"></th>
                                <th style="border: 2px solid black">AD Rent</th>
                                <th style="border: 2px solid black">AD Area</th>
                                <th style="border: 2px solid black">AD Address</th>
                                <th style="border: 2px solid black">AD Description</th>
                                <th style="border: 2px solid black">Picture1</th>
                                <th style="border: 2px solid black">Picture2</th>
                                <th style="border: 2px solid black">Picture3</th>
                            </tr>
                        </thead>
                        <tbody style="border: 2px solid black">
                            <?php foreach ($ads as $ad) : ?>
                                <tr>
                                    <td><a href="show_Ad.php?id=<?php echo $ad['AD_ID'] ?>" class="button1">View</a></td>
                                    <td><?php echo $ad['AD_Rent'] ?></td>
                                    <td><?php echo $ad['AD_Area'] ?></td>
                                    <td><?php echo $ad['AD_Address'] ?></td>
                                    <td><?php echo $ad['AD_des'] ?></td>
                                    <td><img width="100px" src="<?php echo $ad['Picture1'] ?>" alt="<?php echo $ad['AD_ID'] ?>"></td>
                                    <td><img width="100px" src="<?php echo $ad['Picture2'] ?>" alt="<?php echo $ad['AD_ID'] ?>"></td>
                                    <td><img width="100px" src="<?php echo $ad['Picture3'] ?>" alt="<?php echo $ad['AD_ID'] ?>"></td>
                                    <td><a href="edit_ad.php?id=<?php echo $ad['AD_ID'] ?>" class="button1">Edit</a>&nbsp<a href="delete_ad.php?id=<?php echo $ad['AD_ID'] ?>" class="button1" )>Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <h3>Approved Ads</h3>
            </tr>

            </td>
        </table>
    </div><br>
    <?php
    include 'footer.php';
    ?>

</body>

</html>