<?php
// Reference: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $homeaddress = $homephone = $cellphone = $firstname = $lastname = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = $homeaddress_err = $homephone_err = $firstname_err = $lastname_err = "";
$error = false;
 
function displayError($msg) {
    if (!empty($msg)) {
        echo "
        <div class=\"alert alert-danger\" role=\"alert\">
            $msg
        </div>
        ";
    }
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = trim($_POST["username"]);
    // Check if username is empty
    if(empty($username)){
        $error = true;
        $username_err = "Please enter username.";
    } else {
        // Validate username
        $sql = "SELECT id FROM users WHERE username = '" . $username . "'";
        $result = mysqli_query($db_connection, $sql);

        if(count(mysqli_fetch_array($result)) >= 1){
            $error = true;
            $username_err = "This username is already taken.";
        }
    }

    $email = trim($_POST["email"]);
    // Check if email is empty
    if(empty($email)){
        $error = true;
        $email_err = "Please enter email.";
    } else {
        // Validate email
        $sql = "SELECT id FROM users WHERE email = '" . $email . "'";
        $result = mysqli_query($db_connection, $sql);

        if(count(mysqli_fetch_array($result)) >= 1){
            $error = true;
            $email_err = "This email is already taken.";
        }
    }

    $password = trim($_POST["password"]);
    // Validate password
    if(empty($password)){
        $error = true;
        $password_err = "Please enter a password.";     
    } elseif(strlen($password) < 6){
        $error = true;
        $password_err = "Password must have atleast 6 characters.";
    } 
    
    $confirm_password = trim($_POST["confirm_password"]);
    // Validate confirm password
    if(empty($confirm_password)){
        $error = true;
        $confirm_password_err = "Please confirm password.";     
    } else{
        if(empty($password_err) && ($password != $confirm_password)){
            $error = true;
            $confirm_password_err = "Password did not match.";
        }
    }
    
    $homeaddress = trim($_POST["homeaddress"]);
    // Validate homeaddress
    if(empty($homeaddress)){
        $error = true;
        $homeaddress_err = "Please enter a homea ddress.";     
    } 

    $homephone = trim($_POST["homephone"]);
    // Validate homephone
    if(empty($homephone)){
        $error = true;
        $homephone_err = "Please enter a home phone.";     
    } elseif(strlen($homephone) != 10){
        $error = true;
        $homephone_err = "Home Phone must have 10 digits.";
    } 

    $firstname = trim($_POST["firstname"]);
    // Validate firstname
    if(empty($firstname)){
        $error = true;
        $firstname_err = "Please enter a home phone.";     
    } 

    $lastname = trim($_POST["lastname"]);
    // Validate lastname
    if(empty($lastname)){
        $error = true;
        $lastname_err = "Please enter a home phone.";     
    } 

    $cellphone = trim($_POST["cellphone"]);

    // Check input errors before inserting in database
    if(!$error){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, created_at, firstname, lastname, email, homeaddress, homephone, cellphone) 
                VALUE (?, ?, NOW(), ?, ?, ?, ?, ?, ?)";
        echo $sql;
        if($stmt = mysqli_prepare($db_connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $username, $param_password, $firstname, $lastname, $email, $homeaddress, $homephone, $cellphone);
            // echo $stmt;
            // Set parameters
            $param_password = mD5($password); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($db_connection);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="register.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter UserName">
                <span class="help-block"><?php echo displayError($username_err); ?></span>
            </div>    
            <div class="form-group">
                <label for="FirstName">First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" placeholder="Enter First Name">
                <span class="help-block"><?php echo displayError($firstname_err); ?></span>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" placeholder="Enter Last Name">
                <span class="help-block"><?php echo displayError($lastname_err); ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Enter Password">
                <span class="help-block"><?php echo displayError($password_err); ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Enter Password Again">
                <span class="help-block"><?php echo displayError($confirm_password_err); ?></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter Email">
                <span class="help-block"><?php echo displayError($email_err); ?></span>
            </div>
            <div class="form-group">
                <label for="HomeAddress">Home Address</label>
                <input type="text" name="homeaddress" class="form-control" value="<?php echo $homeaddress; ?>" placeholder="Enter Home Address">
                <span class="help-block"><?php echo displayError($homeaddress_err); ?></span>
            </div>
            <div class="form-group">
                <label for="HomePhone">Home Phone</label>
                <input type="text" name="homephone" class="form-control" value="<?php echo $homephone; ?>" placeholder="Enter Home Phone">
                <span class="help-block"><?php echo displayError($homephone_err); ?></span>
            </div>
            <div class="form-group">
                <label for="CellPhone">Cell Phone</label>
                <input type="text" name="cellphone" class="form-control" value="<?php echo $cellphone; ?>" placeholder="Enter Cell Phone">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <!-- <input type="reset" class="btn btn-default" value="Reset"> -->
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>