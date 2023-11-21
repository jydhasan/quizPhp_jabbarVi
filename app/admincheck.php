<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/register.css">
</head>

<body>
    <br><br><br>
    <form method="POST" action="admincheck.php">
        <h2>Register Form</h2>
        <label for="password">Your password</label><br>
        <input type="text" name="password" placeholder="Enter your password" required> <br><br>
        <input type="submit" name="submit" value="Login"></input>
    </form>
</body>
</html>
<?php
// check if form submitted
if (isset($_POST["submit"])) {
    // get values from the form
    $password =  $_POST['password'];
    $actual_password = "654321";
    if($password == $actual_password){
        header("Location: admin.php");
    }else{
        echo "Password is incorrect";
    }
}
?>