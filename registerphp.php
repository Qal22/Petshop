<?php
require 'fx.php';

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username 
    if (empty(trim($_POST["cust_username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement 
        $sql = "SELECT fullname FROM customers WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) { // Bind variables to the prepared statement as parameters 
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // set parameters 
            $param_username = trim($_POST["cust_username"]);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["cust_username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }

    if (empty(trim($_POST["cust_password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["cust_password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["cust_password"]);
    }

    // validate confirm password 
    if (empty(trim($_POST["cust_password2"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["cust_password2"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check input errors before inserting in database 
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) { // Prepare an insert statement 
        $sql = "INSERT INTO customer (username, fullname, password, address, phone) VALUES (?, ?, ?, ?, ?) ";
        if ($stmt = mysqli_prepare($conn, $sql)) { // Bind variables to the prepared statement as parameters 
            mysqli_stmt_bind_param($stmt, "ssssd", $param_username,  $param_fullname, $param_password, $param_address, $param_phone);
            // set parameters 
            $param_username = $_POST["cust_username"];
            $param_fullname = $_POST["cust_fullname"];
            $param_password = md5($password);
            $param_address = $_POST["cust_address"];
            $param_phone = $_POST["cust_phone"];

            // Attempt to execute the prepared statement 
            if (mysqli_stmt_execute($stmt)) {
                header("location: loginphp.php");
                echo "<script> alert('Registration is successful!'); </script>";
            } // Redirect to login page
            else {
                echo "Something went wrong. Please try again later.";
            }
        } // Close statement 
        mysqli_stmt_close($stmt);
    } // Close connection 
    mysqli_close($conn);
}


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

<body>
    <div id="header" align="center">
        <h1>MyPet Shop</h1>
    </div>

    <br><br><br><br><br><br><br>

    <div align="center">
        <h1>Register</h1>
    </div>

    <div id="customerRegister">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table align="center">
                <tr>
                    <td><label for="cust_username">Username (for login):</label></td>
                    <td><input type="text" id="cust_username" name="cust_username" required /></td>
                </tr>
                <tr>
                    <td><label for="cust_fullname">Full Name:</label></td>
                    <td><input type="text" id="cust_fullname" name="cust_fullname" required /></td>
                </tr>
                <tr>
                    <td><label for="cust_password">Password:</label></td>
                    <td><input type="password" id="cust_password" name="cust_password" required /></td>
                </tr>
                <tr>
                    <td><label for="cust_password2">Re-enter Password:</label></td>
                    <td><input type="password" id="cust_password2" name="cust_password2" required /></td>
                </tr>
                <tr>
                    <td><label for="cust_address">Address:</label></td>
                    <td><input type="text" id="cust_address" name="cust_address" required /></td>
                </tr>
                <tr>
                    <td><label for="cust_phone">Phone:</label></td>
                    <td><input type="text" id="cust_phone" name="cust_phone" required /></td>
                </tr>
            </table>
            <br>
            <div align="center">
                <button type="submit" name="submit" id="button">Register</button><br>
                <a style="font-size: 14px;" href="loginphp.php"><b>Already have account? Login now.</b></a>
            </div>
        </form>
    </div>

    <br><br><br><br><br><br><br>

    <div id="footer">
        <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b>
    </div>
</body>

</html>