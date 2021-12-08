<!DOCTYPE HTML>

<head>
    <title>ADMIN TASKS</title>
    <script>
    function gen_reports() {
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            // console.log(this.responseText);
            var data = JSON.parse(this.responseText);
            console.log(data);
            updateTotalUser(data.total);
            showCategory(data.categoryGroup);
            showReviewSum(data.bookReviews);
        }
        xhttp.open("POST", "admin_tasks_helper.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send();
    }
    function updateTotalUser(total){
        document.querySelector("#totalUser").innerHTML = `<div>Total registered customer: ${total}</div>`;
    }

    function showCategory(data) {
        var div = document.querySelector("#categoryGroup");
        div.innerHTML = "<h7>Categories in group: </h7>";
        for(var [key, value] of Object.entries(data)){
            div.innerHTML += `<div>${value.categories}:${value.count}</div>`;
        }
    }

    function showReviewSum(data) {
        var div = document.querySelector("#reviewSum");
        div.innerHTML = "<h7>Book name and review counts: </h7>"
        for(var [key, value] of Object.entries(data)){
            div.innerHTML += `<div>${value.name}: ${value.count}</div>`;
        }
    }
    </script>
</head>

<body>
    <table align="center" style="border:2px solid blue;">
        <tr>
            <form action="manage_bookstorecatalog.php" method="post" id="catalog">
                <td align="center">
                    <input type="submit" name="bookstore_catalog" id="bookstore_catalog"
                        value="Manage Bookstore Catalog" style="width:200px;">
                </td>
            </form>
        </tr>
        <tr>
            <form action=" " method="post" id="orders">
                <td align="center">
                    <input type="submit" name="place_orders" id="place_orders" value="Place Orders"
                        style="width:200px;">
                </td>
            </form>
        </tr>
        <tr>
            <!-- <form action="reports.php" method="post" id="reports"> -->
            <div id="reports">
                <td align="center">
                    <!-- <input type="submit" name="gen_reports" id="gen_reports" value="Generate Reports" style="width:200px;">  -->
                    <button id="gen_reports" onclick="gen_reports()" style="width:200px">Generate Reports</button>
                </td>
            </div>
            <!-- </form> -->
        </tr>
        <tr>
            <form action="update_adminprofile.php" method="post" id="update">
                <td align="center">
                    <input type="submit" name="update_profile" id="update_profile" value="Update Admin Profile"
                        style="width:200px;">
                </td>
            </form>
        </tr>
        <tr>
            <td>&nbsp</td>
        </tr>
        <tr>
            <form action="index.php" method="post" id="exit">
                <td align="center">
                    <input type="submit" name="cancel" id="cancel" value="EXIT 3-B.com[Admin]" style="width:200px;">
                </td>
            </form>
        </tr>
    </table>
    <div id="totalUser"></div>
    <br/>
    <div id="categoryGroup"></div>
    <br/>
    <div id="reviewSum"></div>
</body>


</html>