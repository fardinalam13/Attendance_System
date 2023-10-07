<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $classDate = $_POST["date"];
        $timestamp = strtotime($classDate);

        // Get the day of the week as a string
        $dayOfWeek = date("l", $timestamp);
        // echo $dayOfWeek;
        if($dayOfWeek!="Friday" && $dayOfWeek!="Saturday"){

        

        if (isset($_POST["attendance"])) {
            foreach ($_POST["attendance"] as $serialNumber) {
            $validateSql = "SELECT * FROM student WHERE serial = '$serialNumber'";
            $validateResult = $conn->query($validateSql);
            
            if ($validateResult->num_rows > 0) {
                $sql = "INSERT INTO attendance (student_serial, class_date, is_present) VALUES ('$serialNumber', '$classDate', 1)";
            
                if ($conn->query($sql) !== TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
            }
        } 
        echo "<script> alert('Attendance records have been saved')</script>";
        }
         else {
            echo "<script>alert('No attendance data submitted')</script>";
        }
    }
    else {
        echo "<script> alert('Cannot input data in friday or saturday')</script>";
    }
    }

?>



<!DOCTYPE html>
<head>
    <title>Student Attendance</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">

        <h2>IIT 3rd Batch <br>Student Attendance System</h2>
        <p>Select a specific date for saving student's attendance</p>
    </div>
    <form method="post" action="">
        <label>Date:</label>
        <input type="date" name="date" required><br><br>

        <table>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Present</th>
            </tr>
            <?php
            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $studentId = $row["id"];
                    $serialNumber = $row["serial"];
                    $studentName = $row["name"];
           ?>
            
                   <tr>
                            <td><?php echo "$studentId"; ?></td>
                            <td><?php echo "$studentName"; ?></td>
                            <td><input type='checkbox' name='attendance[]' value='<?php echo $serialNumber; ?>'></td>
                    </tr>
               <?php }
             } ?>

            
        </table>
        <br><br>
        <div style="display: flex;justify-content: space-between;">

     
        <input style="background-color: orange;padding: 10px; border: 0; cursor:pointer;" type="submit" name="submit" value="Submit">
        <a href="report.php" style="background-color: green;padding: 10px; border: 0; cursor:pointer;text-decoration:none; color:black; font:small" >Show Report</a>
        </div>
    </form>
    <br>

    <?php 
            $conn->close();
   ?>
</body>

</html>