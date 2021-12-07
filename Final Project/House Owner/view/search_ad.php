<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$searched_Ads = "";
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

    $ad_Area = "";
    $search_error = "";
    $not_found = "";
    if (isset($_POST["search"])) {
        $ad_Area = $_POST["keyword"];

        if (empty($ad_Area)) {
            $search_error = "Field Cannot Be Empty";
        }
        if (!empty($ad_Area)) {
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
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
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
        <div style="display:inline-block; padding-left:40px; font-family: 'Overpass', sans-serif;">
            <div class="form-group">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <h3><b>Search your posted ads by area</b></h3><br>
                    <input type="text" name="keyword" placeholder="Type something" id="keyword" value="" onkeyup="search_data(this.value)" class="form-control">
                </form>
                <div class="container" id="showD"></div>
            </div>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script>
        function search_data(key) {
            let id;
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                id = this.responseText;
                console.log(id);
                document.getElementById("showD").innerHTML = this.responseText;
            }
            xhttp.open("GET", "../controller/test.php?key=" + key);
            xhttp.send();
        }
    </script>
</body>

</html>