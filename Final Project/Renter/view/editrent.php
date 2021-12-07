<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:../../Login Module/view/login.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";

$ramount="";
$rmonth="";


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

     require_once '../controller/edit_rent.php';
    $RNo=$_GET["id"];
    $showpayment=new getrent($RNo);
    $payment=$showpayment->fetchrent($RNo);

    $ramount=$payment["RAmount"];
    $rmonth=$payment['RMonth'];
    if(isset($_POST["edit"])){


        $data_p=array(
              'RNo'=>$_POST["id"], 

              'RAmount'=>$_POST["ramount"],
              'RMonth'=>$_POST["rmonth"],
      );

        require_once '../controller/updatepayment.php';
            $editrent=new editpayment($data_p);
            $editrent->editpay($data_p);
           
            $message=$editrent->get_message();
            
            
    }

}



?>


 <?php

 include '../header.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
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
                    <form onsubmit="return editrentvalidation()" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <label><b>Rent Amount</b></label><br>
         <input type="text" name="ramount" id="r_amount" onkeyup="return ramountvalidation()" onblur="return ramountvalidation()"placeholder="Rent Amount" value="<?php echo $ramount;?>">
         <br>
          <span id="r_amountError" style="color: red;">
        
    </span>
                        
                    <br><br>

                 <label><b>Rent Month:</b>&nbsp; </label><br>
                   <input type="text" id="r_month" name="rmonth"  onkeyup="return rmonthvalidation()" onblur="return rmonthvalidation()"value="<?php echo $rmonth;?>" placeholder="Rent Month">
                <br>
                 <span id="r_monthError" style="color: red;">



                 </span>
              
                  
                    <br></br>

                
                         <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                        <input type="submit" name="edit" value="Submit">&nbsp; <a href="renthistory.php"  target="_self" class="button1"> Go to back</a><br>
                        <?php
                        if (isset($message)) {
                            echo "<span style='color:green'><b>" . $message . "</b></span><br>";
                        }
                        ?>
                        </form>
              
    </div>    
    </div>
                    <?php
                      include "footer.php";
                    ?>
          <script>
             function editrentvalidation()
                        {
                            var r_amountError="";
                            var r_monthError="";
                            var r=document.getElementById("r_amount").value;
    if(r=="")
    {
        document.getElementById("r_amountError").innerHTML="Rent amount is required";
        r_amountError="Error";
    }
    else
    {

          
          
            r_amountError="";
            document.getElementById("r_amountError").innerHTML="";
        }
        
        
         var p=document.getElementById("r_month").value;
    if(p=="")
    {
        document.getElementById("r_monthError").innerHTML="Rent month is required";
        r_monthError="Error";
    }
    else{
            r_monthError="";
            document.getElementById("r_monthError").innerHTML="";
        }

if(r_amountError!=""||r_monthError!=""){
        return false;
    }else if(r_amountError==""&&r_monthError==""){
        return true;
    }
}
function ramountvalidation()
{
 var r_amountError="";
 var r=document.getElementById("r_amount").value;
    if(r=="")
    {
        document.getElementById("r_amountError").innerHTML="Rent amount is required";
        r_amountError="Error";
    }
    else{


         if(isNaN(r)==true){
            document.getElementById("r_amountError").innerHTML="Rent amount can have numbers only";
            r_amountError="Error";
        }
   
    else{

            r_amountError="";
            document.getElementById("r_amountError").innerHTML="";
        }
    }
    

if(r_amountError!=""){
        return false;
    }
    else if(r_amountError==""){
        return true;
    }
}
function rmonthvalidation()
{
  var r_monthError="";
  var p=document.getElementById("r_month").value;
    if(p=="")
    {
        document.getElementById("r_monthError").innerHTML="Rent month is required";
        r_monthError="Error";
    }
    else{
            r_monthError="";
            document.getElementById("r_monthError").innerHTML="";
        }

if(r_monthError!=""){
        return false;
    }
    else if(r_monthError==""){
        return true;
    }
}


        </script>

</body>
</html>