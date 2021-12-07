<?php

require_once '../controller/get_all_ads.php';

$all_ads = new get_all_ads();

$all = $all_ads->get_a_ads();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../images/logo-home.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cherry+Swash&family=Faster+One&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+2&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
  <title>View Advertisements</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-info">
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
            <a class="nav-link" href="howner_reg.php">Registration</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="howner_login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../images/liv2.jpg" class="d-inline w-100" alt="..." height="600px" width="400px">
              <div class="carousel-caption d-none d-md-block">
                <h5 style="color:black">Houses as your need</h5>
                <p style="color:#048A81;"><b>You can find houses according to your budget</b></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="../images/liv3.jpg" class="d-block w-100" alt="..." height="600px" width="400px">
              <div class="carousel-caption d-none d-md-block">
                <h5 style="color:#C60F7B;">Hassle Free Payment</h5>
                <p style="color:#F5F749;"><b>You will be able to pay rent inside the application</b></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="../images/liv4.png" class="d-block w-100" alt="..." height="600px" width="400px">
              <div class="carousel-caption d-none d-md-block">
                <h5 style="color:#C60F7B">Uncountable number of Ads</h5>
                <p style="color:#3F3047"><b>You have thousands of house to choose from</b></p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div>
  </div>
  <br>
  <div style="text-align: center">
    <p style="font-family: 'Overpass', sans-serif;"><b>Check out the current ads available <span style="color:#9DACFF">[Register with us to get more features]</span></b></p>
  </div>
  <div class="container">
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr class="table-dark">
          <th class="table-dark"></th>
          <th class="table-dark">AD Rent</th>
          <th class="table-dark">AD Area</th>
          <th class="table-dark">AD Address</th>
        </tr>
        <?php
        if (!empty($all))
          foreach ($all as $ad) : ?>
          <tr class="table-dark">
            <td class="table-light"><a href="show_gen_ads.php?id=<?php echo $ad['AD_ID'] ?>" class="btn btn-outline-info">View Details</a></td>
            <td class="table-light"><?php echo $ad['AD_Rent'] ?></td>
            <td class="table-light"><?php echo $ad['AD_Area'] ?></td>
            <td class="table-light"><?php echo $ad['AD_Address'] ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>