<?php
include 'db_connect.php';
error_reporting(0);
session_start();
function addHouseOwners($data){
    if (file_exists("../json/owners.json")) {
        $current_content = file_get_contents("../json/owners.json");
        $array_content = json_decode($current_content, true);
        $new_content = array(
            'Name' => $data["Name"],
            'Email' => $data["Email"],
            'NID' => $data["NID"],
            'Password' => $data["Password"],
            'Gender' => $data["Gender"],
            'Image' => "../files/normal.png"
        );
        $array_content[] = $new_content;
        $final_content = json_encode($array_content, JSON_UNESCAPED_SLASHES);
        if (file_put_contents("../json/owners.json", $final_content)) {
            return true;
        }
    } else {
           return false;
    }
}

function checkLogin($data){
    $isFound=false;
    $data_s = file_get_contents("../json/owners.json");  
    $data_s = json_decode($data_s, true); 
        foreach($data_s as $row){
            if($row["NID"]==$data["NID"] && $row["Password"]==$data["Password"]){
            $isFound=true;
            break;
            }
        }

        if($isFound){
           $_SESSION["NID"]=$data["NID"]; 
           return true;
       }else{
            return false;
       }
}

function checkEmail($data){
    $isFound=false;
    $data_s = file_get_contents("../json/owners.json");  
    $data_s = json_decode($data_s, true); 
        foreach($data_s as $row){
            if($row["Email"]==$data["Email"]){
            $isFound=true;
            break;
            }
        }
        if($isFound){
           return true;
       }else{
            return false;
       }
}

function checkNID($data){
    $isFound=false;
    $data_s = file_get_contents("../json/owners.json");  
    $data_s = json_decode($data_s, true); 
        foreach($data_s as $row){
            if($row["NID"]==$data["NID"]){
            $isFound=true;
            break;
            }
        }
        if($isFound){
           return true;
       }else{
            return false;
       }
}


    function getUserInfo($data){
        $isset=false;
        $current = file_get_contents("../json/owners.json");  
        $current = json_decode($current, true); 
        foreach($current as $value){
            if($value['NID']==$data["NID"])
            {
            $_SESSION['FullName']=$value['Name'];
            $_SESSION['Email']=$value['Email'];
            $_SESSION['Image']=$value['Image']; 
            $_SESSION['Gender']=$value['Gender'];
            $_SESSION['Password']=$value['Password'];
            $isset=true;
            break;
            }
        }
        if($isset){
             return true;
        }else{
             return false;
        }
    }

    function editUserInfo($data){
        $isUpdated=false;
        $data_up = file_get_contents("../json/owners.json");
         $data_up = json_decode($data_up, true);
        if (!empty($data_up))
         {
            foreach ($data_up as $key => $row)
             {

             if ($row["NID"] == $_SESSION["NID"]) 

             {
                $data_up[$key]['Name'] = $data["Name"];
                $data_up[$key]['Email'] = $data["Email"];
                $data_up[$key]['Gender'] =$data["Gender"];
                $data_up[$key]['Password'] = $data["Password"];
                file_put_contents('../json/owners.json', json_encode($data_up));
                $_SESSION["FullName"] = $data["Name"];
                $_SESSION["Email"] = $data["Email"];
                $_SESSION["Gender"] = $data["Gender"];
                $_SESSION["Password"] =$data["Password"];
                $isUpdated=true;
                break;
             }
    }
    if($isUpdated){
        return true;
    }
    else{
        return false;
    }
    }
    }

    function updateImage($data){
        $dp_updated=false;
        $data_u = file_get_contents("../json/owners.json");

        $data_u = json_decode($data_u, true);

        if (!empty($data_u)) {

            foreach ($data_u as $key => $row) {

                if ($row["NID"] == $_SESSION['NID']) {

                    $data_u[$key]['Image'] = $data['FilePath'];

                    $_SESSION['Image'] = $data['FilePath'];

                    break;

                }

            }

            file_put_contents('../json/owners.json', json_encode($data_u));
            $dp_updated=true;

            if($dp_updated){
                return true;
            }
            else{
                return false;
            }
    } 
    
    }

    function post_n($data){
        $conn = db_conn();
        try{
            $stmt = $conn->prepare("INSERT INTO notices (Owner_ID,R_ID, N_ID, Notice, AD_Area, AD_des, Picture1, Picture2, Picture3,Displayable)
            VALUES (:AD_ID, :H_Owner_ID, :AD_Rent, :AD_Address, :AD_Area, :AD_des, :Picture1, :Picture2, :Picture3, :Displayable)");
            $stmt->bindParam(':AD_ID',$ad_id);
            $stmt->bindParam(':H_Owner_ID', $howner_id);
            $stmt->bindParam(':AD_Rent', $ad_rent);
            $stmt->bindParam(':AD_Address', $ad_address);
            $stmt->bindParam(':AD_Area', $ad_area);
            $stmt->bindParam(':AD_des', $ad_des);
            $stmt->bindParam(':Picture1', $p1);
            $stmt->bindParam(':Picture2', $p2);
            $stmt->bindParam(':Picture3', $p3);
            $stmt->bindParam(':Displayable',$data["Displayable"]);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            $conn = null;
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
    }

    function fetchNotices($data){

        $current = file_get_contents("../json/notices.json");  
        $current = json_decode($current, true); 
        return $current;
    }

    function postAdForApprove($data){
        $ad_id=$data["AD_ID"];
        $howner_id=$data["House_Owner"];
        $ad_rent=$data["AD_Rent"];
        $ad_address=$data["AD_Address"];
        $ad_area=$data["AD_Area"];
        $ad_des=$data["AD_Description"];
        $p1=$data["FilePath"];
        $p2=$data["FilePath1"];
        $p3=$data["FilePath2"];
        $p3=$data["FilePath2"];
        $conn = db_conn();
        try{
        $stmt = $conn->prepare("INSERT INTO unapprovedads (AD_ID,H_Owner_ID, AD_Rent, AD_Address, AD_Area, AD_des, Picture1, Picture2, Picture3,Displayable)
        VALUES (:AD_ID, :H_Owner_ID, :AD_Rent, :AD_Address, :AD_Area, :AD_des, :Picture1, :Picture2, :Picture3, :Displayable)");
        $stmt->bindParam(':AD_ID',$ad_id);
        $stmt->bindParam(':H_Owner_ID', $howner_id);
        $stmt->bindParam(':AD_Rent', $ad_rent);
        $stmt->bindParam(':AD_Address', $ad_address);
        $stmt->bindParam(':AD_Area', $ad_area);
        $stmt->bindParam(':AD_des', $ad_des);
        $stmt->bindParam(':Picture1', $p1);
        $stmt->bindParam(':Picture2', $p2);
        $stmt->bindParam(':Picture3', $p3);
        $stmt->bindParam(':Displayable',$data["Displayable"]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $conn = null;
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function fetchAds($data){
        $id=$_SESSION["NID"];
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `unapprovedads` WHERE H_Owner_ID LIKE '%$id%' AND Displayable LIKE '%Yes%'";
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function fetchAd($ad_id){
        $conn = db_conn();
	$selectQuery = "SELECT * FROM `unapprovedads` where AD_ID = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$ad_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["AD_Rent"]=$row["AD_Rent"];
    $_SESSION["AD_Area"]=$row["AD_Area"];
    $_SESSION["AD_Address"]=$row["AD_Address"];
    $_SESSION["AD_Description"]=$row["AD_des"];
    $_SESSION["Picture1"]=$row["Picture1"];
    $_SESSION["Picture2"]=$row["Picture2"];
    $_SESSION["Picture3"]=$row["Picture3"];

    return $row;
    }

    function deleteAd($id){
        $conn = db_conn();
        $selectQuery = "DELETE FROM `unapprovedads` WHERE `AD_ID` = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $conn = null;
    
        return true;
    }

    function updateAd($id,$data){
       
    }

    function updateAnAd($data){
        
        $conn = db_conn();
        $selectQuery = "UPDATE unapprovedads set H_Owner_ID='".$data['House_Owner']."', AD_Rent='".$data['AD_rent']."', AD_Address='".$data['AD_address']."', AD_Area='".$data['AD_area']."', AD_des='".$data['AD_description']."', Picture1='".$data['FilePath']."', Picture2='".$data['FilePath1']."', Picture3='".$data['FilePath2']."'  WHERE AD_ID='".$data['AD_iD']."'";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $conn = null;
        echo "Done";
        return true;
    }

    function searchUser($id){
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `unapprovedads` WHERE AD_Area LIKE '%$id%'";
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
?>