<?php
require 'fx.php';

session_start();
if (isset($_GET["idc"])) {
    if ($_SESSION["cart"]) {
        $item_array_id = array_column($_SESSION["cart"], "idc");

        if (in_array($_GET["idc"], $item_array_id)) {
            echo "
            <script>
                alert('Product is already added in the cart...');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                "idc" => $_GET["idc"]
            );
            $_SESSION["cart"][$count] = $item_array;

            echo "
            <script>
                alert('Added to cart...');
                document.location.href = 'index.php';
            </script>
            ";
        }
    } else {
        $item_array = array(
            "idc" => $_GET["idc"]
        );

        $_SESSION["cart"][0] = $item_array;

        echo "
            <script>
                alert('Added to cart...');
                document.location.href = 'index.php';
            </script>
            ";
    }
}

//pagination limit 4 item per page
$limit = 4;
$page_number = 1;
if (isset($_GET["page"])) {
    $page_number = $_GET["page"];
} else {
    $page_number = 1;
}
$total_rows = getTotalRow("SELECT COUNT(*) FROM product")[0];
$total_pages = ceil($total_rows / $limit);

$initial_page = ($page_number - 1) * $limit;
$getQuery = "SELECT * FROM product LIMIT $initial_page, $limit";
$product = mysqli_query($conn, $getQuery);

$showPagination = true;
if (isset($_POST["search"])) {
    $showPagination = false;
    $product = searchprod($_POST["keyword"]);
}

?>

<!DOCtype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPet</title>
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

    #search {
        background-color: #7DA2A9;
        border: none;
        padding: 4px 20px;
        cursor: pointer;
    }

    .pagination a {
        background-color: #E6E2DD;
        color: black;
        border: 2px solid;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .pagination .active {
        background-color: #7DA2A9;
        color: black;
        border: 2px solid;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .pagination span {
        background-color: white;
        color: gray;
        border: 2px solid;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    table {
        width: 100%;
    }

    td {
        text-align: center;
    }
</style>

<body>
    <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        echo ('<div id="header" align="center">');
        echo ('<a href="index.php"style="background-color:#1b383d; color:white">MyPet</a>');
        echo ('<a href="foodsntreats.php">Foods & Treats</a>');
        echo ('<a href="accessories.php">Accessories</a>');
        echo ('<a href="cart.php">Cart</a>');
        echo ('<a href="aboutus.php">About Us</a>');
        echo (' <a href="loginphp.php">Log In</a>');
        echo ('</div>');}
     else {
        if ($_SESSION["userlevel"] == "customer") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php"style="background-color:#1b383d; color:white">MyPet</a>');
            echo ('<a href="foodsntreats.php">Foods & Treats</a>');
            echo ('<a href="accessories.php">Accessories</a>');
            echo ('<a href="cart.php" >Cart</a>');
            echo ('<a href="aboutus.php">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');
        } else  if ($_SESSION["userlevel"]== "admin") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php"style="background-color:#1b383d; color:white">MyPet</a>');
            echo ('<a href="admin.php">Products</a>');
            echo ('<a href="salesrecord.php" >Sales Record</a>');
            echo ('<a href="aboutus.php">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');}
    } ?>

    <br><br>

    <img src="welcome.jpg" alt="" width="100%">

    <br><br>

    <form action="" method="post" align="center">
        <input type="text" name="keyword" style="width: 300px;" placeholder="Enter keyword...">
        <button type="submit" name="search" id="search">Search</button>
    </form>

    <p>&nbsp;&nbsp; All products</p>

    <div class="pagination" align="center" <?php
                                            if (!$showPagination) {
                                                echo 'hidden';
                                            }
                                            ?>>
        <?php
        $pageURL = "";
        if ($page_number >= 2) {
            $pageURL .= "<a href='index.php?page=" . ($page_number - 1) . "#table'> Prev </a>";
        } else {
            $pageURL .= "<span> Prev </span>";
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page_number) {
                $pageURL .= "<a class = 'active' href='index.php?page=" . $i . "#table'>" . $i . " </a>";
            } else {
                $pageURL .= "<a href='index.php?page=" . $i . "#table'>" . $i . " </a>";
            }
        };
        echo $pageURL;
        if ($page_number < $total_pages) {
            echo "<a href='index.php?page=" . ($page_number + 1) . "#table'> Next </a>";
        } else {
            echo "<span> Next </span>";
        }

        ?>
    </div>
    <?php $counter = 0; ?>
    <table id="table" align="center">
        <?php foreach ($product as $prod) :
            if ($counter == 0) {
                echo "<tr>";
            }
        ?>
            <td>
                <img src="<?php echo $prod["imageprod"]; ?>" alt="" width="250" height="300"><br>
                <?php
                echo $prod["name"], "<br>";
                echo "RM", number_format($prod["price"], 2), "<br>";
                ?>
                <br>
                <a href="buying.php?id=<?php echo $prod["prod_id"]; ?>" style="size: 20px;" id="button">Details</a>
                <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                    echo '  <a href="loginphp.php?idc=' . $prod['prod_id'] . '" style="size: 20px;" id="button">Add To Cart</a>';
                } else {
                    echo '<a href="index.php?idc=' . $prod['prod_id'] . '"style="size: 20px;" id="button">Add To Cart</a>';
                } ?>
                <br><br>
            </td>
        <?php
            $counter++;
            if ($counter == 4) {
                echo "</tr>";
                $counter = 0;
            }
        endforeach; ?>
    </table>

    <br><br>

    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>

</body>

</html>