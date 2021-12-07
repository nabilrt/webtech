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

    require_once '../controller/get_payment_history.php';

    $pays = get_history();
}



?>

<br></br>
<?php
include 'header.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Manage Payments</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overlock&display=swap" rel="stylesheet">
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
        <div style="display: inline-block; padding-left: 30px; font-family: 'Rubik', sans-serif; font-size:15px">
            <h3 style="font-family: 'Overlock', cursive;"><b>Rent Transactions</b></h3><br>
            <table class="table table-bordered" id="pay">
                <tr class="table-warning">
                    <th class="table-warning">Owner ID&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-warning">Renter ID&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-warning">Rent Amount&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-warning">AD No.&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-warning">Month Paid For&nbsp;&nbsp;&nbsp;</th>
                </tr>
                <?php
                foreach ($pays as $row) {
                    echo '<tr><td class="table-light">' . $row["Owner_ID"] . '</td>
                          <td class="table-light">' . $row["Renter_ID"] . '</td>
                          <td class="table-light">' . $row["Paid"] . '</td>
                          <td class="table-light">' . $row["AD_No"] . '</td>
                          <td class="table-light">' .  $row["Month"] . '</tr>';
                }
                ?>
            </table>
            <br>
            <button id="btn" class="btn btn-success">Export Data to Excel</button>
        </div>
    </div><br><br>
    <?php
    include 'footer.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script type="text/javascript">
        $("#btn").click(function() {
            $("#pay").table2excel({
                exclude: ".noExport",
                filename: "Payment History",
            });
        });
    </script>
</body>

</html>