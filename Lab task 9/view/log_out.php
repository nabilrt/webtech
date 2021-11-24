<?php

session_start();

if(isset($_SESSION["NID"])){
    session_destroy();
    header("location:howner_login.php");
}
else if(!isset($_SESSION["NID"])){
    header("location:howner_login.php");
}


?>