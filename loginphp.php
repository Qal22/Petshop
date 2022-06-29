<?php
    require 'fx.php';

    $admins = query("SELECT * FROM admin");

    $i=0;

    if (isset($_POST["submit"]))
    {
        foreach ($admins as $admin)
        {
            if ($_POST["adminid"] == $admin["id"])
            {
                echo "
                    <script>
                        document.location.href = 'admin.php';
                    </script>
                ";
            }
            else
            {
                $i++;
            }
        }

        if ($i == 4)
        {
            echo "
                <script>
                    alert('You Entered a wrong ID, please try again.');
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Log In</title>
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
            <a href="index.php">Home</a>
        </div>

        <br><br><br><br><br><br><br>

        <div align="center">
            <h1>Log In | Admin Only</h1>
        </div>

        <form action="" method="post">
            <table align="center">
                <ul>
                    <tr>
                        <td>
                            <li><label for="adminid">Please Enter Your Admin ID : </label></li>
                        </td>
                        <td>
                            <input type="password" name="adminid" id="adminid">
                        </td>
                    </tr>
                </ul>
            </table>
            <br>
            <div align="center">
                <button type="submit" name="submit" id="button">Enter</button>
            </div>
        </form>

        <br><br><br><br><br><br><br><br><br><br>

        <div id="footer">
            <b>&copy; MyPet Sdn Bhd. All Rights Reserved (Educational Purposes)</b> 
        </div>
    </body>
</html>