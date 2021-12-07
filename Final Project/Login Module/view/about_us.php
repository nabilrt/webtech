<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind&display=swap" rel="stylesheet">
    <title>About Us</title>
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
                        <a class="nav-link" href="who_register.php">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
    <h4 style="color:#373b44; text-align:center; font-size:30px">LETS FIND HOME DEVELOPERS</h4><br>
    <div class="container">
        <div class="row">
            <div class="col">
                <span style="font-size:25px; color:#2980b9; text-align:center; font-family: 'Poppins', sans-serif;">House Owner</span>
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="..." id="hoi">
                    <div class="card-body">
                        <h5 class="card-title" id="ho">Card title</h5>
                        <p class="card-text" id="hod" style="font-size:15px; font-family: 'Hind', sans-serif;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <span style="font-size:25px; color:#0575e6; text-align:center; font-family: 'Poppins', sans-serif;">Renter</span>
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="..." id="rni">
                    <div class="card-body">
                        <h5 class="card-title" id="rn">Card title</h5>
                        <p class="card-text" id="rnd" style="font-size:15px; font-family: 'Hind', sans-serif;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <span style="font-size:25px; color:#ed213a; text-align:center; font-family: 'Poppins', sans-serif;">Admin</span>
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="..." id="adi">
                    <div class="card-body">
                        <h5 class="card-title" id="ad">Card title</h5>
                        <p class="card-text" id="add" style="font-size:15px; font-family: 'Hind', sans-serif;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <span style="font-size:25px; color:#ffe000; text-align:center; font-family: 'Poppins', sans-serif;">Manager</span>
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="..." id="mni">
                    <div class="card-body">
                        <h5 class="card-title" id="mn">Card title</h5>
                        <p class="card-text" id="mnd" style="font-size:15px; font-family: 'Hind', sans-serif;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            var xmlhttp = new XMLHttpRequest();
            var url = "../json/about_us.json";

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    data_set = JSON.parse(this.responseText);
                    $('#ho').html(data_set[0].Name);
                    $('#hod').html(data_set[0].Description);
                    $('#hoi').attr('src', data_set[0].Image);
                    $('#rn').html(data_set[1].Name);
                    $('#rnd').html(data_set[1].Description);
                    $('#rni').attr('src', data_set[1].Image);
                    $('#ad').html(data_set[2].Name);
                    $('#add').html(data_set[2].Description);
                    $('#adi').attr('src', data_set[2].Image);
                    $('#mn').html(data_set[3].Name);
                    $('#mnd').html(data_set[3].Description);
                    $('#mni').attr('src', data_set[3].Image);
                }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();

        });
    </script>
</body>

</html>