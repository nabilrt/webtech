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

    require_once '../controller/get_payments.php';
    $payments = new getPayments($_SESSION["NID"]);
    $pays = $payments->get_pays($_SESSION["NID"]);
}

?>

<br></br>
<?php
include 'new_header.php';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

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
        <div style="display: inline-block; padding-left:40px; font-family: 'Lato', sans-serif;">
            <h3><b>Rent Records</b></h3><br>
            <table class="table table-bordered" id="pay">
                <tr class="table-primary">
                    <th class="table-primary">Renter ID&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">Rent Amount&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">AD No.&nbsp;&nbsp;&nbsp;</th>
                    <th class="table-primary">Month Paid For&nbsp;&nbsp;&nbsp;</th>
                </tr>
                <?php
                foreach ($pays as $row) {
                    echo '<tr><td class="table-info">' . $row["Renter_ID"] . '</td>
                          <td class="table-info">' . $row["Paid"] . '</td>
                          <td class="table-info">' . $row["AD_No"] . '</td>
                          <td class="table-info">' .  $row["Month"] . '</tr>';
                }
                ?>
            </table>
            <br>
            <button id="btn" class="btn btn-primary">Export Data to Excel</button>
        </div>
    </div><br>
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