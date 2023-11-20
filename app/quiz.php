

<?php

session_start();

// Check if the 'phone' session variable is set
if (isset($_SESSION['phone'])) {
    $phone = $_SESSION['phone'];
    // Do something with the phone number, e.g., display it
    echo "Phone number from session: " . $phone;

    // Unset the session variable if needed
    // unset($_SESSION['phone']);
} else {
    echo "Phone number session variable is not set.";
    // You might want to redirect the user or handle this case appropriately
}

?>



<?php
require "../dbconn.php";
// Fetch data from questionlist
// Check if the 'qtablename' parameter is set in the URL
if (isset($_GET['qtablename'])) {
    // Retrieve the value of 'qtablename'
    $qtablename = urldecode($_GET['qtablename']);
    $query = "SELECT * FROM $qtablename";
    $result = mysqli_query($db_conn, $query);
    $quizNotice = array();
    $query2 = "SELECT * FROM questionlist where qtablename='$qtablename'";
    $result2 = mysqli_query($db_conn, $query2);
    // Now you can use $qtablename as needed in your script
    // For example, you might use it in a database query or for some other purpose
    // echo "Value of qtablename: " . $qtablename;
} else {
    // Handle the case when 'qtablename' is not set in the URL
    echo "qtablename parameter is not set";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/quiz.css">
</head>
<body>
    <!-- <h1>{{rows}}</h1> -->
    <h1>Time : <span id="timer"></span></h1>
    <!-- print result2 -->
    <?php while ($row2 = mysqli_fetch_array($result2)): ?>
        <h1>Quiz Title : <?php echo $row2['qtitle']; ?></h1>
        <h4>Subject : <?php echo $row2['qdescription']; ?></h4>
        <!-- <h1>Quiz Time : <?php echo $row2['qtime']; ?></h1> -->
        <h4>Quiz Registration Date : <?php echo $row2['reg_date']; ?></h4>
        <?php
            // Set the countdown to the value of $row2['qtime'] in minutes
            $countdownMinutes = $row2['qtime'];
        ?>
    <?php endwhile; ?>
    
    <!-- <h1>Simple Radio Button Quiz</h1> -->
    <form id="myForm" action="quiz_ans.php?qtablename=<?php echo $qtablename ?>" method="post">
    <?php while ($row = mysqli_fetch_array($result)): ?>
        <h3><?php echo $row['si']; ?>: &nbsp;<?php echo $row['question']; ?></h3>
        <label>
            <input type="radio" name="answer_<?php echo $row['si']; ?>" value="<?php echo $row['option1']; ?>"> <?php echo $row['option5']; ?>
        </label>
        <label>
            <input type="radio" name="answer_<?php echo $row['si']; ?>" value="<?php echo $row['option2']; ?>"> <?php echo $row['option6']; ?>
        </label>
        <label>
            <input type="radio" name="answer_<?php echo $row['si']; ?>" value="<?php echo $row['option3']; ?>"> <?php echo $row['option7']; ?>
        </label>
        <label>
            <input type="radio" name="answer_<?php echo $row['si']; ?>" value="<?php echo $row['option4']; ?>"> <?php echo $row['option8']; ?>
        </label>
    <?php endwhile; ?>
    <input type="hidden" name="qtablename" value="<?php echo urlencode($qtablename); ?>">
        <br>
        <input type="submit" value="Submit">
    </form>
    <script>
    // Function to start the countdown
    function startCountdown(minutes) {
        let seconds = minutes * 60;
        const timerElement = document.getElementById('timer');
        
        function tick() {
            const minutesRemaining = Math.floor(seconds / 60);
            const secondsRemaining = seconds % 60;

            // Display the remaining time
            timerElement.textContent = `${minutesRemaining.toString().padStart(2, '0')}:${secondsRemaining.toString().padStart(2, '0')}`;

            if (seconds > 0) {
                seconds--;
                setTimeout(tick, 1000); // Call the function again after 1 second
            } else {
                // Time's up, submit the form
                document.getElementById('myForm').submit();
            }
        }

        // Start the countdown
        tick();
    }

    // Start the countdown with the PHP value
    window.onload = function () {
        startCountdown(<?php echo $countdownMinutes; ?>);
    };
</script>

</body>
</html>
