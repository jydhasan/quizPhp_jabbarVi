<?php
session_start();
// Check if the 'phone' session variable is set
    $phone = $_SESSION['phone'];
// Include database connection
require "dbconn.php";
// Check if the database connection is successful
if (!$db_conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
// Fetch data from questionlist
$query = "SELECT * FROM questionlist INNER JOIN students ON questionlist.qstart='1' AND students.phone=?";
$stmt = mysqli_prepare($db_conn, $query);

// Bind the parameter
mysqli_stmt_bind_param($stmt, "s", $phone);

// Execute the query
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);
// fetch data from books table 
$query2 = "SELECT * FROM books";
$result2 = mysqli_query($db_conn, $query2);

// Check if the query was successful
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="exam-room">';
        echo '<a href="app/quiz.php?qtablename=' . urlencode($row['qtablename']) . '">';
        // echo urlencode($row['qtablename']);
        echo 'Go to Exam Room';
        echo '</a>';
        echo '</div>';
    }
} else {
    echo "Query failed: " . mysqli_error($db_conn);
}

// Close the statement and database connection
// mysqli_stmt_close($stmt);
// mysqli_close($db_conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" href="static/css/index.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <ul style="margin-bottom: 0px;">
        <li class="tlogo">varsity target</li>
        <ul>
            <!-- <li>Admin</li> -->
            <!-- <li><i class="fa fa-user-plus" style="color:rgb(255, 255, 255)"></i>Login</li> -->
            <li><a href="app/login.php" class="fa fa-user-plus" style="color:rgb(255, 255, 255)"></a>Login
            </li>
        </ul>
    </ul>
    <!-- zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz -->
    <div class="main-header" style="background-color: #ff9393;">
        <!-- <img src="hasan.jpg" alt=""> -->
        <div class="slider">
            <img src="static/media/image1.jpg">
            <img src="static/media/image2.jpg">
            <img src="static/media/image3.jpg">
            <!-- ... -->
        </div>
        <!-- zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz -->
    </div>
    <div class="socialMedia">
        <a href="https://www.facebook.com/varsitytarget/" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="https://www.youtube.com/@varsitytarget" class="fa fa-youtube"></a>
    </div>


    
    <?php while ($row = mysqli_fetch_array($result)): ?>
    <div class="exam-room">
    <a href="app/quiz.php?qtablename=<?php echo urlencode($row['qtablename']); ?>">
    <?php echo urlencode($row['qtablename']); ?>
    </a>
    </div>
    <?php endwhile; ?>




    <div class="livehead" style="background-color: #f2f2f2;">
<?php
$query = "SELECT * FROM notice ORDER BY id DESC LIMIT 1";
$result = mysqli_query($db_conn, $query);
while ($row = mysqli_fetch_array($result)) {
    // echo "<h1>Notice : " . $row['notice'] . "</h1>";
    echo "<marquee behavior='' direction=''>Notice : " . $row['notice'] . "</marquee>";
    
}
?>
<!-- <marquee behavior="" direction="">{{rows}}</marquee> -->
        
    </div>
    <br>
    </div>
    </div>
    </div>


    <div class="prduct-main">
    <?php while ($row = mysqli_fetch_array($result2)): ?>
        <div class="product-card">
            <img class="product-image" src="uploads/<?php echo $row['image']; ?>" alt="Product Image">
            <div class="product-title"><?php echo $row['title']; ?></div>
            <hr>
            <!-- <div class="product-title"><?php echo $row['image']; ?></div> -->
            <div class="product-price">&#2547; &nbsp;<?php echo $row['price']; ?></div>
            <a href="app/bookDetails.php?bookid=<?php echo urlencode($row['id']); ?>">Details</a>
        </div>
    <?php endwhile; ?>
    </div>

<br>

    <div class="zfooter" style="background-color: #f2f2f2;">
        <div class="zfooter1" style="padding: 10px;">
            <h1>Admin </h1>
            <a href="app/admin.php">Admin</a>
            <h4>OR</h4>
        <!-- Add this link/button anywhere in your HTML form -->
<a href="app/logout.php">Logout</a>

        </div>
        <div class="zfooter1" style="padding: 10px;">
            <h1>About us</h1>
            <p style="text-align: justify;">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam perferendis autem commodi
                consectetur.
                At natus quidem nisi possimus corrupti aliquam alias tempore dicta tenetur veniam tempora, officiis,
                rem
                quos. Accusamus?
            </p>
        </div>
        <div class="zfooter1" style="padding: 10px;">
            <h1>Contact Us</h1>
            <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam
                doloribus qui ratione. Obcaecati,
                quo
                facere blanditiis est id architecto soluta veniam iusto accusamus harum modi quae et maiores
                consectetur
                possimus. </p>
        </div>
    </div>
    <div class="zcopywrite" style="background-color: black; display: flex;justify-content: center;">
        <p style="color:aliceblue;">&copy; 2023 .</p>
        <p style="color:aliceblue">Designed by <a href="https://github.com/jydhasan">jydhasan</a></p>
    </div>
    </div>
</body>

</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($db_conn);
?>