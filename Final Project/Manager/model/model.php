<?php
include 'db_connect.php';
function addAccountants($data){
    $conn = db_conn();
    $selectQuery = "INSERT into manager (Name, Email, NID, Gender, Password, Degree, Image)
VALUES (:Name, :Email,:NID, :Gender, :Password, :Degree, :Image)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Name' => $data["Name"],
            ':Email' => $data["Email"],
            ':NID' => $data["NID"],
            ':Gender' => $data["Gender"],
            ':Password' => $data["Password"],
            ':Degree'=>$data['FilePath'],
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

function checkLogin($data){
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

    function getUserInfo($data){
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `manager` where NID = ?";
    
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

function payment_history(){

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `payments`";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function updateImage($data)
{
    $conn = db_conn();
    $selectQuery = "UPDATE manager set Image = ? where NID = ?";
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
    $selectQuery = "UPDATE manager set Name = ?, Email = ?, Password = ?, Gender = ? where NID = ?";
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

function num_of_transactions(){

    $conn = db_conn();
    $sql = "SELECT COUNT(*) FROM payments";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();

    return $count;
}

function amount_spent(){

    $conn = db_conn();
    $selectQuery = "SELECT SUM(Amount) AS amount_sum FROM expenses";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $a_spent=$row['amount_sum'];

    return $a_spent;
}

function transaction_count(){

    $conn = db_conn();
    $sql = "SELECT COUNT(*) FROM expenses";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();

    return $count;


}

function addExpense($data){

    $conn = db_conn();
    $selectQuery = "INSERT into expenses (Transaction, Reason, Description, Amount)
VALUES (:Transaction, :Reason ,:Description, :Amount)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Transaction' => $data["Transaction_ID"],
            ':Reason' => $data["Sector"],
            ':Description' => $data["Description"],
            ':Amount' => $data["Amount"]
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conn = null;
        return false;
    }
    $conn = null;
    return true;

}

function all_expenses(){

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `expenses`";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;

}

function ret_exp($id){

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `expenses` where Transaction = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function delete_expense($id){

    $conn = db_conn();
    $selectQuery = "DELETE FROM `expenses` WHERE `Transaction` = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;

    return true;
}

function update_expense($data){

    $isUpdated = false;
    $conn = db_conn();
    $selectQuery = "UPDATE expenses set Reason = ?, Amount = ?, Description = ? where Transaction = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data["Sector"], $data["Amount"], $data["Description"], $data["Transaction_ID"]
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

function fetch_transactions($t_id){

    $conn = db_conn();
    $selectQuery = "SELECT * FROM `expenses` WHERE Reason LIKE '%$t_id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
