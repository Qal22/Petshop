<?php

session_start();
require 'fx.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: loginphp.php");
    exit;
    $_SESSION["userlevel"];
}

$getQuery = "SELECT * FROM product";
$product = mysqli_query($conn, $getQuery);

if (isset($_POST["remove"])) {
    if ($_GET["action"] == "remove") {
        foreach ($_SESSION["cart"] as $key => $value) {
            if ($value["idc"] == $_GET["id"]) {
                unset($_SESSION["cart"][$key]);
                echo "
                <script>
                    alert('Product has been removed...');
                    document.location.href = 'cart.php';
                </script>
                ";
            }
        }
    }
}

if (isset($_POST["pay"])) {
    addsales($_POST);
    foreach ($_SESSION["cart"] as $key => $value) {
        unset($_SESSION["cart"][$key]);
    }
    echo "
                <script>
                    alert('Thank you for the purchase...');
                    document.location.href = 'index.php';
                </script>
                ";
}

?>

<!DOCtype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPet</title>
    <script>
        function updateprice() {
            var elem = document.getElementById("totalprice");
            var totalprice = 0;
            const quantities = document.getElementsByName("quantitybuy");
            const prices = document.getElementsByName("prices");
            for (var i = 0; i < quantities.length; i++) {
                totalprice += Number(quantities[i].value) * Number(prices[i].innerHTML);
            }
            elem.value = totalprice.toFixed(2);

            var listquantity = document.getElementById("listquantity");
            var input = updateQuantity();
            listquantity.innerHTML = input;
        }

        function updateQuantity() {
            var input = "";
            const quantities = document.getElementsByName("quantitybuy");
            for (var i = 0; i < quantities.length; i++) {
                input += "<input type='text' name='quantity["+i+"]' value='" + quantities[i].value + "' hidden/>";
            }
            return input;
        }
    </script>
</head>
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
        padding: 10px 20px;
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

    .cartlist {
        float: left;
        width: 60%;
        margin-left: 20px;
        margin-bottom: 100px;
    }

    .summary {
        float: right;
        width: 30%;
        margin-right: 50px;
    }

    table {
        width: 100%;
        border: 5px solid black;
    }

    .left {
        float: left;
        margin-left: 20px;
    }

    .right {
        float: right;
        margin-top: 30px;
        margin-right: 50px;
    }
</style>

<body>
    <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        echo ('<div id="header" align="center">');
        echo ('<a href="index.php" >MyPet</a>');
        echo ('<a href="foodsntreats.php">Foods & Treats</a>');
        echo ('<a href="accessories.php">Accessories</a>');
        echo ('<a href="cart.php"style="background-color:#1b383d; color:white">Cart</a>');
        echo ('<a href="aboutus.php">About Us</a>');
        echo (' <a href="loginphp.php">Log in</a>');
        echo ('</div>');
    } else {
        if ($_SESSION["userlevel"] == "customer") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php">MyPet</a>');
            echo ('<a href="foodsntreats.php">Foods & Treats</a>');
            echo ('<a href="accessories.php">Accessories</a>');
            echo ('<a href="cart.php" style="background-color:#1b383d; color:white">Cart</a>');
            echo ('<a href="aboutus.php">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');
        } else if ($_SESSION["userlevel"] == "admin") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php">MyPet</a>');
            echo ('<a href="foodsntreats.php">Foods & Treats</a>');
            echo ('<a href="accessories.php">Accessories</a>');
            echo ('<a href="cart.php"style="background-color:#1b383d; color:white" >Cart</a>');
            echo ('<a href="salesrecord.php" >Sales Record</a>');
            echo ('<a href="aboutus.php">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');
        }
    } ?>
    <br><br><br>
    <h1>Your Cart</h1>
    <div class="cartlist">
        <?php
        if (isset($_SESSION["cart"]) && $_SESSION["cart"] != null) {
            $prod_id = array_column($_SESSION["cart"], "idc");
            $prod_quantity = array_column($_SESSION["cart"], "quantity");
            foreach ($product as $prod) :
                for ($i = 0; $i < count($prod_id); $i++)
                    if ($prod["prod_id"] == $prod_id[$i]) { ?>
                    <form action="cart.php?action=remove&id=<?= $prod["prod_id"]; ?>" method="POST">
                        <table>
                            <tr>
                                <td>
                                    <div class="left">
                                        <img src="<?php echo $prod["imageprod"]; ?>" alt="" width="200" height="250">
                                    </div>
                                    <div class="right">
                                        <?= "Product Name : ", $prod["name"]; ?><br>
                                        Price per item : RM<span name="prices"><?= number_format($prod["price"], 2); ?></span><br>
                                        <label for="quantitybuy">Quantity : </label>
                                        <input type="number" name="quantitybuy" id="quantitybuy" value="<?= $prod_quantity[$i]; ?>" min="1" max="<?= $prod["quantity"]; ?>" onchange="updateprice()">
                                        <br><br>
                                        <input type="text" hidden name="prod_id" value="<?= $prod["prod_id"]; ?>" />
                                        <input type="text" hidden name="username" value="<?= $_SESSION["customer"]; ?>" />
                                        <button type="submit" name="remove" id="button" value="Remove">Remove</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br>
            <?php }
            endforeach;
        } else {
            ?>
            <?php
            echo "<h3 align=center>Cart is empty...</h3>";
            ?>
        <?php
        }
        ?>
    </div>
    <div class="summary">
        <?php
        if (isset($_SESSION["cart"])) {
        ?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>
                            <h4 align="center">Total Price</h4>
                            <label for="totalprice">RM</label>
                            <span id="listquantity"></span>
                            <input type="text" id="totalprice" name="totalprice" readonly value="" required>
                            <input type="submit" name="pay" value="Pay" id="button">
                        </td>
                    </tr>
                </table>
            </form>
        <?php
        } else {
        }
        ?>
    </div>
    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>
    <script>
        updateprice();
    </script>
</body>

</html>