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

    require_once '../controller/ad_info.php';

    $manage_ads = new getAds($data);

    $ads = $manage_ads->getTheAds($data);

    require_once '../controller/get_accepted_ads.php';

    $m_ads = new getAcceptedAds($_SESSION["NID"]);

    $accepted_ads = $m_ads->getA_Ads($_SESSION["NID"]);
}
?>
<br></br>
<?php
include 'new_header.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Manage Ads</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap" rel="stylesheet">
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
        <div style="display:inline-block; padding-left: 50px; font-family: 'Space Grotesk', sans-serif;">
            <h3><b>Unapproved Ads</b></h3>
            <table class="table table-bordered">
                <tr class="table-primary">
                    <th class="table-primary"></th>
                    <th class="table-primary">AD Rent</th>
                    <th class="table-primary">AD Area</th>
                    <th class="table-primary">AD Address</th>
                    <th class="table-primary">Actions</th>
                </tr>
                <?php
                if (!empty($ads))
                    foreach ($ads as $ad) : ?>
                    <tr class="table-info">
                        <td class="table-info"><a href="show_Ad.php?id=<?php echo $ad['AD_ID'] ?>" class="btn btn-outline-info">View Details</a></td>
                        <td class="table-info"><?php echo $ad['AD_Rent'] ?></td>
                        <td class="table-info"><?php echo $ad['AD_Area'] ?></td>
                        <td class="table-info"><?php echo $ad['AD_Address'] ?></td>
                        <td class="table-info"><a href="edit_ad.php?id=<?php echo $ad['AD_ID'] ?>" class="btn btn-outline-dark">Edit</a>&nbsp<a href="delete_ad.php?id=<?php echo $ad['AD_ID'] ?>" class="btn btn-outline-danger" )>Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <h3><b>Approved Ads</b></h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr class="table-dark">
                        <th class="table-dark"></th>
                        <th class="table-dark">AD Rent</th>
                        <th class="table-dark">AD Area</th>
                        <th class="table-dark">AD Address</th>
                    </tr>
                    <?php
                    if (!empty($accepted_ads))
                        foreach ($accepted_ads as $ad) : ?>
                        <tr class="table-dark">
                            <td class="table-light"><a href="show_Ad.php?id=<?php echo $ad['AD_ID'] ?>" class="btn btn-outline-info">View Details</a></td>
                            <td class="table-light"><?php echo $ad['AD_Rent'] ?></td>
                            <td class="table-light"><?php echo $ad['AD_Area'] ?></td>
                            <td class="table-light"><?php echo $ad['AD_Address'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
</body>

</html>