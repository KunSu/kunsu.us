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

function get_display_result($db_connection) {
    // Define variables and initialize with empty values
    $username = $email = $homephone = "";
    $sql_condition = array();

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        $username = trim($_POST["username"]);
        // Check if username is not empty
        if(!empty($username)){
            array_push($sql_condition, " username ='" . $username . "' "); 
        } 
        
        $email = trim($_POST["email"]);
        // Check if email is empty
        if(!empty($email)) {
            array_push($sql_condition, " email ='" . $email . "' "); 
        } 
        
        $homephone = trim($_POST["homephone"]);
        // Check if homephone is empty
        if(!empty($homephone)) {
            array_push($sql_condition, " homephone ='" . $homephone . "' "); 
        } 
    }
        
    // Processing SQL
    $sql = "SELECT username, created_at, email, homephone FROM users";
    if (count($sql_condition) > 0) {
        $sql .= " WHERE ";
        $and_string = "";
        foreach ($sql_condition as $key => $value) {
            $sql .= $and_string;
            $sql .= $value;
            $and_string = " AND ";
        }
        // echo "sql: " . $sql;
    } 
    $result = mysqli_query($db_connection, $sql);

    // Close connection
    mysqli_close($db_connection);
    return $result;
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
        <form action="admin.php" method="post">
            <div class="form-group">
                <label for="Username">UserName</label>
                <input type="text" name="username" class="form-control" placeholder="Search user by username">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email Address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search user by email">
            </div>
            <div class="form-group">
                <label for="phoneNumbers">Phone Number</label>
                <input type="text" name="homephone" class="form-control" placeholder="Search user by phone number">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">UserName:</th>
                    <th scope="col">Registered Time:</th>
                    <th scope="col">Email:</th>
                    <th scope="col">Home Phone:</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $result = get_display_result($db_connection);
                $index = 1;
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $index++ . "</th>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['homephone'] . "</td>";
                    echo "</tr>";
                }  
            ?>

            </tbody>
        </table>
    </div>
    <br>
    <p>
        <a href="user.php" class="btn btn-primary">All User Pages</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>