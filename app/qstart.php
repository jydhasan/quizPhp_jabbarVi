<?php
// qstart.php
require "../dbconn.php";
if (isset($_GET['qstart']) && isset($_GET['qtablename'])) {
    $qstart = $_GET['qstart'];
    $qtablename = $_GET['qtablename'];
    if ($qstart == 0) {
        $query = "UPDATE questionlist SET qstart='1' WHERE qtablename='$qtablename'";
        mysqli_query($db_conn, $query);
        header("Location: ../index.php");
    } else {
        $query = "UPDATE questionlist SET qstart='0' WHERE qtablename='$qtablename'";
        mysqli_query($db_conn, $query);
        header("Location: ../index.php");
    }
}
?>
