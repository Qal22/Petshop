<?php
    require 'fx.php';
    
    $product = query("SELECT * FROM product");

    if (isset($_POST["search"]))
    {
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
                font-family:monospace;
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

            #header a{
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

            #search {
                background-color: #7DA2A9;
                border: none;
                padding: 4px 20px;
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
            <a href="accessories.php">Accessories</a>
            <a href="aboutus.php">About Us</a>
            <a href="loginphp.php">Admin Log in</a>
        </div>

        <br><br>

        <img src="welcome.jpg" alt="" width="100%">

        <br><br>

        <form action="" method="post" align="center">
            <input type="text" name="keyword" style="width: 300px;" placeholder="Enter keyword...">
            <button type="submit" name="search" id="search">Search</button>
        </form>

        <p>&nbsp;&nbsp; All prodcuts</p>

        
        <?php $counter = 0; ?>
        <table align="center">
            <?php foreach($product as $prod) :
            if ($counter == 0)
            {
                echo "<tr>";
            }
            ?>
                <td>
                    <img src="<?php echo $prod["imageprod"]; ?>" alt="" width="250" height="300"><br>
                    <?php
                    echo $prod["name"],"<br>";
                    echo "RM",number_format($prod["price"],2),"<br>";
                    ?>
                    <br>
                    <a href="buying.php?id=<?php echo $prod["prod_id"]; ?>" style="size: 20px;" id="button">Buy</a>
                    <br><br>
                </td>
            <?php
            $counter++;
            if ($counter == 4)
            {
                echo "</tr>";
                $counter = 0;
            }
            endforeach; ?>
        </table>

        <br>

        <div id="footer">
            <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b> 
        </div>

    </body>
</html>

