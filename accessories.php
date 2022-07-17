<?php
require 'fx.php';

session_start();

if (isset($_GET["idc"]))
{
    if ($_SESSION["cart"])
    {
        $item_array_id = array_column($_SESSION["cart"], "idc");

        if (in_array($_GET["idc"], $item_array_id))
        {
            echo "
            <script>
                alert('Product is already added in the cart...');
                document.location.href = 'accessories.php';
            </script>
            ";
        }
        else
        {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                "idc" => $_GET["idc"]
            );
            $_SESSION["cart"][$count] = $item_array;

            echo "
            <script>
                alert('Added to cart...');
                document.location.href = 'accessories.php';
            </script>
            ";
        }
    }
    else
    {
        $item_array = array(
            "idc" => $_GET["idc"]
        );

        $_SESSION["cart"][0] = $item_array;

        echo "
            <script>
                alert('Added to cart...');
                document.location.href = 'accessories.php';
            </script>
            ";
    }
}

$product = query("SELECT * FROM product");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Accessories</title>
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
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    table {
        width: 100%;
    }

    td {
        text-align: center;
    }
</style>
<body>
    <div id="header" align="center">
        <a href="index.php">MyPet</a>
        <a href="foodsntreats.php">Foods & Treats</a>
        <a href="accessories.php" style="background-color:#1b383d; color:white">Accessories</a>
        <a href="cart.php">Cart</a>
        <a href="aboutus.php">About Us</a>
        <a href="loginphp.php">Log in</a>
    </div>

    <br><br><br>

    <h1>&nbsp;&nbsp; Accessories</h1>

    <?php $counter = 0; ?>
    <table align="center">
        <?php foreach ($product as $prod) :
            if ($counter == 0) {
                echo "<tr>";
            }
        ?>

            <?php if ($prod["type"] == "accessories") { ?>
                <td>
                    <img src="<?php echo $prod["imageprod"]; ?>" alt="" width="250" height="300"><br>
                    <?php
                    echo $prod["name"], "<br>";
                    echo "RM", number_format($prod["price"], 2), "<br>";
                    ?>
                    <br>
                    <a href="buying.php?id=<?php echo $prod["prod_id"]; ?>" style="size: 20px;" id="button">Details</a>
                    <a href="accessories.php?idc=<?php echo $prod["prod_id"]; ?>" style="size: 20px;" id="button">Add To Cart</a>
                    <br><br>
                </td>
            <?php $counter++;
            } ?>

        <?php

            if ($counter == 4) {
                echo "</tr>";
                $counter = 0;
            }
        endforeach; ?>
    </table>

    <br><br><br>

    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>
</body>

</html>