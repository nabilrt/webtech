<?php
require_once '../model/model.php';

if (deleteAd($_GET['id'])) {
    header("Location:../view/manage_ads.php");
}
?>