<?php
require "../dbconn.php";
session_start();

// Fetch data from questionlist
if (isset($_GET['qtablename'])) {
    $qtablename = urldecode($_GET['qtablename']);
    $query = "SELECT * FROM $qtablename";
    $result = mysqli_query($db_conn, $query);

    $quizNotice = array();

    $query2 = "SELECT * FROM questionlist where qtablename='$qtablename'";
    $result2 = mysqli_query($db_conn, $query2);

    // Set the countdown to the value of $row2['qtime'] in minutes
    if ($row2 = mysqli_fetch_array($result2)) {
        $countdownMinutes = $row2['qtime'];
    } else {
        // Handle the case when no data is found
        echo "No quiz data found";
        exit;
    }
} else {
    // Handle the case when 'qtablename' is not set in the URL
    echo "qtablename parameter is not set";
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalQuestions = mysqli_num_rows($result);
    $correctAnswersCount = 0;
    $unsubmittedCount = 0;

    echo "<h2>Results:</h2>";
    while ($row = mysqli_fetch_array($result)) {
        $questionId = $row['si'];
        $answerKey = 'answer_' . $questionId;

        // Check if the key is set in the $_POST array
        if (isset($_POST[$answerKey])) {
            $selectedAnswer = $_POST[$answerKey];
            $correctAnswer = $row['answer'];

            // Check if the selected answer is correct
            echo "<p>Question {$row['si']}: ";
            if ($selectedAnswer === $correctAnswer) {
                echo "Correct</p>";
                $correctAnswersCount++;
            } else {
                echo "Incorrect</p>";
            }
        } else {
            // Handle the case when the key is not set
            echo "<p>Question {$row['si']}: Answer not submitted</p>";
            $unsubmittedCount++;
        }
    }

    $incorrectAnswersCount = $totalQuestions - $correctAnswersCount - $unsubmittedCount;

    echo "<p>Total Correct Answers: $correctAnswersCount</p>";
    echo "<p>Total Incorrect Answers: $incorrectAnswersCount</p>";
    echo "<p>Total Unsubmitted Questions: $unsubmittedCount</p>";
    echo "<p>Score: " . ($correctAnswersCount / $totalQuestions * 100) . "%</p>";
    // count negative .25 mark for each wrong answer
    echo "<p>Total marks : " . ($correctAnswersCount - $incorrectAnswersCount * 0.25) . "</p>";
    $total_marks=($correctAnswersCount - $incorrectAnswersCount * 0.25);
// upload marks to table $ $qtablename . "_result";
$result_table_name=$qtablename . "_result";
$phone=$_SESSION['phone'];
echo $phone;
echo $result_table_name;
echo $qtablename;
// make a query where $qtablename is the table name and $phone is the phone number
$queryTWo = "SELECT * FROM students where phone='$phone'";
$resultTWo = mysqli_query($db_conn, $queryTWo);
// fetch name from students table
if ($rowTWo = mysqli_fetch_array($resultTWo)) {
    $name = $rowTWo['uname'];
    $phone = $rowTWo['phone'];
    // echo $name;
    // insert data into result table
    $queryThree = "INSERT INTO $result_table_name (name, phone, score, total, percentage) VALUES ('$name', '$phone', '$correctAnswersCount', '$total_marks', '" . ($correctAnswersCount / $totalQuestions * 100) . "')";
    // $queryThree = "INSERT INTO $result_table_name (name, score, total, percentage) VALUES ('$name', '$correctAnswersCount', '$total_marks', '" . ($correctAnswersCount / $totalQuestions * 100) . "')";
    mysqli_query($db_conn, $queryThree);
    // echo $queryThree;
    echo "Result table created successfully!";

} else {
    // Handle the case when no data is found
    echo "No quiz data found";
    // exit;
}
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Answers</title>
    <link rel="stylesheet" href="../static/css/quiz.css">
    <style>
           table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Display quiz information -->
    <!-- ... (your existing code to display quiz information) ... -->

    <!-- Display the correct answers -->
    <h2>Correct Answers:</h2>
    <?php
    mysqli_data_seek($result, 0); // Reset result pointer to the beginning
    while ($row = mysqli_fetch_array($result)) {
        // echo "<p>Question {$row['si']}:{$row['question']} {$row['answer']}{$row['option5']}{$row['option6']}{$row['option7']}{$row['option8']}</p>";
        // make a table and show the correct answer
        echo "<table>";
        echo "<tr>";
        echo "<td>Question {$row['si']}:</td>";
        echo "<td>{$row['question']}</td>";
        echo "<td>{$row['answer']}</td>";
        echo "<td>{$row['option5']}</td>";
        echo "<td>{$row['option6']}</td>";
        echo "<td>{$row['option7']}</td>";
        echo "<td>{$row['option8']}</td>";
        echo "</tr>";
        echo "</table>";


    }
    ?>
</body>
</html>
