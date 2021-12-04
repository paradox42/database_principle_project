<!DOCTYPE HTML>

<head>
    <title>Shopping Cart</title>
    <script>
    //remove from cart
    function del(isbn) {
        window.location.href = "shopping_cart.php?delIsbn=" + isbn;
    }
    </script>
    <script>
    window.onload = function() {
        var params = constructParams();
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            // console.log(JSON.parse(this.responseText));
            handleResponse(JSON.parse(this.responseText));
        }
        xhttp.open("POST", "get_carted_items.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(params);

        var btn = document.getElementById("recalculateBtn");
        btn.addEventListener("click", recalculate);
    };

    function recalculate() {
        var dataRowList = document.querySelectorAll(".dataRow");
        var storage = window.localStorage;
        var subtotal = 0;
        dataRowList.forEach(function(row) {
            var qty = row.querySelector("input").value;
            var isbn = row.querySelector("input").id;
            var price = parseFloat(row.querySelectorAll("td").item(3).innerHTML);
            qty == 0 ? storage.removeItem(isbn) : storage.setItem(isbn, qty);
            var total = price * qty;
            subtotal += total;
        });
        document.querySelector("#subtotal").innerHTML = subtotal;
    }

    function constructParams() {
        var storage = window.localStorage;
        var params = "data";
        return `data=${encodeURIComponent(JSON.stringify(storage))}`;
    }

    function handleResponse(response) {
        var storage = window.localStorage;
        var cartTable = document.querySelector("#bookdetails table");
        var subtotal = 0;
        for (var [isbn, row] of Object.entries(response)) {
            var qty = storage.getItem(isbn);
            var newTr = document.createElement("tr");
            var total = row['price'] * qty;
            subtotal += total;
            newTr.setAttribute("id", isbn);
            newTr.setAttribute("class", "dataRow");
            newTr.innerHTML = `<td><button name='delete' id='delete' onClick='del("${isbn}");return false;'>Delete
                                        Item</button></td>
                                <td>${row['name']}</br><b>By</b> ${row['author']}</br><b>Publisher:</b> ${row['publisher']}</td>
                                <td><input id='${isbn}' name='${isbn}' value='${qty}' size='1' /></td>
                                <td>${total}</td>`;
            cartTable.appendChild(newTr);
        }
        document.querySelector("#subtotal").innerHTML = subtotal;
    }

    function del(isbn) {
        var td = document.getElementById(`${isbn}`);
        var cartTable = document.querySelector("#bookdetails table");
        var storage = window.localStorage;

        cartTable.removeChild(td);
        storage.removeItem(isbn);
    }
    </script>
</head>

<body>
    <table align="center" style="border:2px solid blue;">
        <tr>
            <td align="center">
                <form id="checkout" action="confirm_order.php" method="get">
                    <input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
                </form>
            </td>
            <td align="center">
                <form id="new_search" action="screen2.php" method="post">
                    <input type="submit" name="search" id="search" value="New Search">
                </form>
            </td>
            <td align="center">
                <form id="exit" action="index.php" method="post">
                    <input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
                </form>
            </td>
        </tr>
        <tr>
            <form id="recalculate" name="recalculate" action="" method="post">
                <td colspan="3">
                    <div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
                        <table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
                            <th width='10%'>Remove</th>
                            <th width='60%'>Book Description</th>
                            <th width='10%'>Qty</th>
                            <th width='10%'>Price</th>
                            <!-- <tr>
                                <td><button name='delete' id='delete' onClick='del("123441");return false;'>Delete
                                        Item</button></td>
                                <td>iuhdf</br><b>By</b> Avi Silberschatz</br><b>Publisher:</b> McGraw-Hill</td>
                                <td><input id='txt123441' name='txt123441' value='1' size='1' /></td>
                                <td>12.99</td>
                            </tr> -->
                        </table>
                    </div>
                </td>
            </form>
        </tr>
        <tr>
            <td align="center">
                <!-- <input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment"> -->
                <button id="recalculateBtn">recalculate_payment</button>
            </td>
            <td align="center">
                &nbsp;
            </td>
            <td align="center">
                Subtotal: $<span id="subtotal">0</span>
            </td>
        </tr>
    </table>
</body>