<?php
session_start();
if (!isset($_SESSION['NID'])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
$NID = "";
$Name = $Email = $Gender = $Password = $Image = "";
$searched_history = "";



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


    $payment = "";
    $payment_error = "";
    $not_match = "";
    if (isset($_POST["search"])) {
        $payment = $_POST["keyword"];
        if (!empty($payment)) {
            require_once '../controller/search_history.php';
            $searchhistory = new Search($payment);
            $searched_history = $searchhistory->searchpay($payment);

            if (empty($searched_history)) {
                $not_match = "No Such rent history Found";
            }
        } else if (empty($payment)) {
            $payment_error = "Search history is required ";
        }
    }
}
?>

<?php

include '../header.php';

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">
</head>

<body class="bd">

    <br>
    <label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account
        <hr>
        Account

        <hr>
    </label>
    <div style="display:flex">
        <div>
            <?php include 'menu.php'; ?>
        </div>
        <div style="display:inline-block; padding-left:40px">
            <div class="form-group">
                <h3 style="font-family: 'Baloo Bhaijaan 2', cursive;"><b>Search For Ads</b></h3>
                <div class="row g-3">
                    <div class="col-sm-7">
                        <label for="keyword" class="form-label"><b>Area</b></label>
                        <input type="text" name="keyword" placeholder="Type something" id="keyword" value="" class="form-control">
                    </div>
                    <div class="col-sm">
                        <label for="rent_range" class="form-label"><b>Rent Range</b></label><br>
                        <select name="rent_range" id="range" class="form-select">
                            <option value="" selected>Choose One</option>
                            <option value="5000">Less than 5000 </option>
                            <option value="10000">Less than 10000 </option>
                            <option value="20000">Less than 20000 </option>
                            <option value="30000">Less than 30000 </option>
                            <option value="40000">Less than 40000 </option>
                        </select>
                    </div>
                </div><br>
                <div class="container" id="showD"></div>
            </div>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#keyword').keyup(function() {

            var w = $('#keyword').val();
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                $('#showD').html(this.responseText);
            }
            xhttp.open("GET", "../controller/test.php?key=" + w);
            xhttp.send();
        });

        $('#range').change(function() {

            var v = $('#range').val();
            var w = $('#keyword').val();
            if (w == "" && v != "") {

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    $('#showD').html(this.responseText);
                }
                xhttp.open("GET", "../controller/get_by_rent.php?key=" + v);
                xhttp.send();
            }
            if (w != "" && v != "") {

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    $('#showD').html(this.responseText);
                }
                xhttp.open("GET", "../controller/get_both.php?key=" + w + "&key2=" + v);
                xhttp.send();
            }

        });
    </script>
</body>

</html>