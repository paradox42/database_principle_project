<!-- screen 4: Book Reviews by Prithviraj Narahari, php coding: Alexander Martens-->
<!DOCTYPE html>
<html>

<head>
    <title>Book Reviews - 3-B.com</title>
    <style>
    .field_set {
        border-style: inset;
        border-width: 4px;
    }
    </style>
</head>

<?php
    include "database_connection.php";
    $isbn = $_GET['isbn'];
    $query = "select * from book join review where book.isbn = review.isbn AND book.isbn = '$isbn'";
    $result = $conn->query($query);
    if(!$result){
        $errorMsg = $conn->lastErrorMsg();
        echo "error: $errorMsg";
    }
    $name;
    $author;
    $reviews = array();
    while ($row = $result->fetchArray()) {
        $name = $row['name'];
        $author = $row['author'];
        array_push($reviews, $row['content']);
    }
?>

<body>
    <table align="center" style="border:1px solid blue;">
        <tr>
            <td align="center">
                <h5> Reviews For: <?php echo $name ?></h5>
            </td>
            <td align="left">
                <h5><?php echo $author ?></h5>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
                    <table>
                        <?php
                            foreach($reviews as $review) {
                                echo "<tr><td>$review</td></td>";
                            }
                        ?>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <form action="screen2.php" method="post">
                    <input type="submit" value="Done">
                </form>
            </td>
        </tr>
    </table>

</body>

</html>