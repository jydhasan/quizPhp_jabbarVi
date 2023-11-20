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
    <form method="POST" action="login.php">
        <h2>Register Form</h2>
        <label for="phone">Your phone</label><br>
        <input type="text" name="phone" placeholder="Enter your phone" required> <br><br>
        <input type="submit" name="submit" value="Login"></input>
    </form>
    <!-- add youtube video link  -->
    <h1>পরীক্ষা পদ্ধতি জানতে ক্লিক করুণ</h1>
    <div class="youtube">
        <iframe  src="https://www.youtube.com/embed/5qap5aO4i9A" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</body>
</html>

<?php
require "../dbconn.php";

// Check if form submitted
if (isset($_POST["submit"])) {
    // get values from the form
    $phone = mysqli_real_escape_string($db_conn, $_POST['phone']);

    // Check if the phone number already exists
    $checkQuery = "SELECT * FROM students WHERE phone = '$phone'";
    $result = mysqli_query($db_conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Phone number already exists, show a message
        // echo "Phone number already exists. Please use a different phone number.";
        // add session
        session_start();
        $_SESSION['phone'] = $phone;
        // redirect to index.php
        header("Location: ../index.php");
    } else {
        // Phone number does not exist, proceed with the insertion
    //    echo "Phone number does not exist, proceed with the insertion";
    header("Location: register.php");
    }
}
?>
