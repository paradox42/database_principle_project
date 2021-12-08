<?php
    include "database_connection.php";
    $data = array();
    $data['categoryGroup'] = array();
    $data['bookReviews'] = array();
    $data['purchase'] = array();
    

    $sql = "select count(*) from customer";
    $result = $conn->querySingle($sql);
    if($result){
        $data['total'] = $result;
    }


    $sql = "select count(*) as count, categories from book group by categories order by count(*) DESC;";
    $result = $conn->query($sql);
    while ($row = $result->fetchArray()) {
        array_push($data['categoryGroup'],$row);
    }

    $sql = "select * from purchase";
    $result = $conn->query($sql);
    while ($row = $result->fetchArray()) {
        array_push($data['purchase'],$row);
    }

    $sql = "select book.name, count(reviewId) as count 
            from book join review 
            on book.isbn=review.isbn group by book.name";
    $result = $conn->query($sql);
    while ($row = $result->fetchArray()) {
        array_push($data['bookReviews'],$row);
    }
    echo json_encode($data);
?>