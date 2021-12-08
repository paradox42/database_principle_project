<?php
    include "database_connection.php";
    $data = json_decode($_POST['data'], JSON_UNESCAPED_SLASHES);
    $username = $data['username'];
    $pin = $data['new_pin'];
    $fname = $data['firstname'];
    $lname = $data['lastname'];
    $address = $data['address'];
    $city = $data['city'];
    $zip = $data['zip'];
    $carType = $data['credit_card'];
    $cardNumber = $data['card_number'];
    $cardExpDate = $data['expiration_date'];

    $sql = "
        UPDATE customer
        SET pin = '$pin',
            fname = '$fname',
            lname = '$lname',
            address = '$address',
            city = '$city',
            zip = '$zip',
            carType = '$carType',
            cardNumber = $cardNumber,
            cardExpDate = '$cardExpDate'
        WHERE username = '$username'
    ";
    $conn->exec($sql);
    if($sql) {
        echo $conn->changes();
    } 
?>