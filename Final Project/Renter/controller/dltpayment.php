<?php
require_once '../model/Model.php';

if(deletepayment($_GET['id'])){
    header("Location:../view/renthistory.php");
}

?>