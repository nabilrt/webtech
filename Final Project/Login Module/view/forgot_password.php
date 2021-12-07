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
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
    <title>Forgot Password</title>
</head>

<body style="background: linear-gradient(to right, #c9d6ff, #e2e2e2);">
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
    <h4 style="text-align: center; font-family: 'Overpass', sans-serif; font-size:30px">PASSWORD RECOVERY</h4><br><br>
    <div style="padding-left: 30px;">
        <label style="font-family: 'Outfit', sans-serif;">Enter email</label><br>
        <div class="input-group">
            <input type="text" name="mail" id="email" class="form-control" placeholder="">
            <button id="btn-check" class="btn btn-outline-primary" type="button">Check Email</button>
            <button onclick="window.location.href='login.php'" class="btn btn-outline-danger" type="button">Go Back</button>
        </div>
        <br><span style="color:red" id="mailError"></span><span style="color:red" id="maiError"></span><br><br>
        <label id="np"></label><br>
        <input type="hidden" name="new_pass" id="new_password">&nbsp;&nbsp;<input type="hidden" id="p_show"><span id="sp1"></span>
        <br><span id="npError" style="color:red"></span><br><br>
        <label id="cp"></label><br>
        <input type="hidden" name="con_pass" id="conf_pass">&nbsp;&nbsp;<input type="hidden" id="cp_show"><span id="sp2"></span>
        <br><span id="cpError" style="color:red"></span><br><br>
        <input type="hidden" id="btn-update" class="btn btn-outline-primary" value="Update Password"><br><br>
        <span id="confirmed" style="color:green"></span><br>

    </div><br><br><br><br>
    <?php
    include 'footer.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $("#btn-check").click(function() {
            var x = $('#email').val();
            if (x == "") {
                $('#mailError').html('Email cannot be empty');
            } else if (x !== "") {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if (this.responseText == "true") {
                        $('#conf_pass').get(0).type = 'password';
                        $('#btn-update').get(0).type = 'button';
                        $('#new_password').get(0).type = 'password';
                        $('#np').html('New Password');
                        $('#cp').html('Confirm New Password');
                        $('#mailError').html('Email Found');
                        $('#mailError').css('color', 'green');
                        $('#p_show').get(0).type = 'checkbox';
                        $('#cp_show').get(0).type = 'checkbox';
                        $('#sp1').html("Show Password");
                        $('#sp2').html("Show Password");
                    } else if (this.responseText == "false") {
                        $('#mailError').html('Email does not exist');
                    }
                }
                xhttp.open("GET", "../controller/check_email.php?mail=" + x);
                xhttp.send();
            }
        });

        $('#btn-update').click(function() {
            var n_pass = $("#new_password").val();
            var c_pass = $("#conf_pass").val();
            var x = $('#email').val();
            var e_regex = new RegExp("[\'^£$%&*()}{@#~?><>,|=_+¬-]");
            if (n_pass == "") {
                $('#npError').html("This Field Cannot be Blank");
            } else {
                if (/[a-z]+/.test(n_pass) == false) {
                    $('#npError').html("Your Password should contain at least one small letter");
                } else if (e_regex.test(n_pass) == false) {
                    $('#npError').html("Your Password should contain at least one special character");
                } else if (/[0-9]+/.test(n_pass) == false) {
                    $('#npError').html("Your Password should contain at least one number");
                } else if (n_pass.length < 8) {
                    $('#npError').html("Your Password should contain at least 8 characters");
                } else {
                    $('#npError').html("");
                }
            }
            if (c_pass == "") {
                $('#cpError').html("This Field cannot be Blank");
            } else {
                if (c_pass != n_pass) {
                    $('#cpError').html("Passwords Does Not Match");
                } else {
                    $('#cpError').html("");
                }
            }
            if (c_pass != "" && n_pass != "") {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if (this.responseText == "true") {
                        update_All();

                    } else if (this.responseText == "false") {
                        $('#mailError').css('color', 'red');
                        $('#mailError').html('Some Error Occurred');
                    }
                }
                xhttp.open("GET", "../controller/update_pass.php?pass=" + n_pass + "&mail=" + x);
                xhttp.send();
            }

        });

        function update_All() {

            $('#conf_pass').get(0).type = 'hidden';
            $('#btn-update').get(0).type = 'hidden';
            $('#new_password').get(0).type = 'hidden';
            $('#np').html('');
            $('#cp').html('');
            $('#mailError').html('');
            $('#mailError').css('color', 'green');
            $('#p_show').get(0).type = 'hidden';
            $('#cp_show').get(0).type = 'hidden';
            $('#sp1').html("");
            $('#sp2').html("");
            $('#mailError').html("Password Changed Successfully");
        }

        $('#new_password').keyup(function() {

            var n_pass = $("#new_password").val();
            var e_regex = new RegExp("[\'^£$%&*()}{@#~?><>,|=_+¬-]");
            if (n_pass == "") {
                $('#npError').html("Password Field Cannot be Empty");
            } else {
                if (/[a-z]+/.test(n_pass) == false) {
                    $('#npError').html("Your Password should contain at least one small letter");
                } else if (e_regex.test(n_pass) == false) {
                    $('#npError').html("Your Password should contain at least one special character");
                } else if (/[0-9]+/.test(n_pass) == false) {
                    $('#npError').html("Your Password should contain at least one number");
                } else if (n_pass.length < 8) {
                    $('#npError').html("Your Password should contain at least 8 characters");
                } else {
                    $('#npError').html("");
                }
            }
        });

        $('#conf_pass').keyup(function() {

            var n_pass = $("#new_password").val();
            var c_pass = $("#conf_pass").val();
            if (c_pass == "") {
                $('#cpError').html("Confirm Password Cannot be Empty");
            } else {
                if (c_pass != n_pass) {
                    $('#cpError').html("Passwords Does Not Match");
                } else {
                    $('#cpError').html("");
                }
            }
        });

        $('#p_show').click(function() {

            var p_input = $("#new_password");

            if (p_input.attr('type') == "password") {
                p_input.attr('type', 'text');
            } else {
                p_input.attr('type', 'password');
            }

        });

        $('#cp_show').click(function() {

            var p_input = $("#conf_pass");

            if (p_input.attr('type') == "password") {
                p_input.attr('type', 'text');
            } else {
                p_input.attr('type', 'password');
            }

        });
    </script>
</body>

</html>