<?php
session_start();

if(isset($_SESSION["Username"])){
    session_destroy();
    header("location:login_page.php");
}
else{
    header("location:login_page.php");
}

?>