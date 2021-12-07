<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:../../Login Module/view/login.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";



if(isset($_SESSION["NID"])){
    $NID=$_SESSION["NID"];

    $data=array(
        'NID'=>$NID
    );

    require_once '../controller/getuserData.php';

    $renterdashboard=new getDataFromFile($data);

    $renter=$renterdashboard->checkFromFiles($data);

    $Name=$renter['name'];
    $Gender=$renter['gender'];
    $Email=$renter['email'];
    $Password=$renter['password'];
    $Image=$renter['Image'];

     require_once '../controller/getpayment.php';
    $viewpayment=new getpayment($_GET["id"]);
    $payment=$viewpayment->fetchrentpayment($_GET["id"]);

}



?>

<?php

 include '../header.php';

   ?>

<html>
<head>
	<meta charset="utf-8">
	<title>Delete rent</title>
    <link rel="shortcut icon" href="../images/logo-home.ico">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body class="bd">
    
     <br><br><br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account<hr></legend>

       <div style="display: flex;">

        <div>

            <?php
         include "menu.php";

         ?>
        </div>


          <div style="display: inline-block; padding-left: 40px;">

                 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <?php
             
              echo "Renter Id         :".$payment["RID"]."<br>";
              echo "AD No         :".$payment["ADNo"]."<br>";
              echo "Rent Amount      :".$payment["RAmount"]."<br>";
              echo "Rent Month     :".$payment["RMonth"]."<br>";
              echo "Payment System  :".$payment["PaymentSystem"]."<br><br>";
            
              ?>
              
              <a href="../controller/dltpayment.php?id=<?php echo $payment['RNo'] ?>" class="button1" onclick="return confirm('Are you sure want to delete this ?')">Delete</a>&nbsp;
              <a href="renthistory.php">Go Back</a>
       </form>
   </div>
  
   </div>
   <?php
                      include "footer.php";
                    ?>

</body>
</html>
