<?php
    include "database_connection.php";
    $username = $_POST["username"];
    // $query = "SELECT * from customer join purchase on customer.username = purchase.username where customer.username='$username'";
    $query = "SELECT * FROM purchase join book ON purchase.ISBN=book.isbn WHERE username='$username'";
    $results = $conn->query($query);
    $response = new stdClass();
    $itemNum = 0;
    while ($row = $results->fetchArray()) {
        $response->$itemNum = $row;
        $itemNum ++;
        // echo var_dump($row);
    }
    echo json_encode($response);
?>