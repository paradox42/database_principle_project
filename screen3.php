<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->
<html>

<head>
    <title> Search Result - 3-B.com </title>
    <script>
    window.onload = function() {
        updateTotal();
    };

    function updateTotal() {
        var storage = window.localStorage;
        var total = 0;
        for (var i = 0; i < storage.length; i++) {
            var item = storage.getItem(storage.key(i));
            total += parseInt(item);
        }
        document.querySelector("#totalItem").innerHTML = total;
    }
    //redirect to reviews page
    function review(isbn, review) {
        window.location.href = `screen4.php?isbn=${isbn}`;
    }
    //add to cart
    function cart(isbn) {
        var storage = window.localStorage;
        var qty = parseInt(storage.getItem(isbn));
        qty = qty ? qty : 0;
        storage.setItem(isbn, qty += 1);
        updateTotal();
    }
    </script>
</head>

<body>
    <table align="center" style="border:1px solid blue;">
        <tr>
            <td align="left">

                <h6>
                    <fieldset>Your Shopping Cart has <span id="totalItem"></span> items</fieldset>
                </h6>

            </td>
            <td>
                &nbsp
            </td>
            <td align="right">
                <form action="shopping_cart.php" method="post">
                    <input type="submit" value="Manage Shopping Cart">
                </form>
            </td>
        </tr>
        <tr>
            <td style="width: 350px" colspan="3" align="center">
                <div id="bookdetails"
                    style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">
                    <table>
                        <?php
                            function constructSearchOn($searchOn, $searchFor) {
                                if(!$searchOn || $searchOn[0] == "anywhere") {
                                    return " WHERE (name LIKE '%$searchFor%' OR author LIKE '%$searchFor%' 
                                            OR publisher LIKE '%$searchFor%' OR ISBN LIKE '%$searchFor%')";
                                }
                                $res = "";
                                $last = end($searchOn);
                                foreach($searchOn as $index => $search) {
                                    if($searchFor){               
                                        if($search != "anywhere") {
                                            if($search === "title"){
                                                $res .= "name LIKE '%$searchFor%'";
                                            }
                                            else{
                                                $res .= " $search LIKE '%$searchFor%'";
                                            }
                                            if($search != $last) {
                                                $res .= " OR";
                                            }
                                        }
                                    }
                                }
                                return " WHERE (".$res.")";
                            }

                            function constructNewTr($row) {
                                //add to cart button,
                                $name = $row["name"];
                                $author = $row['author'];
                                $publisher = $row['publisher'];
                                $isbn = $row['ISBN'];
                                $category = $row['categories'];
                                $price = $row['price'];
                                return
                                "
                                    <div>
                                        Book Name: $name <br/>
                                        Author: $author <br/>
                                        Publisher: $publisher,
                                        ISBN: $isbn <br/>
                                        Category: $category,
                                        Price: $price
                                    </div>
                                    <button onClick='review($isbn)'>Review</button>
                                    <t/>
                                    <button onClick='cart($isbn)'>Add to cart</button>
                                    <br/><br/>
                                ";
                            }
                        ?>
                        <?php
                        //pad percentage sign on both sides of keywords search
                            include "database_connection.php";
                            $searchFor = $_GET['searchfor'];
                            $searchOn = $_GET['searchon'];
                            $category = $_GET['category'];
                            $categoryMap = array(
                                1 => "Fantasy",
                                2 => "Adventure",
                                3 => "Fiction",
                                4 => "Horror"
                            );

                            $query = "SELECT * FROM book";

                            if(!$searchFor){
                                if($category != "all") {
                                    $query .= " WHERE categories = '{$categoryMap[$category]}'";
                                }
                                else $query .= ";";
                            } else {
                                $query .= constructSearchOn($searchOn, $searchFor);
                                if($category != "all") {
                                    $query .= " AND categories = '{$categoryMap[$category]}'";
                                } else {
                                    $query .= ";";
                                }
                            }
                            // echo "$query<br/>";
                            $result = $conn->query($query);
                            // echo $query;
                            if(!$result){
                                $errorMsg = $conn->lastErrorMsg();
                                echo "error: $errorMsg";
                            }else{
                                while($row = $result->fetchArray()){
                                    $newTr = constructNewTr($row);
                                    echo $newTr;
                                }
                            }

                        ?>
                </div>

            </td>
        </tr>
        <tr>
            <br />
            <td align="center">
                <form action="confirm_order.php" method="get">
                    <input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
                </form>
            </td>
            <td align="center">
                <form action="screen2.php" method="post">
                    <input type="submit" value="New Search">
                </form>
            </td>
            <td align="center">
                <form action="index.php" method="post">
                    <input type="submit" name="exit" value="EXIT 3-B.com">
                </form>
            </td>
        </tr>
    </table>
</body>

</html>