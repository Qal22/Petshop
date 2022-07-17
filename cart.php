<?php

require 'fx.php';

session_start();

// $db = new CreateDB();
$getQuery = "SELECT * FROM product";
$product = mysqli_query($conn, $getQuery);

if (isset($_POST["remove"])) {
    if ($_GET["action"] == "remove") {
        foreach ($_SESSION["cart"] as $key => $value) {
            if ($value["idc"] == $_GET["id"]) {

                $prod_id = array_column($_SESSION["cart"], "idc");
                if ($prod_id == 0) {
                    unset($_SESSION["cart"]);
                    echo "
                    <script>
                        alert('Product has been removed...');
                        document.location.href = 'cart.php';
                    </script>
                    ";
                }

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

?>

<!DOCtype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPet</title>
    <script>
        function updateprice() {
            var x = document.getElementById("quantitybuy").value;
            var elem = document.getElementById("totalprice");
            elem.value = x;
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
    <div id="header" align="center">
        <a href="index.php">MyPet</a>
        <a href="foodsntreats.php">Foods & Treats</a>
        <a href="accessories.php">Accessories</a>
        <a href="cart.php" style="background-color:#1b383d; color:white">Cart</a>
        <a href="aboutus.php">About Us</a>
        <a href="loginphp.php">Log in</a>
    </div>
    <br><br><br>
    <h1>Your Cart</h1>
    <div class="cartlist">
        <?php
        if (isset($_SESSION["cart"])) {
            $prod_id = array_column($_SESSION["cart"], "idc");
            foreach ($product as $prod) :
                foreach ($prod_id as $id) :
                    if ($prod["prod_id"] == $id) { ?>
                        <form action="cart.php?action=remove&id=<?= $prod["prod_id"]; ?>" method="POST">
                            <table>
                                <tr>
                                    <td>
                                        <div class="left">
                                            <img src="<?php echo $prod["imageprod"]; ?>" alt="" width="200" height="250">
                                        </div>
                                        <div class="right">
                                            <?= "Product Name : ", $prod["name"]; ?><br>
                                            <?= "Price per item : RM", number_format($prod["price"], 2); ?><br>
                                            <label for="quantitybuy">Quantity : </label>
                                            <input type="number" name="quantitybuy" id="quantitybuy" min="1" max="<?= $prod["quantity"]; ?>" onchange="updateprice()">
                                            <br><br>
                                            <button type="submit" name="remove" id="button" value="Remove">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
            <?php }
                endforeach;
            endforeach;
        } else {
            ?>
            <!-- <table>
                <tr>
                    <td>
                        <?php
                        echo "<h3 align=center>Cart is empty...</h3>";
                        ?>
                    </td>
                </tr>
            </table> -->
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
                            <input type="text" id="totalprice" name="totalprice" readonly value="" required>
                            <input type="submit" name="submit" value="Pay" id="button">
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
</body>

</html>