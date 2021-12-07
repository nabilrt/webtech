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

    $trans_id = $_GET["id"];

    require_once '../controller/fetch_expense.php';

    $exp = retrieve_expense($trans_id);
}

?>

<?php
include 'header.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Show Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body class="bd">
    <br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;AccountAccount
        <hr>
        <hr>
        <hr>
    </legend>
    <div style="display: flex">
        <div>
            <?php include 'menu.php'; ?>
        </div>
        <div style="display: inline-block; padding-left: 30px; font-family: 'Rubik', sans-serif; font-size:15px">
            <br><br>
            <h4 style="font-family: 'Barlow Semi Condensed', sans-serif;"><b>Transaction Details</b></h4><br>
            <label for="" class="form-label">Transaction ID : <?php echo $exp["Transaction"]; ?></label> <br>
            <label for="" class="form-label">Sector : <?php echo $exp["Reason"]; ?></label> <br>
            <label for="" class="form-label">Amount : <?php echo $exp["Amount"]; ?></label> <br>
            <label for="" class="form-label">Description : <?php echo $exp["Description"]; ?></label> <br><br>
            <a href="manage_expense.php" target="_self" class="btn btn-secondary">Go Back</a>
        </div>

    </div><br><br><br><br>

    <?php
    include 'footer.php';
    ?>
</body>

</html>