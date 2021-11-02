<?php
include 'db_connect.php';
error_reporting(0);
session_start();
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
        $_SESSION["NID"] = $data["NID"];
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
        $_SESSION['FullName'] = $row['Name'];
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['Image'] = $row['Image'];
        $_SESSION['Gender'] = $row['Gender'];
        $_SESSION['Password'] = $row['Password'];
        $_SESSION['NID'] = $row['NID'];
        return true;
    } else {
        return false;
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
    $_SESSION["FullName"] = $data["Name"];
    $_SESSION["Email"] = $data["Email"];
    $_SESSION["Gender"] = $data["Gender"];
    $_SESSION["Password"] = $data["Password"];
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
    try {
        $stmt = $conn->prepare("INSERT INTO notices (Owner_ID,R_ID, N_ID, Notice, AD_Area, AD_des, Picture1, Picture2, Picture3,Displayable)
            VALUES (:AD_ID, :H_Owner_ID, :AD_Rent, :AD_Address, :AD_Area, :AD_des, :Picture1, :Picture2, :Picture3, :Displayable)");
        $stmt->bindParam(':AD_ID', $ad_id);
        $stmt->bindParam(':H_Owner_ID', $howner_id);
        $stmt->bindParam(':AD_Rent', $ad_rent);
        $stmt->bindParam(':AD_Address', $ad_address);
        $stmt->bindParam(':AD_Area', $ad_area);
        $stmt->bindParam(':AD_des', $ad_des);
        $stmt->bindParam(':Picture1', $p1);
        $stmt->bindParam(':Picture2', $p2);
        $stmt->bindParam(':Picture3', $p3);
        $stmt->bindParam(':Displayable', $data["Displayable"]);
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

function fetchNotices($data)
{

    $current = file_get_contents("../json/notices.json");
    $current = json_decode($current, true);
    return $current;
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
        $stmt = $conn->prepare("INSERT INTO unapprovedads (AD_ID,H_Owner_ID, AD_Rent, AD_Address, AD_Area, AD_des, Picture1, Picture2, Picture3,Displayable)
        VALUES (:AD_ID, :H_Owner_ID, :AD_Rent, :AD_Address, :AD_Area, :AD_des, :Picture1, :Picture2, :Picture3, :Displayable)");
        $stmt->bindParam(':AD_ID', $ad_id);
        $stmt->bindParam(':H_Owner_ID', $howner_id);
        $stmt->bindParam(':AD_Rent', $ad_rent);
        $stmt->bindParam(':AD_Address', $ad_address);
        $stmt->bindParam(':AD_Area', $ad_area);
        $stmt->bindParam(':AD_des', $ad_des);
        $stmt->bindParam(':Picture1', $p1);
        $stmt->bindParam(':Picture2', $p2);
        $stmt->bindParam(':Picture3', $p3);
        $stmt->bindParam(':Displayable', $data["Displayable"]);
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
    $selectQuery = "SELECT * FROM `unapprovedads` WHERE H_Owner_ID LIKE '%$id%' AND Displayable LIKE '%Yes%'";
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

    $_SESSION["AD_Rent"] = $row["AD_Rent"];
    $_SESSION["AD_Area"] = $row["AD_Area"];
    $_SESSION["AD_Address"] = $row["AD_Address"];
    $_SESSION["AD_Description"] = $row["AD_des"];
    $_SESSION["Picture1"] = $row["Picture1"];
    $_SESSION["Picture2"] = $row["Picture2"];
    $_SESSION["Picture3"] = $row["Picture3"];

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
?>