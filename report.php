<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<html>
<head>
    <title>Attendance Report</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="post" action="">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>

        <input style="background-color: orange;padding: 10px; border: 0; cursor:pointer;"  type="submit" name="generate_report" value="Show Attendants">
    </form>

    <h2>Attendance Report</h2>
    <table border="1">
        <tr>
            <th>Student ID</th>
            <th>Total Present Days</th>
            <th>Number of Class Held</th>
            <th>Attendance Percentage</th>
            <th>Obtain Mark</th>
        </tr>
        <?php
        if (isset($_POST['generate_report'])) {
            $startDate = new DateTime($_POST['start_date']);
            $endDate = new DateTime($_POST['end_date']);

            // Format dates as strings
            $startDateStr = $startDate->format('Y-m-d');
            $endDateStr = $endDate->format('Y-m-d');

            // Calculate the total number of distinct class dates within the date range
            $sql = "SELECT COUNT(DISTINCT class_date) AS total_class_days
                    FROM attendance
                    WHERE class_date BETWEEN '$startDateStr' AND '$endDateStr'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalDays = $row["total_class_days"];
            } else {
                $totalDays = 0;
            }

            $sql = "SELECT DISTINCT class_date
                    FROM attendance
                    WHERE class_date BETWEEN '$startDateStr' AND '$endDateStr'";

            $distinctDatesResult = $conn->query($sql);
            $distinctDates = array();

            while ($dateRow = $distinctDatesResult->fetch_assoc()) {
                $distinctDates[] = $dateRow['class_date'];
            }
            $distinctDatesString = implode(', ', $distinctDates);

            // Now, retrieve and display the attendance data
            $sql = "SELECT student.id AS student_id, 
                    COUNT(DISTINCT attendance.class_date) AS total_present_days
                    FROM student
                    LEFT JOIN attendance ON student.serial = attendance.student_serial
                    WHERE attendance.class_date BETWEEN '$startDateStr' AND '$endDateStr'
                    GROUP BY student.serial";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row["attendance_percentage"] = ($row["total_present_days"] / $totalDays) * 100;
                    $row["attendance_mark"] = ($row["attendance_percentage"] / 100) * 5;
                    echo "<tr>";
                    echo "<td>" . $row["student_id"] . "</td>";
                    echo "<td>" . $row["total_present_days"] . "</td>";
                    echo "<td>" . $totalDays . "</td>";
                    echo "<td>" . $row["attendance_percentage"] . "%" . "</td>";
                    echo "<td>" . $row["attendance_mark"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "No attendance data available for the selected date.";
            }
        }
        if (isset($_POST['start_date'])) {
            # code...
            // echo "Showing attendance report from " .$startDateStr." to " .$endDateStr. '';
            echo '<h2 class="message">' . $startDateStr . ' to ' . $endDateStr . '</h2>';
            echo '<h2 class="message"> Class held on these days:   </h2>';
            echo '<h2 class="message">' .  $distinctDatesString.   '</h2>';
        
        }
      
        ?>
    </table>
</body>
</html>
