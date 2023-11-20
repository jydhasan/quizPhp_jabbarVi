<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/register.css">
</head>

<body>
    <br><br>
    <form method="POST" action="register.php">
        <h2>Register Form</h2>
        <label for="uname">Your Name</label>
        <input type="text" name="uname" placeholder="Enter your name" required>
        <label for="schoolname">Institute/Collage/University</label>
        <input type="text" name="schoolname" placeholder="Enter your school name" required>
        <label for="thana">Your thana</label>
        <input type="text" name="thana" placeholder="Enter your thana" required>
        <label for="district">Your district</label>
        <input type="text" name="district" placeholder="Enter your district" required>
        <label for="email">Your email</label>
        <input type="email" name="email" placeholder="Enter your email" required>
        <label for="phone">Your phone</label>
        <input type="text" name="phone" placeholder="Enter your phone" required> <br>
        <input type="submit" name="submit" value="Register"></input>
    </form>
</body>
</html>

<?php
require "../dbconn.php";

// Check if form submitted
if (isset($_POST["submit"])) {
    // get values from the form
    $uname = mysqli_real_escape_string($db_conn, $_POST['uname']);
    $schoolname = mysqli_real_escape_string($db_conn, $_POST['schoolname']);
    $thana = mysqli_real_escape_string($db_conn, $_POST['thana']);
    $district = mysqli_real_escape_string($db_conn, $_POST['district']);
    $email = mysqli_real_escape_string($db_conn, $_POST['email']);
    $phone = mysqli_real_escape_string($db_conn, $_POST['phone']);

    // Check if the phone number already exists
    $checkQuery = "SELECT * FROM students WHERE phone = '$phone'";
    $result = mysqli_query($db_conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Phone number already exists, show a message
        echo "Phone number already exists. Please use a different phone number.";
    } else {
        // Phone number does not exist, proceed with the insertion
        // create table students if not exists
        $createTableQuery = "CREATE TABLE IF NOT EXISTS students (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            uname VARCHAR(30) NOT NULL,
            schoolname VARCHAR(30) NOT NULL,
            thana VARCHAR(30) NOT NULL,
            district VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            phone VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if (mysqli_query($db_conn, $createTableQuery)) {
            // insert data into students table
            $insertQuery = "INSERT INTO students (uname, schoolname, thana, district, email, phone)
                VALUES ('$uname', '$schoolname', '$thana', '$district', '$email', '$phone')";

            if (mysqli_query($db_conn, $insertQuery)) {
                // redirect to login page
                header("Location: login.php");
                exit(); // Ensure that no further code is executed after redirection
            } else {
                echo "Error: " . mysqli_error($db_conn);
            }
        } else {
            echo "Error: " . mysqli_error($db_conn);
        }
    }
}
?>
