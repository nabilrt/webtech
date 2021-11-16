<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$searched_Ads = "";
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

    $owner=$h_owner_dashboard->checkFromFiles($data);

    $Full_Name = $owner['Name'];
    $Gender = $owner['Gender'];
    $Email = $owner['Email'];
    $Password = $owner['Password'];
    $Image = $owner['Image'];

    $ad_Area = "";
    $search_error = "";
    $not_found = "";
    if (isset($_POST["search"])) {
        $ad_Area = $_POST["keyword"];

        if (empty($ad_Area)) {
            $search_error = "Field Cannot Be Empty";
        }
        if(!empty($ad_Area)) {
            require_once '../controller/search_an_ad.php';
            $search_ad = new Search($ad_Area);
            $searched_Ads = $search_ad->searchAd($ad_Area);
    
            if (empty($searched_Ads)) {
                $not_found = "No Such Ad Found";
            }
        }  
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
    <title>Search Ad</title>
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
</head>

<body class="bd">

    <br>
    <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;">Account<hr></legend>
    <div style="display:flex">
    <div>
    <?php include 'menu.php'; ?>
    </div>
    <div style="display:inline-block; padding-left:40px">
                <div class="form-group">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" onsubmit="return search_validate();">
                        <h3><b>Search by Area</b></h3><br>
                        <input type="text" name="keyword" id="keyword" value="" onkeyup="return s_validate()" onblur="return s_validate()" style="width: 25%;" class="form-control"><span id="k" style="color:red">
                            <?php
                            if ($search_error != "") {
                                echo '<span style="color:red;"><b>' . $search_error . '</b></span><br>';
                            }
                            ?>
                        </span><br>
                        <span>
                            <?php
                            if ($not_found != "") {
                                echo " " . $not_found;
                            }
                            ?>
                        </span>
                        <input type="submit" name="search" value="Search" class="btn btn-warning"><br><br>
                        <table class="table table-bordered">
                                <tr class="table-dark">
                                    <th class="table-dark">AD Rent</th>
                                    <th class="table-dark">AD Area</th>
                                    <th class="table-dark">AD Address</th>
                                    <th class="table-dark">AD Description</th>
                                    <th class="table-dark">Picture1</th>
                                    <th class="table-dark">Picture2</th>
                                    <th class="table-dark">Picture3</th>
                                </tr>
                                <?php if(!empty($searched_Ads))
                                 foreach ($searched_Ads as $ad) : ?>
                                    <tr class="table-info">
                                        <td class="table-info"><?php echo $ad['AD_Rent'] ?></td>
                                        <td class="table-info"><?php echo $ad['AD_Area'] ?></td>
                                        <td class="table-info"><?php echo $ad['AD_Address'] ?></td>
                                        <td class="table-info"><?php echo $ad['AD_des'] ?></td>
                                        <td class="table-info"><img width="100px" src="<?php echo $ad['Picture1'] ?>" class="rounded float-start" alt="<?php echo $ad['AD_ID'] ?>"></td>
                                        <td class="table-info"><img width="100px" src="<?php echo $ad['Picture2'] ?>" class="rounded float-start" alt="<?php echo $ad['AD_ID'] ?>"></td>
                                        <td class="table-info"><img width="100px" src="<?php echo $ad['Picture3'] ?>" class="rounded float-start" alt="<?php echo $ad['AD_ID'] ?>"></td>
                                    </tr>
                                <?php endforeach; ?>
                        </table>
                    </form>
                </div>
    </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script type="text/javascript" src="../js/form_validations.js"></script>
</body>
</html>