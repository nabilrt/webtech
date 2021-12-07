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

    require_once '../controller/getaccountantData.php';

    $accountant_dashboard = new getDataFromFile($data);

    $manager = $accountant_dashboard->checkFromFiles($data);

    $Full_Name = $manager['Name'];
    $Gender = $manager['Gender'];
    $Email = $manager['Email'];
    $Password = $manager['Password'];
}



?>

<br></br>
<?php
include 'header.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Search Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap" rel="stylesheet">
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
        <div style="display: inline-block; padding-left: 20px; font-family: 'Rubik', sans-serif; font-size:15px">
            <div class="container">
                <h5 style="font-family: 'Space Grotesk', sans-serif;"><b>Search from your expense by sector</b></h5><br>
                <div class="col-12">
                    <label for="key" class="form-label">Sector Name</label><br>
                    <input type="text" name="keyword" id="key" class="form-control">
                    <span id="noKeyError" style="color:red"></span>
                </div>
            </div><br>
            <div class="container" id="result"></div>
        </div>
    </div><br><br>
    <?php
    include 'footer.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#key').keyup(function() {

            var keyword = $('#key').val();

            if (keyword == "") {

                $('#result').css('color', 'red');
                $('#result').html("Please Type Something");

            } else if (keyword != "") {

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if (this.responseText != "") {
                        $('#result').html(this.responseText);
                    } else if (this.responseText == "") {
                        $('#result').html("No Result Found");
                    }
                }
                xhttp.open("GET", "../controller/results.php?key=" + keyword);
                xhttp.send();
            }
        })
    </script>
</body>

</html>