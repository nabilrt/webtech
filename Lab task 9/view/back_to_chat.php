<?php
session_start();

if(isset($_SESSION['ID'])){
    unset($_SESSION['ID']);
}
if(isset($_SESSION['RID'])){ 
    unset($_SESSION['RID']);
    header('Location:chatting.php');
}else{
    header('Location:chatting.php');
}

?>