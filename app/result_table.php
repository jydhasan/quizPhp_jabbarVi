<?php
require "../dbconn.php";
// get the qresulttable from the URL
$qresulttable = $_GET['qresulttable'];
// echo $qresulttable;
// fetch all data from the result table
$query = "SELECT * FROM $qresulttable";
$result = mysqli_query($db_conn, $query);
// show data in the table
// echo "<table border='1' cellpadding='10'>";
// echo "<tr> <th>id</th> <th>name</th> <th>phone</th> <th>Total</th> <th>score</th> <th>reg_date</th> </tr>";
// // loop through results of database query, displaying them in the table
// while ($row = mysqli_fetch_array($result)) {
//     // echo out the contents of each row into a table
//     echo "<tr>";
//     echo '<td>' . $row['id'] . '</td>';
//     echo '<td>' . $row['name'] . '</td>';
//     echo '<td>' . $row['phone'] . '</td>';
//     echo '<td>' . $row['total'] . '</td>';
//     echo '<td>' . $row['score'] . '</td>';
//     echo '<td>' . $row['reg_date'] . '</td>';
//     echo "</tr>";
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<table>
    <caption><h2>Quiz Notices</h2></caption>
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>phone</th>
            <th>Total</th>
            <th>score</th>
            <th>reg_date</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['score']; ?></td>
                <td><?php echo $row['reg_date']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>