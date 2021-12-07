<?php

include_once '../model/Model.php';

$m_id=$_GET["id"];

if(delete_messages($m_id)){

    header("Location:../view/chat.php");
}

?>