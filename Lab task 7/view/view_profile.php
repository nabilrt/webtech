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

    $owner=$h_owner_dashboard->checkFromFiles($data);

    $Full_Name = $owner['Name'];
    $Gender = $owner['Gender'];
    $Email = $owner['Email'];
    $Password = $owner['Password'];
    $Image = $owner['Image'];
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
                    <div style="display: inline-block; padding-left:45px; ">
                    <h3><b>User Informations</b></h3>
                    <br><br>
                    <?php
                    echo "<b>Name</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;" . $Full_Name . "<br><br>";
                    echo "<b>Gender</b>&nbsp;&nbsp;      :&nbsp;" . $Gender . "<br><br>";
                    echo "<b>Email</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       :&nbsp;" . $Email . "<br><br>";
                    ?>
                    </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
</body>
</html>