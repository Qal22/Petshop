<?php
require 'fx.php';

$admins = query("SELECT * FROM admin");
$product = query("SELECT * FROM product");
session_start();?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Mode</title>
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

    #delete {
        background-color: #D11A2A ;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    table {
        width: 90%;
        border: 7px solid #7DA2A9;
        border-collapse: collapse;
    }

    td {
        text-align: center;
        border: 7px solid #7DA2A9;
        border-collapse: collapse;
    }

    th {
        text-align: center;
        border: 7px solid #7DA2A9;
        border-collapse: collapse;
    }
</style>

<body>
<?php if ($_SESSION["userlevel"]== "admin") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php">MyPet</a>');
            echo ('<a href="admin.php"style="background-color:#1b383d; color:white">Products</a>');
            echo ('<a href="salesrecord.php" >Sales Record</a>');
            echo ('<a href="aboutus.php">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');}
    ?>
    <br><br><br><br><br>

    <table border="1" align="center">
        <tr>
            <th>
                ID
            </th>
            <th>
                Action
            </th>
            <th>
                Image
            </th>
            <th>
                Name
            </th>
            <th>
                Type
            </th>
            <th>
                Quantity
            </th>
            <th>
                Price
            </th>
        </tr>
        <?php foreach ($product as $prod) : ?>
            <tr>
                <td>
                    <?php echo $prod["prod_id"]; ?>
                </td>
                <td>
                    <a href="updateprod.php?id=<?php echo $prod["prod_id"]; ?>."style="size: 20px;" id="button">Update</a> 
                    <a href="deleteprod.php?id=<?php echo $prod["prod_id"];?>."style="size: 20px;" id="delete". onclick="return confirm('Confirm to delete the product?');">Delete</a>
                </td>
                <td>
                    <img src="<?php echo $prod["imageprod"]; ?>" alt="" width="250" height="300">
                </td>
                <td>
                    <?php echo $prod["name"]; ?>
                </td>
                <td>
                    <?php echo $prod["type"]; ?>
                </td>
                <td>
                    <?php echo $prod["quantity"]; ?>
                </td>
                <td>
                    <?php echo "RM", number_format($prod["price"], 2); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br><br><br>

    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>
</body>

</html>