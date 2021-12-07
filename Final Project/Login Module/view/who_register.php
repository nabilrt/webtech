<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo-home.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Who To Register</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background: linear-gradient(to right, #ff4b1f, #1fddff);">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><b>Lets Find Home</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="homepage.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br>
  <h4 style="color:#f55536; text-align:center; font-size:30px">PLEASE SELECT YOUR OPTION FROM BELOW</h4>
  <br><br>
    <div class="container">
  <div class="row">
    <div class="col">
    <div class="card" style="width: 18rem;">
                <img src="../images/rn1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Renter</h5>
                    <p class="card-text">Join as renter enjoy the facilities such as searching ads, requesting for rent, payment handling and many more.</p>
                    <a href="../../Renter/view/Regform.php" class="btn btn-outline-primary">Join as Renter</a>
                </div>
            </div>
    </div>
    <div class="col">
    <div class="card" style="width: 18rem;">
                <img src="../images/ceo.jpg" class="card-img-top" alt="..." >
                <div class="card-body">
                    <h5 class="card-title">House Owner</h5>
                    <p class="card-text">Join as house owner to enjoy the facilities such as posting ads, managing renters, payment handling and many more.</p>
                    <a href="../../House Owner/view/howner_reg.php" class="btn btn-outline-info">Join as House Owner</a>
                </div>
            </div>
    </div>
    <div class="col">
    <div class="card" style="width: 18rem;">
                <img src="../images/manager.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Manager</h5>
                    <p class="card-text">Join as manager to get responsibilities of managing the expenses and the payments system of whole website.</p>
                    <a href="../../Manager/view/accountant_registration.php" class="btn btn-outline-warning">Join as Manager</a>
                </div>
            </div>
    </div>
  </div>
</div><br><br><br>
    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>