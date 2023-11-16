<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS bookings_db";
if ($conn->query($sqlCreateDB) === TRUE) {
    
    $conn->select_db("bookings_db");
    
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS bookings (
        bookid VARCHAR(200) PRIMARY KEY,
        name VARCHAR(200) NOT NULL,
        book_date DATE NOT NULL,
        package VARCHAR(200) NOT NULL,
        price DECIMAL(10, 2) NOT NULL
    )";
    if ($conn->query($sqlCreateTable) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>New Booking</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="icon" href="src/icon.png" type="image/png">
    </head>
    <body>
        <div class="container">
            <h1>New Booking</h1>
            <form action="process_booking.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="bookdate">Book Date:</label>
                <input type="date" id="bookdate" name="bookdate" required><br>

                <label for="pakage">Package for Booking:</label>
                <select id="pakage" name="pakage" required>
                    <option value="Package 1">Package 1 (RM 100.00)</option>
                    <option value="Package 2">Package 2 (RM 150.00)</option>
                    <option value="Package 3">Package 3 (RM 200.00)</option>
                    <option value="Package 4">Package 4 (RM 180.00)</option>
                    <option value="Package 5">Package 5 (RM 220.00)</option>
                    <option value="Package 6">Package 6 (RM 250.00)</option>
                </select><br>

                <input type="submit" value="Submit">
            </form>
        </div>
</body>
</html>