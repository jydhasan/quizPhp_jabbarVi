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
    <form method="POST" action="notice.php">
        <h2>Notice Form</h2>
        <label for="uname">Announce Notice</label>
        <input type="text" name="notice" placeholder="Type notice" required>
        <input type="submit" name="submit" value="Announce"></input>
    </form>
</body>
</html>

<?php
require "../dbconn.php";

// Check if form submitted
if (isset($_POST["submit"])) {
    // get values from the form
    $notice = mysqli_real_escape_string($db_conn, $_POST['notice']);
        // Phone number does not exist, proceed with the insertion
        // create table students if not exists
        $createTableQuery = "CREATE TABLE IF NOT EXISTS notice (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            notice VARCHAR(256) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $resultCreateTable = mysqli_query($db_conn, $createTableQuery);
        // Insert data into students table
        $insertQuery = "INSERT INTO notice (notice) VALUES ('$notice')";
        $resultInsert = mysqli_query($db_conn, $insertQuery);
        if ($resultInsert) {
            // echo "New record created successfully";
            header("Location: ../index.php");
        } else {
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($db_conn);
        }



}

// // show last notice here 
// $query = "SELECT * FROM notice ORDER BY id DESC LIMIT 1";
// $result = mysqli_query($db_conn, $query);
// while ($row = mysqli_fetch_array($result)) {
//     echo "<h1>Notice : " . $row['notice'] . "</h1>";
// }

?>
