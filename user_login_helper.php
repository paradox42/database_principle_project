<?php
    include "database_connection.php";
    $data = $_POST;
    $username = $_POST["username"];
    $pin = $_POST["pin"];
    $query = "select * from customer where username='$username'";
    $result = $conn->querySingle($query, true);
    echo json_encode($result);;
?>