<?php
require 'fx.php';
session_start();
$id = $_GET["id"];

$prod = query("SELECT * FROM product WHERE prod_id = $id")[0];

if (isset($_POST["submit"])) {
    if (buyprod($_POST) > 0) {
        echo "
                <script>
                    alert('Thank You!');
                    document.location.href = 'index.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Failed');
                </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Details</title>
    <style>
        body {
            margin: 0;
            font-family: monospace;
            background-color: #E6E2DD;
            font-size: 20px;
        }

        #header {
            top: 0;
            width: 100%;
            position: fixed;
            overflow: hidden;
            background-color: #7DA2A9;
            padding: 20px 10px;
        }

        #header a {
            color: black;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            line-height: 25px;
            border-radius: 4px;
        }

        #header a:hover {
            background-color: #ddd;
            color: black;
        }

        #footer {
            overflow: hidden;
            padding: 20px 10px;
            background-color: #7DA2A9;
            color: black;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        #button {
            background-color: #7DA2A9;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        h1 {
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <!-- <script>
        function calculate() {
            var price = document.getElementById("price").value;
            var quantitybuy = document.getElementById("quantitybuy").value;
            var total = price * quantitybuy;
            var totprice = total.toFixed(2);
            alert("The total price is RM" + totprice);
        }
    </script> -->
</head>

<body>
    <div id="header" align="center">
        <a href="index.php">Cancel</a>
    </div>

    <br><br><br><br><br>

    <form action="" method="post">
        <h1>Product Details</h1>
        <input type="hidden" name="prod_id" value="<?= $prod["prod_id"]; ?>">
        <input type="hidden" name="price" id="price" value="<?= $prod["price"]; ?>">
        <input type="hidden" name="quantity" id="quantity" value="<?= $prod["quantity"]; ?>">
        <table>
            <tr>
                <td rowspan="3">
                    <img src="<?= $prod["imageprod"]; ?>" alt="" width="200" height="200">
                </td>
                <td>
                    <?= "Product Name : ", $prod["name"]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= "Price per item : RM", number_format($prod["price"], 2); ?>
                </td>
            </tr>
            <tr>
                <!-- <td>
                    <label for="quantitybuy">Quantity : </label>
                    <input type="number" name="quantitybuy" id="quantitybuy" min="1" max="<?= $prod["quantity"]; ?>" required>
                </td> -->
                <td>
                    <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                        echo '<a href="loginphp.php?idc=' . $prod['prod_id'] . '" style="size: 20px;" id="button">Add To Cart</a>';
                    } else {
                        echo '<a href="index.php?idc=' . $prod['prod_id'] . '"style="size: 20px;" id="button">Add To Cart</a>';
                    } ?>
                </td>
            </tr>
        </table>
        <!-- <h1>Shipment Details</h1>
        <table>
            <ul>
                <tr>
                    <td>
                        <li>
                            <label for="cust_name">Please enter your fullname : </label>
                            
                        </li>
                    </td>
                    <td>
                        <input type="text" name="cust_name" id="cust_name" size="50">
                    </td>
                    <td rowspan="3">
                        &nbsp;&nbsp;&nbsp;<button type="submit" name="submit" onclick="calculate()">Pay</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>
                            <label for="num_phone">Please enter your phone number : </label>
                        </li>
                    </td>
                    <td>
                        <input type="text" name="num_phone" id="num_phone" size="50">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>
                            <label for="address">Please enter your address : </label>
                        </li>
                    </td>
                    <td>
                        <input type="text" name="address" id="address" size="50">
                    </td>
                </tr>
            </ul>
        </table> -->
    </form>

    <br><br><br><br><br><br><br><br><br>

    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>
</body>

</html>