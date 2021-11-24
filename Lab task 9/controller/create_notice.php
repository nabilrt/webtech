<?php
require_once '../model/model.php';

class giveNotice
{

    public $error = array(
        'NoticeIDErr' => "",
        'RenterIDErr' => "",
        'MessageErr' => ""
    );

    public $message = "";

    function g_notice($data)
    {

        if (empty($data["Renter_ID"])) {
            $this->error["RenterIDErr"] = "Renter ID Cannot Be Empty";
        }

        if (empty($data["Message"])) {
            $this->error["MessageErr"] = "Message Cannot Be Empty";
        }

        if (empty($this->error["RenterIDErr"]) && empty($this->error["MessageErr"])) {
            if (post_n($data)) {
                $this->message = "Notice Posted Successfully";
            } else {
                $this->message = "Unable to Post Notice";
            }
        }
    }

    function get_message()
    {
        return $this->message;
    }

    function get_error()
    {
        return $this->error;
    }
}
?>
