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

    if (isset($_POST["edit_exp"])) {

        $data_e = array(
            'Transaction_ID' => $_POST["t-id"],
            'Sector' => $_POST["sector"],
            'Amount' => $_POST["amount"],
            'Description' => $_POST["reason"]
        );

        require_once '../controller/update_expense.php';

        update_Exp($data_e);
    }
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
            <div class="container">
                <h4 style="font-family: 'Barlow Semi Condensed', sans-serif;"><b>Edit Expense Details</b></h4><br>
                <label for="" class="form-label">Transaction ID : <?php echo $exp["Transaction"]; ?></label> <br>
                <form id="cr_exp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <input type="hidden" name="t-id" id="tid" value="<?php echo $_GET['id']; ?>">
                        <label for="" class="form-label">Sector</label> <br>
                        <input type="text" name="sector" id="sect" value="<?php echo $exp["Reason"]; ?>" class="form-control">
                        <span id="sectorError" style="color:red"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Amount</label> <br>
                        <input type="text" name="amount" id="cost" class="form-control" value="<?php echo $exp["Amount"]; ?>">
                        <span id="amountError" style="color:red"></span>
                    </div>
                    <div class="col-12">
                        <label for="" class="form-label">Description</label> <br>
                        <textarea name="reason" id="res" cols="30" rows="10" class="form-control"><?php echo $exp["Description"]; ?></textarea>
                        <span id="reasonError" style="color:red"></span>
                    </div>
                    <div class="col-md-6">
                        <input type="submit" value="Edit" name="edit_exp" class="btn btn-primary">
                        <a href="manage_expense.php" target="_self" class="btn btn-secondary">Go Back</a>
                    </div>
                </form><br>
            </div>
        </div>
    </div><br><br><br><br>
    <?php
    include 'footer.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#cr_exp').submit(function() {

            var reasonError = "";
            var amountError = "";
            var descError = "";

            var reason = $('#sect').val();
            var amount = $('#cost').val();
            var desc = $('#res').val();

            if (reason == "") {

                reasonError = "Error";
                $('#sectorError').html("Sector cannot be Empty");

            } else {
                reasonError = "";
                $('#sectorError').html("");
            }

            if (amount == "") {

                amountError = "Error";
                $('#amountError').html("Amount cannot be Empty");

            } else {

                if (isNaN(amount) == true) {
                    amountError = "Error";
                    $('#amountError').html("Amount cannot only be numbers");
                } else {
                    amountError = "";
                    $('#amountError').html("");
                }

            }

            if (desc == "") {
                descError = "Error";
                $('#reasonError').html("Description cannot be empty");
            } else {
                descError = "";
                $('#reasonError').html("");
            }

            if (amountError != "" || descError != "" || reasonError != "") {

                return false;

            } else {

                return true;
            }

        });

        $('#sect').keyup(function() {

            var reasonError = "";

            var reason = $('#sect').val();

            if (reason == "") {

                reasonError = "Error";
                $('#sectorError').html("Sector cannot be Empty");

            } else {
                reasonError = "";
                $('#sectorError').html("");
            }

            if (reasonError != "") {

                return false;

            } else {

                return true;
            }


        });

        $('#cost').keyup(function() {

            var amountError = "";
            var amount = $('#cost').val();

            if (amount == "") {

                amountError = "Error";
                $('#amountError').html("Amount cannot be Empty");

            } else {

                if (isNaN(amount) == true) {
                    amountError = "Error";
                    $('#amountError').html("Amount cannot only be numbers");
                } else {
                    amountError = "";
                    $('#amountError').html("");
                }

            }

            if (amountError != "") {

                return false;

            } else {

                return true;
            }
        });

        $('#res').keyup(function() {

            var descError = "";
            var desc = $('#res').val();

            if (desc == "") {
                descError = "Error";
                $('#reasonError').html("Description cannot be empty");
            } else {
                descError = "";
                $('#reasonError').html("");
            }

            if (descError != "") {

                return false;

            } else {

                return true;
            }

        });
    </script>
</body>

</html>