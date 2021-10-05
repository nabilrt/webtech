<!DOCTYPE html>
<html>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login_styles.css">
    <body>
        <div class="center">
            <h1>Log into the system</h1>
            <form method="POST" action="dashboard.php" enctype="multipart/form-data">
            <div class="text-field">
            <label>Username</label>
                <input type="text" id="username" name="username" >
            </div>
            <div class="text-field">
                <label>Password</label>
            <input type="text" id="password" name="password">
            </div>
            <div>
                <input type="checkbox" id="remember" name="remember"> Remember Password
            </div><br><br>
            <a href="forgot_password.php" style="text-decoration: none;"><div class="pass">Forgot Password?</div></a>
            <input type="submit" name="login" value="Login">
            <div class="sign-up">Not a Member Yet? <a href="registration_form.php">Sign Up</a></div>
      </form>
      </div>
    </body>
</html>