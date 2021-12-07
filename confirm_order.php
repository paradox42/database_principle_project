<!DOCTYPE HTML>

<head>
    <title>CONFIRM ORDER</title>
    <header align="center">Confirm Order</header>
    <script>
    window.onload = () => {
        updateCart();
        updateUserInfo();
    }

    function updateCart() {
        var params = constructParams();
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            handleResponse(JSON.parse(this.responseText));
        }
        xhttp.open("POST", "get_carted_items.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(params);
    }

    function handleResponse(response) {
        var bookTable = document.querySelector("#bookdetails table");
        var storage = window.localStorage;
        var subtotal = 0;
        for (var [isbn, row] of Object.entries(response)) {
            var qty = storage.getItem(isbn);
            var newTr = document.createElement("tr");
            var total = row['price'] * qty;
            subtotal += total;
            newTr.setAttribute("id", isbn);
            newTr.setAttribute("class", "dataRow");
            newTr.innerHTML = `<td>${row.name}</br><b>By</b> ${row.author}</br><b>Publisher:</b> ${row.publisher}</td>
                                <td>${qty}</td>
                                <td>$${total}</td>`
            bookTable.appendChild(newTr);
        }
        var bookSub = document.querySelector("#booksubtotal");
        bookSub.innerHTML = `SubTotal:${subtotal}</br>Shipping_Handling:$2</br>_______</br>Total:${subtotal + 2}`;
    }

    function constructParams() {
        var storage = window.localStorage;
        var params = "data";
        return `data=${encodeURIComponent(JSON.stringify(storage))}`;
    }

    function updateUserInfo() {
        var userData = JSON.parse(window.sessionStorage.userData);
        console.log(userData);
        document.querySelector("#cardType").innerHTML = userData.carType;
        document.querySelector("#cardNum").innerHTML = userData.cardNumber;
        document.querySelector("#cardExp").innerHTML = userData.cardExpDate;
        document.querySelector("#addr").innerHTML =
            `<div>
            ${userData.fName} ${userData.lName}<br/>
            ${userData.address}<br/>
            ${userData.city}<br/>
            ${userData.state} ${userData.zip}
        </div>`;
    }

    function handlePurchase() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            console.log(this.responseText);
        }
        xhttp.open("POST", "confirm_order_helper.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        var username = JSON.parse(window.sessionStorage.userData).username;
        var purchase = {
            books: window.localStorage,
            username: username,
            timeStamp: new Date()
        };
        var param = JSON.stringify(purchase);
        xhttp.send(`data=${param}`);
        window.location.href = "./proof_purchase.php";
    }
    </script>
</head>

<body>
    <table align="center" style="border:2px solid blue;">
        <div id="buy" action="" method="post">
            <tr>
                <td>
                    Shipping Address:
                    <div id="addr">Customer name</div>
                </td>
            </tr>
            <td colspan="2">
            </td>
            <td rowspan="3" colspan="2">
                <input type="radio" name="cardgroup" value="profile_card" checked>Use Credit card on file<br />
                <span id="cardType">MASTER -</span>
                <span id="cardNum">1234567812345678 - </span>
                <span id="cardExp">12/2015</span><br />
                <input type="radio" name="cardgroup" value="new_card">New Credit Card<br />
                <select id="credit_card" name="credit_card">
                    <option selected disabled>select a card type</option>
                    <option>VISA</option>
                    <option>MASTER</option>
                    <option>DISCOVER</option>
                </select>
                <input type="text" id="card_number" name="card_number" placeholder="Credit card number">
                <br />Exp date<input type="text" id="card_expiration" name="card_expiration" placeholder="mm/yyyy">
            </td>
            <tr>
                <td colspan="2">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
                        <table border='1'>
                            <th>Book Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <!-- <tr>
                                <td>iuhdf</br><b>By</b> Avi Silberschatz</br><b>Publisher:</b> McGraw-Hill</td>
                                <td>1</td>
                                <td>$12.99</td>
                            </tr> -->
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="left" colspan="2">
                    <div id="bookdetails"
                        style="overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue">
                        <b>Shipping Note:</b> The book will be </br>delivered within 5</br>business days.
                    </div>
                </td>
                <td align="right">
                    <div id="booksubtotal" style="overflow:scroll;height:180px;width:260px;border:1px solid black;">
                        <!-- SubTotal:$12.99</br>Shipping_Handling:$2</br>_______</br>Total:$14.99 -->
                    </div>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <button onclick="handlePurchase()" id="buyit" name="btnbuyit">But It!</button>
                </td>
        </div>
        <td align="right">
            <form id="update" action="update_customerprofile.php" method="post">
                <input type="submit" id="update_customerprofile" name="update_customerprofile"
                    value="Update Customer Profile">
            </form>
        </td>
        <td align="left">
            <form id="cancel" action="index.php" method="post">
                <input type="submit" id="cancel" name="cancel" value="Cancel">
            </form>
        </td>
        </tr>
    </table>
</body>

</HTML>