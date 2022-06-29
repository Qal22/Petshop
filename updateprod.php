<?php

require 'fx.php';

$id = $_GET["id"];

$product = query("SELECT * FROM product WHERE prod_id = $id")[0];

            if (isset($_POST["submit"]))
            {
                if (updateprod($_POST) > 0)
                {
                    echo "
                    <script>
                        alert('Succeeded');
                        document.location.href = 'admin.php';
                    </script>
                    ";
                }
                else
                {
                    echo "
                    <script>
                        alert('Failed');
                        document.location.href = 'admin.php';
                    </script>
                    ";
                }
            }


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Product</title>
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
                padding: 21px 10px;
                background-color: #7DA2A9;
                color: black;
                text-align: center;
            }

            button {
                background-color: #7DA2A9;
                border: none;
                color: black;
                padding: 16px 32px;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

        </style>
    <body>
        <div id="header" align="center">
            <a href="admin.php">Back</a>
        </div>

        <br><br><br>

        <p align="center">Please update the details Of The Product</p>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="prod_id" value="<?= $product["prod_id"]; ?>">
            <input type="hidden" name="oldimg" value="<?= $product["imageprod"]; ?>">
            <ul>
                <table align="center">
                    <tr>
                        <td>
                            <li>
                                <label for="name">Name : </label>
                            </li>
                        </td>
                        <td>
                            <input type="text" name="name" id="name" required value="<?= $product["name"]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li>
                                <label for="type">Type : </label>
                            </li>
                        </td>
                        <td>
                            <select name="type" id="type" style="width: 176px;">
                                <?php if($product["type"] == "foods & treats") { ?>
                                <option value="foods & treats" selected>foods & treats</option>
                                <option value="accessories">accessories</option>
                                <?php } else { ?>
                                <option value="foods & treats">foods & treats</option>
                                <option value="accessories" selected>accessories</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li>
                                <label for="quantity">Quantity : </label>
                            </li>
                        </td>
                        <td>
                            <input type="number" name="quantity" id="quantity" min=1 required value="<?= $product["quantity"]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li>
                                <label for="price">Price : RM</label>
                            </li>
                        </td>
                        <td>
                            <input type="number" name="price" id="price" min=0.00 step="0.10" required value="<?= $product["price"]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li>
                                <label for="imageprod">Product Image : </label>
                            </li>
                        </td>
                        <td>
                            <img src="<?= $product["imageprod"]; ?>" alt="" width="200"><br>
                            <input type="file" name="imageprod" id="imageprod">
                        </td>
                    </tr>
                </table>
                <br>
                <div align="center">
                    <button type="submit" name="submit">Update Product</button>
                </div>
            </ul>
        </form>

        <br>

        <div id="footer">
            <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b> 
        </div>
    </body>
</html>