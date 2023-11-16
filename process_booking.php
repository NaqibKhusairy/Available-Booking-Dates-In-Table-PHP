<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookings_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strtoupper($_POST["name"]);
    $bookdate = $_POST["bookdate"];
    $pakage = $_POST["pakage"];
    if ($pakage == "Package 1") {
        $price = 100.00;
    } else if ($pakage == "Package 2") {
        $price = 150.00;
    } else if ($pakage == "Package 3") {
        $price = 200.00;
    } else if ($pakage == "Package 4") {
        $price = 180.00;
    } else if ($pakage == "Package 5") {
        $price = 220.00;
    } else if ($pakage == "Package 6") {
        $price = 250.00;
    }
    
    function generateRandomString($length = 12)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
        return $randomString;
    }

    $bookid = generateRandomString();
    
    $check_date_query = "SELECT * FROM bookings WHERE book_date = '$bookdate'";
    $result = $conn->query($check_date_query);

    if ($result && $result->num_rows > 0) {
        echo '<script>alert("Tarikh sudah ada dalam pangkalan data. Sila pilih tarikh lain."); window.history.back();</script>';
    } else {
        $sql = "INSERT INTO bookings (bookid, name, book_date, package, price) VALUES ('$bookid', '$name', '$bookdate', '$pakage', '$price')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Berjaya! Tempahan anda telah direkodkan."); window.location.href = "resultnewbook.php?bookid='.$bookid.'&name='.$name.'&bookdate='.$bookdate.'&package='.$pakage.'&price='.$price.'";</script>';
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>