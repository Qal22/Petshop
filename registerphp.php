<?php
require 'fx.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>PetShop | Register</title>
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
        padding: 22px 10px;
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
</style>

<body>
    <div id="header" align="center">
        <h1>Pet Shop Website</h1>
    </div>

    <br><br><br><br><br><br><br>

    <div align="center">
        <h1>Register</h1>
    </div>

    <div id="customerRegister">
        <form action="" method="post">
            <table align="center">
                <tr>
                    <td><label for="cust_fullname">Full Name:</label></td>
                    <td><input type="text" id="cust_fullname" name="cust_fullname" required/></td>
                </tr>
                <tr>
                    <td><label for="cust_username">Username (for login):</label></td>
                    <td><input type="text" id="cust_username" name="cust_username" required/></td>
                </tr>
                <tr>
                    <td><label for="cust_password">Password:</label></td>
                    <td><input type="password" id="cust_password" name="cust_password" required/></td>
                </tr>
                <tr>
                    <td><label for="cust_password2">Re-enter Password:</label></td>
                    <td><input type="password" id="cust_password2" name="cust_password2" required/></td>
                </tr>
                <tr>
                    <td><label for="cust_address">Address:</label></td>
                    <td><input type="text" id="cust_address" name="cust_address" required/></td>
                </tr>
                <tr>
                    <td><label for="cust_phone">Phone:</label></td>
                    <td><input type="text" id="cust_phone" name="cust_phone" required/></td>
                </tr>
            </table>
            <br>
            <div align="center">
                <button type="submit" name="submit" id="button">Register</button><br>
                <a style="font-size: 12px;" href="loginphp.php">Already have account? Login now.</a>
            </div>
        </form>
    </div>

    <br><br><br><br><br><br><br>

    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>
</body>

</html>