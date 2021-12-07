<?php

require_once '../controller/get_the_ad.php';
$show_Ad = new getTheAd($_GET["id"]);
$ad = $show_Ad->fetchAnAd($_GET["id"]);

?>
<br></br>
<html>

<head>
    <meta charset="utf-8">
    <title>View Ad</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <!--Importing bootstrap 5-->
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
</head>

<body class="bd">
    <br>
    <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;">ADS INFORMATION
        <hr>
    </legend>
    <div style="display:flex">
        <div style="display:inline-block; padding-left:45px; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
            <h3><b>AD Details</b></h3><br>
            <?php
            echo "<b>ID</b>           :&nbsp;&nbsp;"  . $ad["AD_ID"] . "<br>";
            echo "<b>Rent</b>         :&nbsp;&nbsp;"  . $ad["AD_Rent"] . "<br>";
            echo "<b>Area</b>         :&nbsp;&nbsp;"  . $ad["AD_Area"] . "<br>";
            echo "<b>Address</b>      :&nbsp;&nbsp;"  . $ad["AD_Address"] . "<br>";
            echo "<b>Description</b>  :&nbsp;&nbsp;"  . $ad["AD_des"] . "<br><br>";
            echo "<img src= " . $ad["Picture1"] . " height='150px' width='280px' class='rounded float-start'>&nbsp;&nbsp;";
            echo "<img src= " . $ad["Picture2"] . " height='150px' width='280px' class='rounded float-start'>&nbsp;&nbsp;";
            echo "<img src= " . $ad["Picture3"] . " height='150px' width='280px' class='rounded float-start'><br><br>";
            ?>
            <br><br><br><br><br><a href="general.php" class="btn btn-outline-primary">Go Back</a>
        </div>
    </div><br><br><br><br><br>
    <?php
    include 'footer.php';
    ?>
</body>

</html>