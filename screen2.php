<!-- Figure 2: Search Screen by Alexander -->
<html>

<head>
    <title>SEARCH - 3-B.com</title>
    <script>
        function exit() {
            window.localStorage.clear();
            window.sessionStorage.clear();
            window.location.href = "./index.php";
        }
    </script>
</head>

<body>
    <table align="center" style="border:1px solid blue;">
        <tr>
            <td>Search for: </td>
            <form action="screen3.php" method="get">
                <td><input name="searchfor" /></td>
                <td><input type="submit" name="search" value="Search" /></td>
        </tr>
        <tr>
            <td>Search In: </td>
            <td>
                <select name="searchon[]" multiple>
                    <option value="anywhere" selected='selected'>Keyword anywhere</option>
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="publisher">Publisher</option>
                    <option value="isbn">ISBN</option>
                </select>
            </td>
            <td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>
        </tr>
        <tr>
            <td>Category: </td>
            <td><select name="category">
                    <option value='all' selected='selected'>All Categories</option>
                    <option value='1'>Fantasy</option>
                    <option value='2'>Adventure</option>
                    <option value='3'>Fiction</option>
                    <option value='4'>Horror</option>
                </select></td>
            </form>
            <div>
                <td><button type="submit" onclick="exit()">EXIT 3-B.com</button></td>
            </div>
        </tr>
    </table>
</body>

</html>