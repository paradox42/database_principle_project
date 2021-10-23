<script>
// alert('Please enter all values')
</script><!-- UI: Prithviraj Narahari, php code: Alexander Martens -->

<head>
    <title> CUSTOMER REGISTRATION </title>
</head>

<body>
    <table align="center" style="border:2px solid blue;">
        <tr>
            <form id="register" action="" method="post">
                <td align="right">
                    Username<span style="color:red">*</span>:
                </td>
                <td align="left" colspan="3">
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                </td>
        </tr>
        <tr>
            <td align="right">
                PIN<span style="color:red">*</span>:
            </td>
            <td align="left">
                <input type="password" id="pin" name="pin">
            </td>
            <td align="right">
                Re-type PIN<span style="color:red">*</span>:
            </td>
            <td align="left">
                <input type="password" id="retype_pin" name="retype_pin">
            </td>
        </tr>
        <tr>
            <td align="right">
                Firstname<span style="color:red">*</span>:
            </td>
            <td colspan="3" align="left">
                <input type="text" id="firstname" name="firstname" placeholder="Enter your firstname">
            </td>
        </tr>
        <tr>
            <td align="right">
                Lastname<span style="color:red">*</span>:
            </td>
            <td colspan="3" align="left">
                <input type="text" id="lastname" name="lastname" placeholder="Enter your lastname">
            </td>
        </tr>
        <tr>
            <td align="right">
                Address<span style="color:red">*</span>:
            </td>
            <td colspan="3" align="left">
                <input type="text" id="address" name="address">
            </td>
        </tr>
        <tr>
            <td align="right">
                City<span style="color:red">*</span>:
            </td>
            <td colspan="3" align="left">
                <input type="text" id="city" name="city">
            </td>
        </tr>
        <tr>
            <td align="right">
                State<span style="color:red">*</span>:
            </td>
            <td align="left">
                <select id="state" name="state">
                    <option selected disabled>select a state</option>
                    <option>Michigan</option>
                    <option>California</option>
                    <option>Tennessee</option>
                </select>
            </td>
            <td align="right">
                Zip<span style="color:red">*</span>:
            </td>
            <td align="left">
                <input type="text" id="zip" name="zip">
            </td>
        </tr>
        <tr>
            <td align="right">
                Credit Card<span style="color:red">*</span>
            </td>
            <td align="left">
                <select id="credit_card" name="credit_card">
                    <option selected disabled>select a card type</option>
                    <option>VISA</option>
                    <option>MASTER</option>
                    <option>DISCOVER</option>
                </select>
            </td>
            <td colspan="2" align="left">
                <input type="text" id="card_number" name="card_number" placeholder="Credit card number">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                Expiration Date<span style="color:red">*</span>:
            </td>
            <td colspan="2" align="left">
                <input type="text" id="expiration" name="expiration" placeholder="MM/YY">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" id="register_submit" name="register_submit" value="Register">
            </td>
            </form>
            <form id="no_registration" action="index.php" method="post">
                <td colspan="2" align="center">
                    <input type="submit" id="donotregister" name="donotregister" value="Don't Register">
                </td>
            </form>
        </tr>
    </table>
    <?php
        include "database_connection.php";
        function isValidDate($str){
            $pattern = '/\d\d\/\d\d/';
            return preg_match($pattern, $str);
        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['username'],
                $_POST['pin'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['address'],
                $_POST['city'],
                $_POST['state'],
                $_POST['zip'],
                $_POST['credit_card'],
                $_POST['expiration'])
            ) {
                $userName = $_POST['username'];
                $password = $_POST['pin'];
                $fName = $_POST['firstname'];
                $lName = $_POST['lastname'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $zip = $_POST['zip'];
                $creditCardType = $_POST['credit_card'];
                $cardExpDate = $_POST["expiration"];
                if(!empty($_POST["card_number"])){
                    echo "card number is set";
                    echo "<br/>";
                    $cardNum = $_POST["card_number"];
                }else{
                    $cardNum = 0;
                }
                if(!isValidDate($cardExpDate)){
                    echo "Invalid expiration format";
                }
                else{
                    $sql = "INSERT INTO customer (user_name, pwd, f_name, l_name, address, city, state, zip, credit_card_type, card_number, card_exp)
                            VALUES('$userName','$password','$fName','$lName','$address','$city','$state',$zip,'$creditCardType',$cardNum,'$cardExpDate')";
                    echo $sql;
                    echo "<br/>";
                    if($conn->query($sql) === TRUE){
                        echo "Registration success!";
                    }else{
                        echo $conn->error;
                    }
                }
            }
            else{
                echo "please fill out all required data";
            }
        }
    ?>
</body>

</HTML>