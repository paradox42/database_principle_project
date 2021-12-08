<?php
    include "database_connection.php";
    $username = $_POST['username'];
    $pin = (int)$_POST['pin'];

    $query = "select pin, isAdmin from customer where username='$username'";
    $result = $conn->querySingle($query, true);
    if($result && $result['PIN'] == $pin && $result['isAdmin'] == 1) {
        echo '1';
    }
    else {
        echo $result['isAdmin'];
    }

?> 