<?php
    include "database_connection.php";
    $data = json_decode($_POST["data"]);
    $books = $data->books;
    $username = $data->username;
    $timestamp = $data->timeStamp;
    foreach($books as $isbn => $qty) {
        $sql = "INSERT INTO purchase (ISBN, username, timestamp, qty)
                VALUES('$isbn','$username','$timestamp','$qty')";
        $result = $conn->exec($sql);
        if(!$result){
            $errorMsg = $conn->lastErrorMsg();
            echo "error: $errorMsg";
        }else{
            echo("Purchase success");
        }
    }
?>