<!DOCTYPE HTML>

<head>
    <title>User Login</title>
    <script>
    var handleLogin = () => {
        var username = document.querySelector("#username").value;
        var pin = document.querySelector("#pin").value;
        (username && pin) ? requestLogin(username, pin): showErrorMsg("username or pin cannot be empty");
    };

    var requestLogin = (username, pin) => {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var userData = JSON.parse(this.responseText);
            Array.isArray(userData) ? showErrorMsg("Invalid login credentials") : storeUserData(userData);
        }
        xhttp.open("POST", "user_login_helper.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${username}&pin=${pin}`);
    };

    var showErrorMsg = (msg) => {
        document.querySelector("#errorMsg").innerHTML = msg;
    };

    var storeUserData = userData => {
        console.log(userData);
        window.sessionStorage.setItem("userData", JSON.stringify(userData));
        window.location.href = "./screen2.php";
    };
    </script>
</head>

<body>
    <table align="center" style="border:2px solid blue;">
        <!-- <form action="" method="post" id="login_screen"> -->
        <tr>
            <td align="right">
                Username<span style="color:red">*</span>:
            </td>
            <td align="left">
                <input type="text" name="username" id="username" value="hejiansong">
            </td>
            <td align="right">
                <button onclick="handleLogin()" name="login" id="login">Login</button>
            </td>
        </tr>
        <tr>
            <td align="right">
                PIN<span style="color:red">*</span>:
            </td>
            <td align="left">
                <input type="password" name="pin" id="pin" value="123">
            </td>
            <!-- </form> -->
            <!-- <form action="index.php" method="post" id="login_screen"> -->
            <td align="right">
                <button name="cancel" id="cancel" value="Cancel">Cancel</button>
            </td>
            <!-- </form> -->
        </tr>
    </table>
    <div id="errorMsg"></div>
</body>

</html>