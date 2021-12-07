<?php 


    function delete_account($id){
        require_once "../model/Model.php";
       
     delete_info($id);
     return true;
    }

 ?>