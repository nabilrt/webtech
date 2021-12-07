<?php

session_start();

if(isset($_SESSION["NID"])){
    session_destroy();
    header("location:../../Login Module/view/login.php");
}
else {
    header("location:../../Login Module/view/login.php");
}


?>