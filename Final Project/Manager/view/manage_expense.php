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

    require_once '../controller/get_expenses.php';

    $expenses = get_expense();
}



?>

<br></br>
<?php
include 'header.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Manage Expenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
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
        <div style="display: inline-block; padding-left: 30px; font-family: 'Rubik', sans-serif; font-size:15px">
            <div class="container">
                <h4 style="font-family: 'Overpass', sans-serif;"><b>Expenses Management</b></h4><br>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="table-dark">
                            <th class="table-dark"></th>
                            <th class="table-dark">Transaction ID</th>
                            <th class="table-dark">Sector</th>
                            <th class="table-dark">Amount</th>
                            <th class="table-dark"></th>
                        </tr>
                        <?php
                        if (!empty($expenses))
                            foreach ($expenses as $exp) : ?>
                            <tr class="table-light">
                                <td class="table-light"><a href="show_trans.php?id=<?php echo $exp['Transaction'] ?>" class="btn btn-outline-dark">View Details</a></td>
                                <td class="table-light"><?php echo $exp['Transaction'] ?></td>
                                <td class="table-light"><?php echo $exp['Reason'] ?></td>
                                <td class="table-light"><?php echo $exp['Amount'] ?></td>
                                <td class="table-light"><a href="edit_expense.php?id=<?php echo $exp['Transaction'] ?>" class="btn btn-outline-dark">Edit</a>&nbsp<a href="../controller/delete_exp.php?id=<?php echo $exp['Transaction'] ?>" class="btn btn-outline-danger" )>Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

    </div><br><br>

    <?php
    include 'footer.php';
    ?>
</body>

</html>