<?php



include_once '../model/model.php';

$a_id=$_GET['id'];

if(check_duplicate_AD_ID($a_id)==true){
    

    echo "false";
    
}else{

    echo "true";

    
}

?>