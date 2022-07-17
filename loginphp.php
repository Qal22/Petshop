<?php
require 'fx.php';

$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start(); 
    
    if ($_POST["userlevel"] == "customer") {

        $username = trim($_POST["cust_username"]);
        $password = md5(trim($_POST["cust_password"]));
         

        $sql = "SELECT * FROM customer WHERE username = '$username'
        and password = '$password' ";

        $result = mysqli_query($conn, $sql); 

        if (!$result)
            die("Database access failed: " . mysqli_connect_error());

        
        $rows = mysqli_num_rows($result);
        if ($rows) {
            $row = mysqli_fetch_array($result);
            $_SESSION['customer'] = $username;
            $_SESSION['loggedin'] = true;
            $_SESSION['userlevel'] = "customer";
            $usrlevel = $_SESSION["userlevel"];
            header("location: index.php");
        } else {
            echo "<script> alert('Oops! Wrong Username & Password'); </script>";
        }
    } elseif($_POST["userlevel"] == "admin")  {

        $username = $_POST["admin_id"];
        $password = trim($_POST["admin_password"]);
        $sql = "SELECT * FROM admin WHERE name = '$username'
        and id = '$password' ";

        $result = mysqli_query($conn, $sql); 


        if (!$result)
            die("Database access failed: " . mysqli_connect_error());
        
        $rows = mysqli_num_rows($result);
        if ($rows) { 
            $row = mysqli_fetch_array($result);
            $_SESSION['admin'] = $username;
            $_SESSION['loggedin'] = true;
            $_SESSION['userlevel'] = "admin";
            header("location: index.php");
            $usrlevel = $_SESSION["userlevel"];
        } else {
            echo "<script> alert('Oops! Wrong Username & Password'); </script>";
        }
    }else{echo "<script> alert('Oops! There is something wrong. Please try again later'); </script>"; header("location: loginphp.php");}
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>PetShop | Log In</title>
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
        <a href="index.php">MyPet</a>
        <a href="foodsntreats.php">Foods & Treats</a>
        <a href="accessories.php">Accessories</a>
        <a href="aboutus.php">About Us</a>
        <a href="loginphp.php">Log in</a>
    </div>

    <div style="background-color:#a1babf">
    <br><br><br>
    <h1 style="text-align:center">MyPet Shop</h1>
    <br>
    </div>

    <div align="center">
        <h1>Log In</h1>
        <input type="radio" name="loginRadio" onclick="showForm(this.value)" value="customer" checked>Customer
        <input type="radio" name="loginRadio" onclick="showForm(this.value)" value="admin">Admin<br>
    </div>
    <br>
    <script language="javascript">
        function showForm(value) {
            if (value == "customer") {
                document.getElementById("customerLogin").hidden = false;
                document.getElementById("adminLogin").hidden = true;
            } else {
                document.getElementById("customerLogin").hidden = true;
                document.getElementById("adminLogin").hidden = false;
            }
        }
    </script>

    <div id="customerLogin">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <table align="center">
                <tr>
                    <td><label for="cust_username">Username:</label></td>
                    <td><input type="text" id="cust_username" name="cust_username" /></td>
                </tr>
                <tr>
                    <td><label for="cust_password">Password:</label></td>
                    <td><input type="password" id="cust_password" name="cust_password" /></td>
                </tr>
            </table>
            <br>
            <div align="center">
                <button type="submit" name="submit" id="button">Login</button><br>
                <a style="font-size: 14px;" href="registerphp.php"><b>Don't have account? Register now.</b></a>
            </div>
            <input type="hidden" name="userlevel" value="customer">
        </form>
    </div>
    <div id="adminLogin" hidden>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <table align="center">
                <tr>
                    <td><label for="admin_id">Admin ID:</label></td>
                    <td><input type="text" id="admin_id" name="admin_id" /></td>
                </tr>
                <tr>
                    <td><label for="admin_password">Password:</label></td>
                    <td><input type="password" id="admin_password" name="admin_password" /></td>
                </tr>
            </table>
            <br>
            <div align="center">
                <button type="submit" name="submit" id="button">Login</button>
            </div>
            <input type="hidden" name="userlevel" value="admin">
        </form>
    </div>

    <br><br><br><br><br><br><br>

    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>
</body>

</html>