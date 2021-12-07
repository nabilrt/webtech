<?php
include 'db_connect.php';


function addrenters($data)
{
    $conn = db_conn();
    $selectQuery = "INSERT into renters (name, email, nid, password,gender,dob,Image)
VALUES (:name, :email,:nid, :password,:gender,:dob,:Image)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':name' => $data["name"],
            ':email' => $data["email"],
            ':nid' => $data["nid"],
            ':password' => $data["pass"],
            ':gender' => $data["gender"],
            ':dob' => $data["dob"],
            ':Image' => "../images/bg3.jpg"
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }

    $conn = null;
    return true;
}

function dupEmail($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `renters` where `Email`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$data["email"]]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}



function dupNID($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `renters` where `NID`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$data["nid"]]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}

function dupMNID($nid)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `manager` where `NID`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$nid]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}

function dupMEmail($em)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `manager` where `Email`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$em]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}




function checkLogin($data)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `renters` where nid = ? AND password= BINARY ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$data["NID"], $data["Password"]]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;


    if (!empty($row)) {

        return true;
    } else {
        return false;
    }
}

function getUserInfo($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `renters` where nid = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$data["NID"]]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    if (!empty($row)) {


        return $row;
    }
}



function updateImage($data)
{

    $dp_updated = false;
    $conn = db_conn();
    $selectQuery = "UPDATE renters set Image = ? where nid = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['FilePath'], $_SESSION['NID']

        ]);

        $dp_updated = true;
    } catch (PDOException $e) {
        echo "change profile picture  " . $e->getMessage();
    }
    $conn = null;
    if ($dp_updated) {
        return true;
    } else {
        return false;
    }
}
function editUserInfo($data)
{
    $isUpdated = false;
    $conn = db_conn();
    $selectQuery = "UPDATE renters set name = ?, email = ?,password=?,gender=? where NID = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['name'], $data['email'], $data['pass'], $data['gender'], $data["NID"]
        ]);

        $isUpdated = true;
    } catch (PDOException $e) {
        echo "Update " . $e->getMessage();
    }
    $conn = null;




    if ($isUpdated) {
        return true;
    } else {
        return false;
    }
}
function delete_info($id)
{
    $conn = db_conn();
    $selectQuery = "DELETE FROM `renters` WHERE `nid` = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo "Deleted " . $e->getMessage();
    }
    $conn = null;
}

function fetch_by_rent($rent)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE AD_Rent <= $rent AND decision LIKE '%Accepted%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function get_rented_house($id)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `basha_vara` WHERE Renter_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function delete_ren($id,$o_id)
{

    $conn = db_conn();
    $selectQuery = "DELETE FROM `basha_vara` WHERE AD_No = ?";
    $selectQuery1="INSERT into notification (ID, Notify, Time) VALUES (:ID, :Notify, :Time)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
        $stmt1=$conn->prepare($selectQuery1);
        $stmt1->execute([
            ':ID'=> $o_id,
            ':Notify'=>"Renter has left the house of AD-ID ".$id,
            ':Time'=>strval(date("h:i:sa"))
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;

    return true;
}



function fetch_by_area_rent($rent, $area)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE AD_Rent <= $rent AND AD_Area LIKE '%$area%' AND decision LIKE '%Accepted%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function fetch_messages($id)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `chats` WHERE Renter_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function give_rent($data)
{
    $conn = db_conn();
    $selectQuery = "INSERT into payments (AD_No,Owner_ID,Renter_ID,Rent,Paid,Month)
VALUES (:AD_No,:Owner_ID,:Renter_ID,:Rent,:Paid,:Month)";
    $selectQuery1="INSERT into notification (ID, Notify, Time) VALUES (:ID, :Notify, :Time)";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':AD_No' => $data["Adno"],
            ':Owner_ID' => $data["Owner_ID"],
            ':Renter_ID' => $data["Renter_ID"],
            ':Rent' => $data["ramount"],
            ':Paid' => $data["paid"],
            ':Month' => $data["rmonth"]
        ]);
        $stmt1=$conn->prepare($selectQuery1);
        $stmt1->execute([
            ':ID'=> $data["Owner_ID"],
            ':Notify'=>"Rent for month ".$data["rmonth"]." has been paid for AD-ID ". $data["Adno"].".",
            ':Time'=>strval(date("h:i:sa"))
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }

    $conn = null;
    return true;
}

function get_pay_details($id)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `basha_vara` WHERE Renter_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function get_basha_details($a_id)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `basha_vara` where AD_No = ?";
    $rid = "";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$a_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function fetch_Ads($id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE AD_Area LIKE '%$id%' AND decision LIKE '%Accepted%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function fetch_accepted_ads($id)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE H_Owner_ID LIKE '%$id%' AND decision LIKE '%Accepted%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function fetchAd($ad_id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` where AD_ID = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$ad_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function checkDupEmail($em)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `renters` where `Email`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$em]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}

function checkDupHEmail($em)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `owners` where `Email`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$em]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}

function dupRNID($nid)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `renters` where `NID`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$nid]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}

function dupHNID($nid)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `owners` where `NID`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$nid]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}

function fetchNotices($data)
{
    $id = $data['NID'];
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `notices` WHERE R_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function get_all_the_ads()
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE decision LIKE '%Accepted%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


function managerent($id)
{


    $conn = db_conn();
    $selectQuery = "SELECT * FROM `payments` WHERE Renter_ID LIKE '%$id%' ";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function fetchpayment($id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `payment` where RNo = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);



    return $row;
}
function deletepayment($id)
{
    $conn = db_conn();
    $selectQuery = "DELETE FROM `payment` WHERE `RNo` = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;

    return true;
}

function search_payment($id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `payment` WHERE PaymentSystem LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function fetch_chat_details($id)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `chats` where Message_No = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}


function send_message($data)
{
    $conn = db_conn();
    $selectQuery = "INSERT into chats (Message_No,Owner_ID,Renter_ID,RMessage,HMessage,AD_No) 
    VALUES (:Message_No,:Owner_ID,:Renter_ID,:RMessage,:HMessage,:AD_No)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Message_No' => $data["Message_No"],
            ':Owner_ID' => $data["Owner_ID"],
            ':Renter_ID' => $data["Renter_ID"],
            ':RMessage' => $data["RMessage"],
            ':HMessage' => $data["HMessage"],
            ':AD_No' => $data["AD_No"]
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }

    $conn = null;
    return true;
}

function house_count($id)
{
    $conn = db_conn();
    $sql = "SELECT COUNT(*) FROM basha_vara where Renter_ID like '%$id%'";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();

    return $count;
}

function request_count($id){

    $conn = db_conn();
    $sql = "SELECT COUNT(*) FROM chats where Renter_ID like '%$id%'";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();

    return $count;


}

function send_new_message($data)
{

    $conn = db_conn();
    $selectQuery = "INSERT into chats (Message_No,Owner_ID,Renter_ID,RMessage,HMessage,AD_No) 
    VALUES (:Message_No,:Owner_ID,:Renter_ID,:RMessage,:HMessage,:AD_No)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Message_No' => $data["Message_No"],
            ':Owner_ID' => $data["Owner_ID"],
            ':Renter_ID' => $data["Renter_ID"],
            ':RMessage' => $data["RMessage"],
            ':HMessage' => $data["HMessage"],
            ':AD_No' => $data["AD_No"]
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }

    $conn = null;
    return true;
}

function get_det($id)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` where AD_ID = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function get_rows()
{

    $conn = db_conn();
    $sql = "SELECT COUNT(*) FROM chats";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();

    return $count;
}

function delete_messages($id)
{

    $conn = db_conn();
    $selectQuery = "DELETE FROM `chats` WHERE `Message_No` = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;

    return true;
}


function updatepay($data)
{

    $conn = db_conn();
    $selectQuery = "UPDATE payment set  RAmount='" . $data['RAmount'] . "', RMonth='" . $data['RMonth'] . "'  WHERE RNo='" . $data['RNo'] . "'";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;
    echo "Done";
    return true;
}

function fetch_notification($id){

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `notification` WHERE ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
