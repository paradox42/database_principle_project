<?php
    include "database_connection.php";
    $data = json_decode($_POST['data']);
    $response = new stdClass();
    foreach ($data as $key => $value) {
        $query = "select * from book where isbn='$key'";
        $result = $conn->query($query);
        $row = $result->fetchArray();
        $response->$key = $row;
    }
    echo json_encode($response);
?>