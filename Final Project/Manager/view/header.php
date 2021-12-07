<?php
$NID="";
$Full_Name=$Email=$Gender=$Password=$Image="";
if(!isset($_SESSION["NID"])){
    session_destroy();
    header("location:accountant_login.php");
}
if(isset($_SESSION["NID"])){
    $NID=$_SESSION["NID"];

    $data=array(
        'NID'=>$NID
    );

    require_once '../controller/getaccountantData.php';

    $accountant_dashboard=new getDataFromFile($data);

    $manager=$accountant_dashboard->checkFromFiles($data);

    $Full_Name=$manager['Name'];
    $Gender=$manager['Gender'];
    $Email=$manager['Email'];
    $Password=$manager['Password'];

}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Faster+One&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar fixed-top navbar-dark bg-info" style="background: linear-gradient(to right, #fffc00, #ffffff);">
        <div>&nbsp;&nbsp;<img class="rounded float-end" src="../images/logo2.png" width="40px" height="35px"></div>
        <div style="font-family: 'Faster One', cursive;font-size:26px">Lets Find Home</div>
        <div style="font-family: 'Titillium Web', sans-serif;"><?php echo "Hi, " . $Full_Name; ?>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <a href="log_out.php" style="padding-right:5px" class="btn btn-outline-danger"><span>&nbsp;&nbsp;Logout&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
        </div>
    </nav>
</body>

</html>