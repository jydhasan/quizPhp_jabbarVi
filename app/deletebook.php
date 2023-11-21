<?php
// get the qtablename from the URL
$id = $_GET['id'];
// echo $id;
require '../dbconn.php';
// delete the record from the questionlist table
$query = "DELETE FROM books WHERE id=?";
$stmt = mysqli_prepare($db_conn, $query);
// Bind the parameter
mysqli_stmt_bind_param($stmt, "i", $id);
// Execute the query
mysqli_stmt_execute($stmt);
// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($db_conn);
// redirect to quizList.php
header("Location: booklist.php");
?>