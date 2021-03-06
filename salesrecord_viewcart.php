<?php
session_start(); // Check if the user is logged in, if not then redirect him to login page 
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
    $_SESSION["loggedin"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
        body {
            margin: 0;
            font-family: monospace;
            background-color: #E6E2DD;
            font-size: 18px;
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
    </style>
</head>

<body>
        
    <?php 
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        echo ('<div id="header" align="center">');
        echo ('<a href="index.php" >MyPet</a>');
        echo ('<a href="foodsntreats.php">Foods & Treats</a>');
        echo ('<a href="accessories.php">Accessories</a>');
        echo ('<a href="cart.php">Cart</a>');
        echo ('<a href="aboutus.php">About Us</a>');
        echo (' <a href="logoutphp.php">Log Out</a>');
        echo ('</div>');}
     else {
        if ($_SESSION["userlevel"] == "customer") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php">MyPet</a>');
            echo ('<a href="foodsntreats.php">Foods & Treats</a>');
            echo ('<a href="accessories.php">Accessories</a>');
            echo ('<a href="cart.php" >Cart</a>');
            echo ('<a href="aboutus.php">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');
        } else  if ($_SESSION["userlevel"]== "admin") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php">MyPet</a>');
            echo ('<a href="admin.php">Products</a>');
            echo ('<a href="salesrecord.php" style="background-color:#1b383d; color:white">Sales Record</a>');
            echo ('<a href="aboutus.php">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');}
    } ?>
    <br><br><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <br>
                        <h1 class="pull-left">Sales Record</h1> <br>
                    </div>
                    <?php
                    // Include dbConfig file
                    require_once "fx.php";
                    // Attempt select query execution
                    $sql = "SELECT * FROM sales_record JOIN cart USING (salesrecord_id) JOIN customer USING (username) JOIN product USING (prod_id) WHERE salesrecord_id = " . $_GET['salesrecord_id'] . ";";
                    echo "Sales ID: " . $_GET['salesrecord_id'] . " <br>";
                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Product Name</th>";
                            echo "<th>Price</th>";
                            echo "<th>Quantity</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            $no = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $no++;
                                echo "<tr>";
                                echo "<td>" . $no . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>RM" . number_format($row['price'], 2) . "</td>";
                                echo "<td>" . $row['cart_quantity'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "Total Price: <b>RM" . $_GET['total_price']. "</b>";
                            echo "<br><a href='salesrecord.php'>Back</a>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }
                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
                <br><br>

                <div id="footer">
                    <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
                </div>
            </div>
        </div>
    </div>
</body>

</html>