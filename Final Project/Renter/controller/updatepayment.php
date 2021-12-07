<?php
require_once '../model/Model.php';
class editpayment{
    
    public $message="";

    function editpay($data){
        

                          if(updatepay($data)){
                            header("Location:../view/renthistory.php");
                        }
                        else{
                            $this->message="Unable to edit rent payment history!";
                        }
                    }
        
            
        function get_error(){
        return $this -> error;
    }

    function get_message(){
        return $this -> message;
    }
}
?>