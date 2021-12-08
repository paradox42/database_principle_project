<!DOCTYPE HTML>

<head>
    <title>Admin Login</title>
    <script>
    function adminLogin() {
        var username = document.querySelector("#adminname").value;
        var pin = document.querySelector("#pin").value;
        console.log(username, pin);
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
                    <input type="password" name="pin" id="pin" value="789798">
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
</body>



</html>