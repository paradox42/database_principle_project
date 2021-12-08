<!DOCTYPE HTML>

<head>
    <title>Proof purchase</title>
    <header align="center">Proof purchase</header>
    <script>
    window.onload = function() {
        var username = JSON.parse(window.sessionStorage.userData).username;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var response = JSON.parse(this.responseText);
            updatePurchase(response);
        }
        xhttp.open("POST", "proof_purchase_helper.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${username}`);

        updateShipping();
        updateUserInfo();
    }

    function updateShipping() {
        var userData = JSON.parse(window.sessionStorage.userData);
        document.querySelector("#name").innerHTML = `${userData.fName} ${userData.lName}`;
        document.querySelector("#street").innerHTML = `${userData.address}`;
        document.querySelector("#city").innerHTML = `${userData.city}`;
        document.querySelector("#stateZip").innerHTML = `${userData.state} ${userData.zip}`;
    }

    function updateUserInfo() {
        var userData = JSON.parse(window.sessionStorage.userData);
        console.log(userData);
        document.querySelector("#userId").innerHTML = `user id: ${userData.username}`;
        document.querySelector("#cardInfo").innerHTML =
            `Card info: ${userData.carType}<br/> ${userData.cardNumber} - ${userData.cardExpDate}`;
    }

    function updatePurchase(response) {
        var table = document.querySelector("#purchaseInfo");
        var subtotal = 0;
        for (var [key, value] of Object.entries(response)) {
            var total = value.Qty * value.price;
            table.innerHTML +=
                `<tr>
                    <td>
                        ${value.name}<br/>By ${value.author}<br/>Price: $${value.price}
                    </td>
                    <td>${value.Qty}</td>
                    <td>${total}</td>
                    <td>${value.timestamp}</td>
                </tr>`;
            subtotal += total;
        }
        // SubTotal:$0</br>Shipping_Handling:$0</br>_______</br>Total:$0 </div>
        document.querySelector("#subtotal").innerHTML =
            `SubTotal:$${subtotal}</br>Shipping_Handling:$4</br>_______</br>Total:$${subtotal+4} </div>`;
    }

    function exit() {
        window.localStorage.clear();
        window.sessionStorage.clear();
        window.location.href = "./index.php";
    }
    </script>
</head>

<body>
    <table align="center" style="border:2px solid blue;">
        <form id="buy" action="" method="post">
            <tr>
                <td>
                    Shipping Address:
                </td>
            </tr>
            <td id="name" colspan="2">
                test test </td>
            <td rowspan="3" colspan="2">
                <div id="userId">UserId: </div>
                <!-- <b>Date:</b>2019-10-03<br />
                <b>Time:</b>16:34:46<br /> -->
                <!-- <b>Card Info:</b>MASTER<br />12/2015 - 1234567812345678 -->
                <div id="cardInfo">Card Info:</div>
            </td>
            <tr>
                <td id="street" colspan="2">
                    street </td>
            </tr>
            <tr>
                <td id="city" colspan="2">
                    City</td>
            </tr>
            <tr>
                <td id="stateZip" colspan="2">
                    Tennessee, 12345 </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
                        <table id="purchaseInfo" border='1'>
                            <th>Book Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Purchase Date-time</th>
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
                    <div id="subtotal" style="overflow:scroll;height:180px;width:260px;border:1px solid black;">
                        SubTotal:$0</br>Shipping_Handling:$0</br>_______</br>Total:$0 </div>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="submit" id="buyit" name="btnbuyit" value="Print" disabled>
                </td>
        </form>
        <td align="right">
            <form id="update" action="screen2.php" method="post">
                <input type="submit" id="update_customerprofile" name="update_customerprofile" value="New Search">
            </form>
        </td>
        <td align="left">
            <div>
                <button type="submit" onclick="exit()">EXIT 3-B.com</button>
            </div>
        </td>
        </tr>
    </table>
</body>

</HTML>