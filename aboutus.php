<?php
require 'fx.php';
session_start();
$admins = query("SELECT * FROM admin");
?>

<!DOCTYPE html>
<html>

<head>
    <title>About Us</title>
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
        bottom: 0 ;
    }

    table {
        border: 7px solid #7DA2A9;
        border-collapse: collapse;
        width: 90%;
        margin-left: 40px;
        font-size: 16px;
    }

    td {
        text-align: center;
        border-collapse: collapse;
        border: 7px solid #7DA2A9;
    }
</style>

<body>
<?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        echo ('<div id="header" align="center">');
        echo ('<a href="index.php" >MyPet</a>');
        echo ('<a href="foodsntreats.php">Foods & Treats</a>');
        echo ('<a href="accessories.php">Accessories</a>');
        echo ('<a href="cart.php">Cart</a>');
        echo ('<a href="aboutus.php"style="background-color:#1b383d; color:white">About Us</a>');
        echo (' <a href="loginphp.php">Log In</a>');
        echo ('</div>');}
     else {
        if ($_SESSION["userlevel"] == "customer") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php">MyPet</a>');
            echo ('<a href="foodsntreats.php">Foods & Treats</a>');
            echo ('<a href="accessories.php">Accessories</a>');
            echo ('<a href="cart.php" >Cart</a>');
            echo ('<a href="aboutus.php"style="background-color:#1b383d; color:white">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');
        } else  if ($_SESSION["userlevel"]== "admin") {
            echo ('<div id="header" align="center">');
            echo ('<a href="index.php">MyPet</a>');
            echo ('<a href="admin.php">Products</a>');
            echo ('<a href="salesrecord.php" >Sales Record</a>');
            echo ('<a href="aboutus.php"style="background-color:#1b383d; color:white">About Us</a>');
            echo ('<a href="logoutphp.php">Log Out</a>');
            echo ('</div>');}
    } ?>

    <br><br><br>

    <h1>&nbsp;&nbsp;MyPet Pet Shop</h1>

    <p style="margin-left: 40px; margin-right: 40px;">
        We are your confided in pet store in Malaysia. Our store offers you a space little creatures you will discover Birds, Rodents,
        Fishes just as all the material that they suit them. You will likewise discover sustenance and adornments for all pets croquettes,
        patés, seeds and so forth.
        <br><br>
        We likewise offer a shopping for food with craftsman items or natural bread kitchen for our 4-legged companions and the “BARF”
        the new eating regimen for pooch and feline dependent on 84% least meat!
        <br><br>
        We feature brands, for example, Lily’s Kitchen Distributor of the Queen of England or Edgard Cooper or Orijen and other people
        who utilize just new items in the structure of their croquettes. Yet, you will likewise discover brands like Royal Canin and so on.
    </p>

    <video width="620" height="440" autoplay style="margin-left: 40px;">
        <source src="petshopvid.mp4" type="video/mp4">
    </video>

    <h1>&nbsp;&nbsp;MyPet Admins</h1>

    <?php $counter = 0; ?>
    <table border="1" center>
        <?php foreach ($admins as $admin) :
            if ($counter == 0) {
                echo "<tr>";
            }
        ?>
            <td>
                <br>
                <img src="<?php echo $admin["pfimg"]; ?>" alt="" width="150" height="175">
                <br><br>
                <table border="1" style="margin-left: 26px;">
                    <tr>
                        <td>
                            Name :
                        </td>
                        <td>
                            <?php echo $admin["name"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Student Number :
                        </td>
                        <td>
                            <?php echo $admin["id"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Program Code :
                        </td>
                        <td>
                            <?php echo $admin["codeprog"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Group :
                        </td>
                        <td>
                            <?php echo $admin["kelas"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email :
                        </td>
                        <td>
                            <?php echo $admin["email"]; ?>
                        </td>
                    </tr>
                </table>
                <br>
            </td>
        <?php
            $counter++;
            if ($counter == 2) {
                echo "</tr>";
                $counter = 0;
            }
        endforeach; ?>
    </table>

    <br><br><br><br>

    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>
</body>

</html>