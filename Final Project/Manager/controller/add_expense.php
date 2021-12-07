<?php
include_once '../model/model.php';

class createExpense{

    public $error=array(
        'sectorErr'=>"",
        'amountErr' =>"",
        'descErr'=>""
    );

    public $message="";

    function addExpense($data){

        if(empty($data['Sector'])){

            $this-> error["sectorErr"] = "Sector is required";

        }

        if(empty($data['Amount'])){

            $this-> error["amountErr"] = "Amount is required";
        }

        if(empty($data['Description'])){

            $this->error['descErr']="Description is required";
        }

        if(empty($error['sectorErr']) && empty($error['amountErr']) &&  empty($error['descErr'])){

            if(addExpense($data)){

                $this->message="Expense Added Successfully";

            }
            else{

                $this->message="Unable to add Expense";


            }
        }



    }

    function get_error(){
        return $this -> error;
    }

    function get_message(){
        return $this -> message;
    }
}
