<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = $Degree = "";
if (!isset($_SESSION["NID"])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $NID
    );

    require_once '../controller/getaccountantData.php';

    $accountant_dashboard = new getDataFromFile($data);

    $manager = $accountant_dashboard->checkFromFiles($data);

    $Full_Name = $manager['Name'];
    $Gender = $manager['Gender'];
    $Email = $manager['Email'];
    $Password = $manager['Password'];
    $Degree = $manager['Degree'];
}



?>

<br></br>
<?php
include 'header.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>View Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body class="bd">
    <br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account
        <hr>
    </legend>
    <div style="display: flex">
        <div>
            <?php include 'menu.php'; ?>
        </div>
        <div style="display: inline-block; padding-left: 40px; font-family: 'Rubik', sans-serif; font-size:20px">

            <h4 style="font-family: 'Inter', sans-serif;">Manager Informations</h4><br>

            <label class="form-label"><b>Name</b> : <?php echo $Full_Name; ?></label><br>
            <label class="form-label"><b>Email</b> : <?php echo $Email; ?></label><br>
            <label class="form-label"><b>Gender</b> : <?php echo $Gender; ?></label><br>
            <label class="form-label"><b>Degree</b></label><br>
            <img src="<?php echo $Degree; ?>" alt="" height="150px" width="150px">

        </div>

    </div><br><br>

    <?php
    include 'footer.php';
    ?>
</body>

</html>