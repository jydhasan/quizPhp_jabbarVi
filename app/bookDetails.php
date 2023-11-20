
<?php
require "../dbconn.php";
// bookDetails.php
    // Retrieve and decode the 'bookid' parameter
    $bookId = urldecode($_GET['bookid']);
    // Now, $bookId contains the value of the 'bookid' parameter
    echo "Book ID: $bookId";
    // Fetch data from books table
    $query = "SELECT * FROM books WHERE id='$bookId'";
    $result = mysqli_query($db_conn, $query);
    // Check if the query was successful
?>
<!DOCTYPE html>
<html>

<head>
    <title>Book Details</title>
    <link rel="stylesheet" href="../static/css/bookDetails.css">
</head>

<body>
    <br><br><br>
    <div class="product-card">
        <?php while ($row = mysqli_fetch_array($result)): ?>
           <div class="pimage"> <img class="product-image" src="../uploads/<?php echo $row['image']; ?>" alt="Product Image">
        </div>
        <div class="pdetails">
        <p><?php echo $row['description']; ?></p>
            <!-- <div class="product-title"><?php echo $row['image']; ?></div> -->
            <div class="product-price">Price :&#2547; &nbsp;<?php echo $row['price']; ?></div>
            <p><strong>Order number -:</strong> 01713905601</p>
            <a href="../uploads/<?php echo $row['file']; ?>">Read some page </a>
        </div>
          
        </div>
    <?php endwhile; ?>
    </div>
    <br><br><br>
</body>

</html>