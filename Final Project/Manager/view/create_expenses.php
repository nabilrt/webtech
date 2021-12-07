<?php
session_start();
$NID = "";
$Full_Name = $Email = $Gender = $Password = $Image = "";
$sectorError = $amountError = $descError = "";
$error = $message = "";
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

    require_once '../controller/trans_count.php';

    $t_id = (int)get_transaction();

    $trans_id = "T-" . strval($t_id + rand(10,1000));

    if (isset($_POST["expense"])) {

        $data_e = array(
            'Transaction_ID' => $_POST["t_id"],
            'Sector' => $_POST["sector"],
            'Amount' => $_POST["amount"],
            'Description' => $_POST["reason"]
        );

        require_once '../controller/add_expense.php';

        $c_expense = new createExpense($data_e);

        $c_expense->addExpense($data_e);

        $error = $c_expense->get_error();
        $message = $c_expense->get_message();

        $sectorError = $error["sectorErr"];
        $amountError = $error["amountErr"];
        $descError = $error["descErr"];
    }
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
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
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
                <h4 style="font-family: 'Cabin', sans-serif;"><b>Create Expenses</b></h4><br>
                <form id="cr_exp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="t_id" value="<?php echo $trans_id; ?>">
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Sector</label>
                        <div class="col-sm-10">
                            <input type="text" name="sector" id="sect" class="form-control">
                            <span id="sectorError" style="color:red">
                                <?php

                                if ($sectorError != "") {

                                    echo $sectorError;
                                }

                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                            <input type="text" name="amount" id="cost" class="form-control">
                            <span style="color:red" id="amountError">
                                <?php

                                if ($amountError != "") {

                                    echo $amountError;
                                }

                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-10">
                            <textarea name="reason" id="res" cols="30" rows="10" class="form-control"></textarea>
                            <span style="color:red" id="reasonError">
                                <?php

                                if ($descError != "") {

                                    echo $descError;
                                }

                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-10">&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                        <input type="submit" value="Create Expense" name="expense" id="exp" class="btn btn-primary"><br>
                        <span style="color:green">&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                            <?php

                            if ($message != "") {

                                echo $message;
                            }

                            ?>
                        </span>
                    </div>
                </form>

            </div>
        </div>

    </div><br><br>

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