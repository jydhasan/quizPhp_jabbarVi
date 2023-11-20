<!DOCTYPE html>
<html>

<head>
    <title>Upload a Product</title>
    <link rel="stylesheet" href="../static/css/register.css">
</head>

<body>
    <br><br>

    <form action="bookUpload.php" method="post" enctype="multipart/form-data">
        <h1>Upload a Product</h1>
        <label for="file">Select pdf:</label><br>
        <input type="file" id="file" name="file" required>

        <label for="image">Select cover image:</label><br>
        <input type="file" id="image" name="image" required>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
<br><br>
        <input type="submit" name="submit" value="Upload">
    </form>

    <?php
require '../dbconn.php';

// check if form is submitted
if (isset($_POST['submit'])) {
    $filename = $_FILES['file']['name'];
    $filetmpname = $_FILES['file']['tmp_name'];
    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $filename);

    $imgname = $_FILES['image']['name'];
    $imgtmpname = $_FILES['image']['tmp_name'];
    move_uploaded_file($imgtmpname, $folder . $imgname);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Create books table if not exists
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS books (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(30) NOT NULL,
        description VARCHAR(256) NOT NULL,
        price INT(6) NOT NULL,
        image VARCHAR(50) NOT NULL,
        file VARCHAR(50) NOT NULL
    )";
    $resultCreateTable = mysqli_query($db_conn, $sqlCreateTable);

    if (!$resultCreateTable) {
        die("Table creation failed: " . mysqli_error($db_conn));
    }

    // Insert data into books table using prepared statement
    $sqlInsert = "INSERT INTO books (title, description, price, image, file) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db_conn, $sqlInsert);
    mysqli_stmt_bind_param($stmt, "ssiss", $title, $description, $price, $imgname, $filename);

    $resultInsert = mysqli_stmt_execute($stmt);

    if ($resultInsert) {
        echo "<h1>File uploaded successfully</h1>";
    } else {
        echo "<h1>Failed to upload file.</h1>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($db_conn);
?>


</body>

</html>
