<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Booked Dates</title>
        <link rel="stylesheet" href="css/styles2.css">
        <link rel="icon" href="src/icon.png" type="image/png">
        <script>
            
            function showBookingDetails(date, name, package,bookid) {
                alert("Date: " + date + "\nBook ID: " + bookid + "\nName: " + name + "\nPackage: " + package);
            }
        </script>
    </head>
    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bookings_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        function getBookedDates($conn)
        {
            $bookedDates = array();

            $sql = "SELECT book_date, name, package, bookid FROM bookings";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bookedDates[$row['book_date']] = array('name' => $row['name'], 'package' => $row['package'], 'bookid' => $row['bookid']);
                }
            }

            return $bookedDates;
        }

        $currentMonth = isset($_GET['month']) ? $_GET['month'] : date("n");
        $currentYear = isset($_GET['year']) ? $_GET['year'] : date("Y");

        $bookedDates = getBookedDates($conn);
        ?>

        <h1>Booked Dates</h1>
        <h2><?php echo date("F - Y", strtotime($currentYear . '-' . $currentMonth . '-01')); ?></h2>
        <div>
            <button onclick="showPreviousMonth()">Previous</button>
            <button onclick="showNextMonth()">Next</button>
        </div>
        <table border="1">
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            <?php
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
            $firstDay = date("N", mktime(0, 0, 0, $currentMonth, 1, $currentYear));
            $lastDay = date("N", mktime(0, 0, 0, $currentMonth, $daysInMonth, $currentYear));

            $calendarDays = ($firstDay == 7) ? ($daysInMonth + 1) : ($daysInMonth + $firstDay);
            $calendarDays += (7 - $lastDay);

            for ($i = 1; $i <= $calendarDays; $i++) {
                if ($i < $firstDay || $i > ($daysInMonth + $firstDay - 1)) {
                    echo "<td></td>";
                } else {
                    $currentDay = $i - $firstDay + 1;
                    $currentDate = $currentYear . '-' . $currentMonth . '-' . $currentDay;
                    $class = isset($bookedDates[$currentDate]) ? 'booked' : '';

                    echo "<td class='$class' onclick=\"showBookingDetails('$currentDate', '" . ($bookedDates[$currentDate]['name'] ?? '') . "', '" . ($bookedDates[$currentDate]['package'] ?? '') .  "', '" . ($bookedDates[$currentDate]['bookid'] ?? '') . "')\">$currentDay<br></td>";
                }

                if ($i % 7 == 0) {
                    echo "</tr><tr>";
                }
            }
            ?>
        </table>
        <script>
            
            function showPreviousMonth() {
                window.location.href = '?month=<?php echo date("n", strtotime("-1 month", strtotime($currentYear . '-' . $currentMonth . '-01'))); ?>&year=<?php echo date("Y", strtotime("-1 month", strtotime($currentYear . '-' . $currentMonth . '-01'))); ?>';
            }
            
            function showNextMonth() {
                window.location.href = '?month=<?php echo date("n", strtotime("+1 month", strtotime($currentYear . '-' . $currentMonth . '-01'))); ?>&year=<?php echo date("Y", strtotime("+1 month", strtotime($currentYear . '-' . $currentMonth . '-01'))); ?>';
            }
        </script>
        <?php $conn->close(); ?>
    </body>
</html>