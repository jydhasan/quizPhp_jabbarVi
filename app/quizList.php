<?php
require "../dbconn.php";
// Fetch data from questionlist
$query = "SELECT * FROM questionlist";
$result = mysqli_query($db_conn, $query);
$quizNotice = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Notices</title>
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
            <th>Question Title</th>
            <th>Question Time</th>
            <th>Question Start</th>
            <th>Question Table Name</th>
            <th>Result Table Name</th>
            <th>Registration Date</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php echo $row['qtitle']; ?></td>
                <td><?php echo $row['qtime']; ?></td>
                <td>
                    <a href="qstart.php?qstart=<?php echo urlencode($row['qstart']); ?>&qtablename=<?php echo urlencode($row['qtablename']); ?>">
                        <?php echo $row['qstart']; ?>
                    </a>
                </td>
                <td><?php echo $row['qtablename']; ?></td>
                <td><a href="result_table.php?qresulttable=<?php echo urlencode($row['qresulttable']); ?>"><?php echo $row['qresulttable']; ?></a></td>
                <td><?php echo $row['reg_date']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
