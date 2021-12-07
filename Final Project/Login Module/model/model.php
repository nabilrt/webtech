<?php
include 'db_connect.php';
function checkOwnerLogin($data)
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

function checkRenterLogin($data)
{

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `renters` where nid = ? AND password = BINARY ?";

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

function checkManagerLogin($data){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `manager` where `NID` = ? AND `Password`= BINARY ?";
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

function get_users()
{

    $conn = db_conn();
    $sql = "SELECT COUNT(*) FROM owners";
    $sql1 = "SELECT COUNT(*) FROM renters";
    $sql2 = "SELECT COUNT(*) FROM manager";
    $res = $conn->query($sql);
    $res1 = $conn->query($sql1);
    $res2 = $conn->query($sql2);
    $count = $res->fetchColumn();
    $count1 = $res1->fetchColumn();
    $count2 = $res2->fetchColumn();

    return $count + $count1 + $count2;
}

function ad_count()
{


    $conn = db_conn();
    $sql = "SELECT COUNT(*) FROM unapprovedads where decision like '%Accepted%'";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();

    return $count;
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

function dupREmail($em)
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

function updateOPassword($mail, $pass)
{

    $conn = db_conn();
    $selectQuery = "UPDATE owners set Password = ? where Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $pass, $mail
        ]);
        $p_updated = true;
    } catch (PDOException $e) {
    }
    $conn = null;
    if ($p_updated) {
        return true;
    } else {
        return false;
    }
}

function updateRPassword($mail, $pass)
{
    $conn = db_conn();
    $selectQuery = "UPDATE renters set password = ? where email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $pass, $mail
        ]);
        $p_updated = true;
    } catch (PDOException $e) {
    }
    $conn = null;
    if ($p_updated) {
        return true;
    } else {
        return false;
    }
}

function updateMPassword($mail, $pass)
{
    $conn = db_conn();
    $selectQuery = "UPDATE manager set Password = ? where email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $pass, $mail
        ]);
        $p_updated = true;
    } catch (PDOException $e) {
    }
    $conn = null;
    if ($p_updated) {
        return true;
    } else {
        return false;
    }
}
