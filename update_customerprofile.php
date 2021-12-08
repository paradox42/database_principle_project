<!DOCTYPE HTML>

<head>
    <title>UPDATE CUSTOMER PROFILE</title>
    <script>
    function getAllInput() {
        var inputData = {};
        var inputList = document.querySelectorAll(".formData");

        inputList.forEach(function(input, index) {
            if (input.value) {
                inputData[input.id] = input.value;
            } else {
                setMessage(`please enter all information: ${input.id}`);
            }
        });
        //new_pin, retypenew_pin
        var pinIsSame = inputData.new_pin === inputData.retypenew_pin;
        //expiration_date
        var expDateIsValid = validateExpDate(inputData.expiration_date);
        if (pinIsSame && expDateIsValid) {
            sendUpdate(inputData);
            updateSession(inputData);
            window.location.href = "./confirm_order.php";
        } else {
            setMessage("pin is not the same or the expiration date of credit card is not valid format");
        }
    }

    function updateSession(newData) {
        var oldData = JSON.parse(window.sessionStorage.userData);
        console.log(oldData);
        oldData.PIN = newData.new_pin;
        oldData.address = newData.address;
        oldData.carType = newData.credit_card;
        oldData.cardExpDate = newData.expiration_date;
        oldData.cardNumber = newData.card_number;
        oldData.city = newData.city;
        oldData.fName = newData.firstname;
        oldData.lName = newData.lastname;
        oldData.state = newData.state;
        oldData.zip = newData.zip;
        window.sessionStorage.userData = JSON.stringify(oldData);
    }

    function sendUpdate(data) {
        console.log(data);
        data.username = JSON.parse(window.sessionStorage.userData).username;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(param) {
            console.log(this.responseText);
        }
        xhttp.open("POST", "update_customerprofile_helper.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        var params = `data=${JSON.stringify(data)}`;
        xhttp.send(params);
    }

    function validateExpDate(str) {
        return RegExp("^[0-9]{2}/[0-9]{2}$").test(str);
    }

    function setMessage(str) {
        document.querySelector("#error").innerHTML = str;
    }
    </script>
</head>

<body>
    <div id="update_profile" action="" method="post">
        <table align="center" style="border:2px solid blue;">
            <tr>
                <td align="right">
                    Username:
                </td>
                <td colspan="3" align="center">
                </td>
            </tr>
            <tr>
                <td align="right">
                    New PIN<span style="color:red">*</span>:
                </td>
                <td>
                    <input class="formData" type="text" id="new_pin" name="new_pin" value=54321>
                </td>
                <td align="right">
                    Re-type New PIN<span style="color:red">*</span>:
                </td>
                <td>
                    <input class="formData" type="text" id="retypenew_pin" name="retypenew_pin" value=54321>
                </td>
            </tr>
            <tr>
                <td align="right">
                    First Name<span style="color:red">*</span>:
                </td>
                <td colspan="3">
                    <input class="formData" type="text" id="firstname" name="firstname" value="firsname">
                </td>
            </tr>
            <tr>
                <td align="right">
                    Last Name<span style="color:red">*</span>:
                </td>
                <td colspan="3">
                    <input class="formData" type="text" id="lastname" name="lastname" value="lastname">
                </td>
            </tr>
            <tr>
                <td align="right">
                    Address<span style="color:red">*</span>:
                </td>
                <td colspan="3">
                    <input class="formData" type="text" id="address" name="address" value="address">
                </td>
            </tr>
            <tr>
                <td align="right">
                    City<span style="color:red">*</span>:
                </td>
                <td colspan="3">
                    <input class="formData" type="text" id="city" name="city" value="some town">
                </td>
            </tr>
            <tr>
                <td align="right">
                    State<span style="color:red">*</span>:
                </td>
                <td>
                    <select class="formData" id="state" name="state">
                        <option>Michigan</option>
                        <option>California</option>
                        <option>Tennessee</option>
                    </select>
                </td>
                <td align="right">
                    Zip<span style="color:red">*</span>:
                </td>
                <td>
                    <input class="formData" type="text" id="zip" name="zip" value=48185>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Credit Card<span style="color:red">*</span>:
                </td>
                <td>
                    <select class="formData" id="credit_card" name="credit_card">
                        <option>VISA</option>
                        <option>MASTER</option>
                        <option>DISCOVER</option>
                    </select>
                </td>
                <td align="left" colspan="2">
                    <input class="formData" type="text" id="card_number" name="card_number"
                        placeholder="Credit card number" value=4242424242424242>
                </td>
            </tr>
            <tr>
                <td align="right" colspan="2">
                    Expiration Date<span style="color:red">*</span>:
                </td>
                <td colspan="2" align="left">
                    <input class="formData" type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY"
                        value="08/22">
                </td>
            </tr>
            <tr>
                <td align="right" colspan="2">
                    <button onclick="getAllInput()" id="update_submit">Update</button>
                </td>
    </div>
    <form id="cancel" action="index.php" method="post">
        <td align="left" colspan="2">
            <input type="submit" id="cancel_submit" name="cancel_submit" value="Cancel">
        </td>
        </tr>
        </table>
    </form>
    <div id="error"></div>
</body>

</html>