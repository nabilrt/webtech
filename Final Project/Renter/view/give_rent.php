<?php
session_start();
if (!isset($_SESSION['NID'])) {
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
$NID = "";
$Name = $Email = $Gender = $Password = $Image = "";
$adNo = $rid = $r_amount = $r_month = $payment = $rno = "";


if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $NID
    );

    require_once '../controller/getuserData.php';

    $renterdashboard = new getDataFromFile($data);

    $renter = $renterdashboard->checkFromFiles($data);

    $Name = $renter['name'];
    $Gender = $renter['gender'];
    $Email = $renter['email'];
    $Password = $renter['password'];
    $Image = $renter['Image'];

    if (isset($_POST["submit"])) {

        $data_s = array(
            'Renter_ID' => $_SESSION["NID"],
            'Adno' => $_POST["a_id"],
            'ramount' => $_POST["r_amount"],
            'rmonth' => $_POST["r_month"],
            'paid' => $_POST["paid"],

            'Owner_ID' => $_POST["owner_id"]


        );

        require_once '../controller/giverent.php';

        $give_notice = new giveNotice($data_s);

        $give_notice->g_notice($data_s);

        $message = $give_notice->get_message();
    }

    require_once '../controller/get_pay_details.php';
    $id = $_SESSION["NID"];

    $get_p = new getPayDetails($id);

    $ads = $get_p->get_pay($id);
}



?>


<?php

include '../header.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Pay Rent</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>

<body class="bd">
    <br><br><br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account
        <hr>
    </legend>
    <div style="display: flex;">

        <div>

            <?php
            include "menu.php";

            ?>
        </div>

        <div style="display: inline-block; padding-left: 40px;">


            <form onsubmit="return rentvalidation()" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <label><b>AD No</b></label><br>

                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" onclick="return adno()" onkeyup="return adno()" onblur="return adno()" name="a_id" id="a_id" onchange="get_data()">
                    <option value="" selected>Select AD No</option>
                    <?php if (!empty($ads))
                        foreach ($ads as $ad) : ?>
                        <?php echo '<option id="val" value=' . $ad["AD_No"] . '>' . $ad['AD_No'] . '</option>'; ?>
                    <?php endforeach; ?>
                </select>
                <span id="adNoError" style="color: red;">
                </span>
                <br>


                <label><b>Owner ID</b></label><br>
                <input type="text" name="owner_id" id="rid" class="form-control"><br>

                <label><b>Rent Amount</b></label><br>
                <input type="text" name="r_amount" id="r_amount" class="form-control"><br>

                <label><b>Which month do you want to give rent</b></label><br>

                <select id="r_month" name="r_month" onclick="return rmonth()" onkeyup="return rmonth()" onblur="return rmonth()" class="form-control">
                    <option value="" disabled selected hidden>Select a month</option>
                    <option value="January">Jan</option>
                    <option value="February">Feb</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">Aug</option>
                    <option value="September">Sep</option>
                    <option value="October">Oct</option>
                    <option value="November">Nov</option>
                    <option value="December">Dec</option>

                </select>

                <span id="r_monthError" style="color: red;">

                </span>
                <br>

                <label><b>Paid amount</b></label><br>
                <input type="text" onclick="return paidamount()" onkeyup="return paidamount()" onblur="return paidamount()" name="paid" id="paid" value="" class="form-control"><br>
                <span id="paidError" style="color: red;">

                </span><br>

                <label><b>Payment System:</b></label>
                <input type="radio" id="m" name="payment" onclick="return paymentsystem()" value="Cash" <?php if (isset($payment) && $payment == "Cash") echo "checked"; ?>>
                <label for="" class="form-label">Cash</label>

                <input type="radio" id="f" name="payment" onclick="return paymentsystem()" value="Bkash" <?php if (isset($payment) && $payment == "Bkash") echo "checked"; ?>>
                <label for=" " class="form-label">Bkash</label>
                <input type="radio" id="p" name="payment" onclick="return paymentsystem()" value="Credit card" <?php if (isset($payment) && $payment == "Credit card") echo "checked"; ?>>
                <label for="" class="form-label">Credit Card</label>
                <br>
                <span id="paymentError" style="color: red;">
                </span>
                <br></br>
                <input type="submit" name="submit" id="pn" value="Pay" class="btn btn-outline-primary"><br><br>
                <span style="color: red;">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </span>
            </form>

        </div>
    </div>
    <?php
    include "footer.php";
    ?>
    <script>
        function rentvalidation() {
            var rNoError = "";

            var adNoError = "";
            var ridError = "";
            var r_amountError = "";
            var r_monthError = "";
            var paymentError = "";
            var paidError = "";

            var x = document.getElementById("a_id").value;
            if (x == "") {
                document.getElementById("adNoError").innerHTML = "Ad no is required";
                adNoError = "Error";
            } else {
                adNoError = "";
                document.getElementById("adNoError").innerHTML = "";
            }

            var s = document.getElementById("paid").value;
            if (s == "") {
                document.getElementById("paidError").innerHTML = "Paid amount is required";
                paidError = "Error";
            } else {
                paidError = "";
                document.getElementById("paidError").innerHTML = "";
            }




            var p = document.getElementById("r_month").value;
            if (p == "") {
                document.getElementById("r_monthError").innerHTML = "Rent month is required";
                r_monthError = "Error";
            } else {
                r_monthError = "";
                document.getElementById("r_monthError").innerHTML = "";
            }


            if (document.getElementById("m").checked == false && document.getElementById("f").checked == false &&
                document.getElementById("p").checked == false) {
                document.getElementById("paymentError").innerHTML = "Payment System is required";
                paymentError = "Error";
            } else {
                paymentError = "";
                document.getElementById("paymentError").innerHTML = "";
            }


            if (adNoError != "" || r_monthError != "" || paymentError != "" || paidError != "") {
                return false;
            } else if (adNoError == "" && r_monthError == "" && paymentError == "" && paidError == "") {
                return true;
            }


        }

        function removeownererror() {
            document.getElementById("ridError").innerHTML = "";
            return true;
        }

        function adno() {
            var adNoError = "";

            var x = document.getElementById("a_id").value;
            if (x == "") {
                document.getElementById("adNoError").innerHTML = "Ad no is required";
                adNoError = "Error";
            } else {
                adNoError = "";
                document.getElementById("adNoError").innerHTML = "";
            }

        }


        function owner()

        {
            var ridError = "";

            var z = document.getElementById("rid").value;
            if (z == "") {
                document.getElementById("ridError").innerHTML = "Owner Id is required";
                ridError = "Error";
            } else {
                ridError = "";
                document.getElementById("ridError").innerHTML = "";
            }
        }


        function rentamount()

        {

            var r_amountError = "";
            var r = document.getElementById("r_amount").value;
            if (r == "") {
                document.getElementById("r_amountError").innerHTML = "Rent amount is required";
                r_amountError = "Error";
            } else {
                r_amountError = "";
                document.getElementById("r_amountError").innerHTML = "";
            }
        }


        function rmonth() {
            var r_monthError = "";
            var p = document.getElementById("r_month").value;
            if (p == "") {
                document.getElementById("r_monthError").innerHTML = "Rent month is required";
                r_monthError = "Error";
            } else {
                r_monthError = "";
                document.getElementById("r_monthError").innerHTML = "";
            }


        }

        function paymentsystem() {
            var paymentError = "";
            if (document.getElementById("m").checked == false && document.getElementById("f").checked == false &&
                document.getElementById("p").checked == false) {
                document.getElementById("paymentError").innerHTML = "Payment System is required";
                paymentError = "Error";
            } else {
                paymentError = "";
                document.getElementById("paymentError").innerHTML = "";
            }


        }

        function paidamount() {
            var paidError = "";

            var s = document.getElementById("paid").value;
            if (s == "") {
                document.getElementById("paidError").innerHTML = "Paid amount is required";
                paidError = "Error";
            } else {
                paidError = "";
                document.getElementById("paidError").innerHTML = "";
            }

        }






        function get_data() {

            var a_id = document.getElementById("a_id").value;


            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {

                var mobj = JSON.parse(this.responseText);
                var a = mobj[0];
                var b = mobj[1];

                document.getElementById("rid").value = a;
                document.getElementById("r_amount").value = b;
            };

            xhttp.open("GET", "../controller/check_ad_details.php?id=" + a_id);
            xhttp.send();
        }
    </script>

</body>

</html>