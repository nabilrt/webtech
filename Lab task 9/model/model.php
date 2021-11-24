<?php
include 'db_connect.php';
function addHouseOwners($data)
{
    $conn = db_conn();
    $selectQuery = "INSERT into owners (Name, Email, NID, Password, Gender, Image)
VALUES (:Name, :Email,:NID, :Password,:Gender,:Image)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Name' => $data["Name"],
            ':Email' => $data["Email"],
            ':NID' => $data["NID"],
            ':Password' => $data["Password"],
            ':Gender' => $data["Gender"],
            ':Image' => "../files/normal.png"
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }
    $conn = null;
    return true;
}

function checkLogin($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `owners` where `NID` = ? AND `Password`= BINARY ?";
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
    } 
}

function checkEmail($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `owners` where `Email`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$data["Email"]]);
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

function checkDupEmail($em)
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

function checkNID($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `owners` where `NID`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$data["NID"]]);
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
    $selectQuery = "SELECT * FROM `owners` where NID = ?";

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

function editUserInfo($data)
{
    $isUpdated = false;
    $conn = db_conn();
    $selectQuery = "UPDATE owners set Name = ?, Email = ?, Password = ?, Gender = ? where NID = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data["Name"], $data["Email"], $data["Password"], $data["Gender"], $_SESSION["NID"]
        ]);
    } catch (PDOException $e) {
        echo "Update " . $e->getMessage();
    }
    $isUpdated = true;
    $conn = null;
    if ($isUpdated) {
        return true;
    } else {
        return false;
    }
}

function updateImage($data)
{
    $img_path = $data["FilePath"];
    $dp_updated = false;
    $conn = db_conn();
    $selectQuery = "UPDATE owners set Image = ? where NID = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['FilePath'], $_SESSION['NID']
        ]);
        $_SESSION['Image'] = $img_path;
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

function post_n($data)
{
    $conn = db_conn();
    $selectQuery = "INSERT into notices (Owner_ID, R_ID, AD_ID, Notice) VALUES (:Owner_ID, :R_ID, :AD_ID, :Notice)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Owner_ID' => $data["HO_ID"],
            ':R_ID' => $data["Renter_ID"],
            ':AD_ID' => $data["AD_ID"],
            ':Notice' => $data["Message"]
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }
    $conn = null;
    return true;
}

function fetchNotices($data)
{
    $id = $data['NID'];
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `notices` WHERE Owner_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function postAdForApprove($data)
{
    $ad_id = $data["AD_ID"];
    $howner_id = $data["House_Owner"];
    $ad_rent = $data["AD_Rent"];
    $ad_address = $data["AD_Address"];
    $ad_area = $data["AD_Area"];
    $ad_des = $data["AD_Description"];
    $p1 = $data["FilePath"];
    $p2 = $data["FilePath1"];
    $p3 = $data["FilePath2"];
    $p3 = $data["FilePath2"];
    $conn = db_conn();
    try {
        $stmt = $conn->prepare("INSERT INTO unapprovedads (AD_ID,H_Owner_ID, AD_Rent, AD_Address, AD_Area, AD_des, Picture1, Picture2, Picture3)
        VALUES (:AD_ID, :H_Owner_ID, :AD_Rent, :AD_Address, :AD_Area, :AD_des, :Picture1, :Picture2, :Picture3)");
        $stmt->bindParam(':AD_ID', $ad_id);
        $stmt->bindParam(':H_Owner_ID', $howner_id);
        $stmt->bindParam(':AD_Rent', $ad_rent);
        $stmt->bindParam(':AD_Address', $ad_address);
        $stmt->bindParam(':AD_Area', $ad_area);
        $stmt->bindParam(':AD_des', $ad_des);
        $stmt->bindParam(':Picture1', $p1);
        $stmt->bindParam(':Picture2', $p2);
        $stmt->bindParam(':Picture3', $p3);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function fetchAds($data)
{
    $id = $_SESSION["NID"];
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE H_Owner_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getIDs($id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `basha_vara` WHERE Owner_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function fetch_Ads($id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE AD_Area LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function ret_Renters($data){

    $id=$data['NID'];
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `basha_vara` WHERE Owner_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function get_basha_details($a_id){

    $conn = db_conn();
    $selectQuery = "SELECT Renter_ID FROM `basha_vara` where AD_No = ?";
    $rid="";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$a_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $rid=$row["Renter_ID"];
    return $rid;

}

function fetchChats($data){

    $id=$data['NID'];

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `chats` WHERE Owner_ID LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function fetch_a_message($msg_id){

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `chats` where Message_No = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$msg_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;


}

function editMessage($data){

    $conn = db_conn();
    $id=$data['Message_No'];
    $selectQuery = "UPDATE chats set Owner_ID = ?, Renter_ID = ?, RMessage = ?, HMessage = ?, AD_No = ? where Message_No = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	$data['Owner_ID'], $data['Renter_ID'], $data['RMessage'], $data['HMessage'], $data['AD_No'], $id
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $conn = null;
    return true;
}

function get_ad_details($ad_id){

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

function add_renter($data){

    $conn = db_conn();
    $selectQuery = "INSERT into basha_vara (Owner_ID, Renter_ID, Rent, Area, AD_No) VALUES (:Owner_ID, :Renter_ID,:Rent, :Area,:AD_No)";
    $selectQuery1= "DELETE FROM `chats` WHERE `AD_No` = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Owner_ID' => $data["Owner_ID"],
            ':Renter_ID' => $data["Renter_ID"],
            ':Rent' => $data["Rent"],
            ':Area' => $data["Area"],
            ':AD_No' => $data["AD_ID"],
        ]);
        $stmt1=$conn->prepare($selectQuery1);
        $stmt1->execute([$data["AD_ID"]]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }
    $conn = null;
    return true;


}

function check_duplicate_AD_ID($ad_id){

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `basha_vara` where AD_No = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$ad_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if(!empty($row)){
        return true;
    }

    return false;
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

function deleteAd($id)
{
    $conn = db_conn();
    $selectQuery = "DELETE FROM `unapprovedads` WHERE `AD_ID` = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;

    return true;
}

function updateAnAd($data)
{

    $conn = db_conn();
    $selectQuery = "UPDATE unapprovedads set H_Owner_ID='" . $data['House_Owner'] . "', AD_Rent='" . $data['AD_rent'] . "', AD_Address='" . $data['AD_address'] . "', AD_Area='" . $data['AD_area'] . "', AD_des='" . $data['AD_description'] . "', Picture1='" . $data['FilePath'] . "', Picture2='" . $data['FilePath1'] . "', Picture3='" . $data['FilePath2'] . "'  WHERE AD_ID='" . $data['AD_iD'] . "'";
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

function searchUser($id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE AD_Area LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
