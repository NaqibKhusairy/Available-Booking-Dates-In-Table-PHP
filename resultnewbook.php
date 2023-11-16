<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="icon" href="src/icon.png" type="image/png">
</head>
<body>
    <div class="container">
        <h1>Booking Details</h1>
        <div>
            <?php
            
            $bookid = $_GET['bookid'] ?? '';
            $name = $_GET['name'] ?? '';
            $bookdate = $_GET['bookdate'] ?? '';
            $package = $_GET['package'] ?? '';
            $price = $_GET['price'] ?? '';
            
            echo "<p><strong>Booking ID:</strong> $bookid</p>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Book Date:</strong> $bookdate</p>";
            echo "<p><strong>Package:</strong> $package</p>";
            echo "<p><strong>Price:</strong> RM $price</p>";
            ?>
        </div>
    </div>
</body>
</html>