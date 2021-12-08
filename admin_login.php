<!DOCTYPE HTML>

<head>
    <title>Admin Login</title>
    <script>
    function adminLogin() {
        var username = document.querySelector("#adminname").value;
        var pin = document.querySelector("#pin").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            this.responseText[0] === "1" ? redirect() : showError();
        }
        xhttp.open("POST", "admin_login_helper.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${username}&pin=${pin}`);
    }

    function redirect() {
        window.location.href = "./admin_tasks.php";
    }

    function showError() {
        document.querySelector("#error").innerHTML = "user name or pin does not match, or you are not a admin";
    }
    </script>
</head>

<body>
    <table align="center" style="border:2px solid blue;">
        <!-- <form action="admin_tasks.php" method="post" id="adminlogin_screen"> -->
        <div>
            <tr>
                <td align="right">
                    Adminname<span style="color:red">*</span>:
                </td>
                <td align="left">
                    <input type="text" name="adminname" id="adminname" value="admin">
                </td>
                <td align="right">
                    <button onclick="adminLogin()" id="login">Login</button>
                </td>
            </tr>
            <tr>
                <td align="right">
                    PIN<span style="color:red">*</span>:
                </td>
                <td align="left">
                    <input type="password" name="pin" id="pin" value="789789">
                </td>
        </div>
        <!-- </form> -->
        <form action="index.php" method="post" id="login_screen">
            <td align="right">
                <input type="submit" name="cancel" id="cancel" value="Cancel">
            </td>
        </form>
        </tr>
    </table>
    <div id="error"></div>
</body>



</html>