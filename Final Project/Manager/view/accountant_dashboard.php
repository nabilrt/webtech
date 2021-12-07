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

    require_once '../controller/fetch_trans_count.php';

    $t_count = trans_count();

    require_once '../controller/fetch_amount_spent.php';

    $a_amount = get_amount_spent();
}



?>

<br></br>
<?php
include 'header.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Recursive&display=swap" rel="stylesheet">
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
        <div style="display: inline-block; padding-left: 20px; font-family: 'Recursive', sans-serif; font-size:20px">

            <br>
            &nbsp; &nbsp;
            <?php
            echo " <b>   Hi , " . $Full_Name . "</b>";
            ?>
            <br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card" style="width: 25rem;">
                            <p style="font-size:50px; text-align:center; color:#f12711"><?php echo $t_count; ?></p>
                            <div class="card-body">
                                <h5 class="card-title"><b>Number of Transactions</b></h5>
                                <p class="card-text">The statistics shows how many transactions have been made throughout the application lifetime.</p>
                                <a href="manage_transactions.php" class="btn btn-outline-warning">Show Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 25rem;">
                            <p style="font-size:50px; text-align:center; color:#f12711"><?php echo $a_amount; ?></p>
                            <div class="card-body">
                                <h5 class="card-title"><b>Amount Spend</b></h5>
                                <p class="card-text">This stats shows how much expense is there to maintain this website throughout lifetime.</p>
                                <a href="#" class="btn btn-outline-warning">Show Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div><br><br>

    <?php
    include 'footer.php';
    ?>
</body>

</html>