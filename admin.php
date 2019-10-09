<?php
// Reference: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

// Include config file
require_once "config.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/kunsu.css">
</head>
<body>
    <div class="page-header">
        <h1>Welcome to the Admin Page.</h1>
    </div>
    <br>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Name:</th>
                    <th scope="col">Registered At:</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $result = mysqli_query($db_connection, "SELECT username, created_at FROM users");
                $index = 1;
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $index . "</th>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "</tr>";
                }  
            ?>

            </tbody>
        </table>
    </div>
    <br>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>