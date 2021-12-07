<?php

include_once '../model/model.php';

$t_id=$_GET['key'];

$transactions=fetch_transactions($t_id);

if(empty($transactions)){
    echo "";
}
else{
    echo '<table class="table table-bordered">';
    echo '<tr class="table-dark">';
    echo '<th class="table-dark"></th>';
        echo '<th class="table-dark">Transaction ID</th>';
        echo '<th class="table-dark">Sector</th>';
        echo '<th class="table-dark">Amount</th>';
        echo '<th class="table-dark">Description</th>';
        echo '<th class="table-dark"></th>';
    echo '</tr>';
     if(!empty($transactions)){
        foreach ($transactions as $trans) : 
            echo  '<tr class="table-light">';
            echo  "<td class='table-light'><a href=show_trans.php?id=" . $trans['Transaction']." class='btn btn-outline-info'>Show Details</a></td>";
            echo  '<td class="table-light">' .$trans['Transaction']. '</td>';
            echo  '<td class="table-light">'  .$trans['Reason']. '</td>';
            echo  '<td class="table-light">' .$trans['Amount']. '</td>';
            echo  '<td class="table-light">' .$trans['Description']. '</td>';
            echo  "<td class='table-light'><a href=edit_expense.php?id=" . $trans['Transaction']." class='btn btn-outline-primary'>Edit</a>
            &nbsp;<a href=../controller/delete_exp.php?id=" . $trans['Transaction']." class='btn btn-outline-danger'>Delete</a>
            </td>";
          echo "</tr>";
          endforeach; 
          echo "</table>";
     }else{
         echo "";
     }
}

 

?>

<html>

<head>
    <meta charset="utf-8">
    <title>Search Expenses</title>
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
</head>