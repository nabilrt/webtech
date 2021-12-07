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

    require_once '../controller/managerent.php';

    $manage_notices=new getNotices($data);

    $notices=$manage_notices->getTheNotices($data);

}



?>

<?php

 include '../header.php';

   ?>

<html>
<head>
	<meta charset="utf-8">
	<title>Rent History</title>
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
            <h3>Rent History</h3>
        
        <table class="table table-bordered">
       
               <tr class="table-primary">
           
               <th class="table-primary">Rent No:</th>
               <th class="table-primary">Renter ID</th>
               <th class="table-primary">AD No</th>
               <th class="table-primary">Rent Amount</th>
                <th class="table-primary">Rent Month </th>

               <th class="table-primary">Payment System</th>
               <th class="table-primary"></th>
           </tr>
      
       
       <?php if(!empty($notices))
       foreach ($notices as $notice): ?>
            <tr class="table-info">
                <td class="table-info"><a href="viewpayment.php?id=<?php echo $notice['RNo'] ?>" class="btn btn-outline-success">View</a></td>
                <td class="table-info"><?php echo $notice['RID'] ?></td>
                <td class="table-info"><?php echo $notice['ADNo'] ?></td>
                <td class="table-info"><?php echo $notice['RAmount'] ?></td>
                <td class="table-info"><?php echo $notice['RMonth'] ?></td>
                <td class="table-info"><?php echo $notice['PaymentSystem'] ?></td>
                
             <td class="table-info"><a href="editrent.php?id=<?php echo $notice['RNo'] ?>" class="btn btn-outline-success">Edit</a>&nbsp<a href="deleterent.php?id=<?php echo $notice['RNo'] ?>" class="btn btn-outline-success")>Delete</a></td>
            </tr>
        <?php endforeach; ?>
    
   </table>
  
        </form>
    </div>    
    </div>
                    <?php
                      include "footer.php";
                    ?>

</body>
</html>