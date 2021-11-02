<?php
session_start();

if(isset($_SESSION["NID"])){
    session_destroy();
    header("location:../view/howner_login.php");
}
else if(!isset($_SESSION["NID"])){
    header("location:../view/howner_login.php");
}

?>