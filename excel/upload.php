<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/register.css">
</head>

<body>

    <br><br>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <h1>Import your Quiz</h1>
        <label for="title">Title:</label>
        <input type="text" id="qtitle" name="qtitle" required><br>
        <label for="title">Notice:</label>
        <input type="text" id="qdescription" name="qdescription" required><br>
        <label for="minutes">Minutes:</label>
        <input type="text" id="qtime" name="qtime" required><br>
        <br><br>
        <input type="file" name="excel_file">
        <br><br>
        <br>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>

</html>
<?php
require "../dbconn.php";
// Check if form submitted
if (isset($_POST["submit"])) {

    // Check if file uploaded successfully
    if ($_FILES["excel_file"]["error"] == UPLOAD_ERR_OK) {

        // Get file extension
        $file_ext = pathinfo($_FILES["excel_file"]["name"], PATHINFO_EXTENSION);

        // Check if file is Excel file
        if ($file_ext == "xlsx" || $file_ext == "xls") {

            // Read Excel file using PHPExcel library
            require_once "PHPExcel/Classes/PHPExcel.php";
            $input_file = $_FILES["excel_file"]["tmp_name"];
            $excel_reader = PHPExcel_IOFactory::createReaderForFile($input_file);
            $excel_obj = $excel_reader->load($input_file);

            // Get worksheet
            $worksheet = $excel_obj->getActiveSheet();

            // Get highest row and column
            $highest_row = $worksheet->getHighestRow();
            $highest_column = $worksheet->getHighestColumn();

            // Create a dynamic table name based on timestamp
            $table_name = "quiz_" . time();
            // Create a dynamic result table name
            $result_table_name = $table_name . "_result";

            // Create table for result
            $create_result_table_query = "CREATE TABLE IF NOT EXISTS $result_table_name (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                phone VARCHAR(30) NOT NULL,
                score VARCHAR(6) NOT NULL,
                total VARCHAR(6) NOT NULL,
                percentage INT(6) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            // create table for questionlist
            $create_questionlist_table_query = "CREATE TABLE IF NOT EXISTS questionlist (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                qtitle VARCHAR(30) NOT NULL,
                qdescription VARCHAR(30) NOT NULL,
                qtime INT(6) NOT NULL,
                qstart VARCHAR(30) NOT NULL,
                qtablename VARCHAR(30) NOT NULL,
                qresulttable VARCHAR(30) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
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

            // Execute the create table query
            if (mysqli_query($db_conn, $create_result_table_query)) {
                echo "Result table created successfully!";
            } else {
                echo "Error creating result table: " . mysqli_error($db_conn);
            }
            // Execute the create table query
            if (mysqli_query($db_conn,  $create_questionlist_table_query)) {
                echo "Result table created successfully!";
            } else {
                echo "Error creating result table: " . mysqli_error($db_conn);
            }
            // Execute the create table query
            if (mysqli_query($db_conn,  $createTableQuery)) {
                echo "Students table created successfully!";
            } else {
                echo "Error creating result table: " . mysqli_error($db_conn);
            }
            // Insert data into questionlist
            // $query = "INSERT INTO questionlist (qtitle, qtime, qstart, qtablename, qresulttable) VALUES ('zahid', '10', '1', '" . $table_name . "', '" . $result_table_name . "')";
            $query = "INSERT INTO questionlist (qtitle,qdescription, qtime, qstart, qtablename, qresulttable) VALUES ('" . $_POST["qtitle"] . "','" . $_POST["qdescription"] . "', '" . $_POST["qtime"] . "', '0', '" . $table_name . "', '" . $result_table_name . "')";
            mysqli_query($db_conn, $query);
            
            // Create an array to store column names
            $column_names = array();

            // Loop through the first row to get column names
            for ($col = 'A'; $col <= $highest_column; $col++) {
                $column_names[] = $worksheet->getCell($col . '1')->getValue();
            }

            // Create a SQL query to create a table
            $create_table_query = "CREATE TABLE IF NOT EXISTS $table_name (";

            foreach ($column_names as $column_name) {
                $create_table_query .= "`$column_name` VARCHAR(255), ";
            }

            $create_table_query = rtrim($create_table_query, ', ') . ")";

            // Insert data into MySQL
            // require "dbconn.php";
            
            // Execute the create table query
            if (mysqli_query($db_conn, $create_table_query)) {
                // Loop through each row (start from 2nd row as 1st row has column names)
                for ($row = 2; $row <= $highest_row; $row++) {
                    // Get cell values
                    $column_values = array();
                    for ($col = 'A'; $col <= $highest_column; $col++) {
                        $cell_value = $worksheet->getCell($col . $row)->getValue();
                        $column_values[] = $cell_value;
                    }

                    // Insert data into MySQL
                    $query = "INSERT INTO $table_name (" . implode(", ", $column_names) . ") VALUES ('" . implode("', '", $column_values) . "')";
                    mysqli_query($db_conn, $query);
                }

                echo "Data uploaded successfully!";
            } else {
                echo "Error creating table: " . mysqli_error($db_conn);
            }

            mysqli_close($db_conn);
        } else {
            echo "Please upload Excel file!";
        }
    } else {
        echo "File upload failed!";
    }
}
?>
