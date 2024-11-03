<?php
session_start();

// Get POST data and sanitize it
$staff_id = $_SESSION['staff_id'];
$leave_duration = $_POST['leave_duration'];
$leave_type = $_POST['leave_type'];
$leave_date = $_POST['leave_date'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$no_of_days = intval($_POST['days_requested']); // Ensure it's an integer
$status = "Pending";

// Create a connection to the database
$connection = mysqli_connect("localhost", "root", "", "leavesystemphp");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch leave statistics for the staff member
$sql4 = "SELECT * FROM leave_statistics WHERE staff_id = '".$staff_id."' AND leave_type = '".$leave_type."'";
$result4 = mysqli_query($connection, $sql4) or die(mysqli_error($connection));
$row4 = mysqli_fetch_assoc($result4);

if ($row4) {
    // Ensure values are treated as integers
    $maximum_leaves = intval($row4['maximum_leaves']);
    $leaves_taken = intval($row4['leaves_taken']); // Ensure it's an integer

    $new = $leaves_taken + $no_of_days;
    $balance_leaves = $maximum_leaves - $leaves_taken;

    if ($no_of_days > $maximum_leaves) {
        echo "<script>
                alert('Maximum ".$maximum_leaves." Days Allowed.');
                window.location='apply_leave.php';</script>";
        exit;
    }

    if ($new > $maximum_leaves) {
        echo "<script>
                alert('You have already taken " .$leaves_taken." leaves, Now you can only request for ".$balance_leaves." days');
                window.location='apply_leave.php';</script>";
        exit;
    } else {
        // Handle one-day leave requests
        if ($leave_duration == "one_day") {
            $sql = "SELECT * FROM leave_requests WHERE start_date = '".$leave_date."' AND end_date = '".$leave_date."' AND staff_id = '".$staff_id."'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            
            if (mysqli_num_rows($result) == 0) {
                // Insert leave request
                $sql3 = "INSERT INTO leave_requests (staff_id, leave_type, start_date, end_date, days_requested, date_applied, leave_status) VALUES ('".$staff_id."', '".$leave_type."', '".$leave_date."', '".$leave_date."', '1', '".date("Y-m-d")."', '".$status."')";
                mysqli_query($connection, $sql3) or die(mysqli_error($connection));
                echo "<script>
                        alert('Leave Request Submitted.');
                        window.location='apply_leave.php';</script>";
                exit;
            } else {
                echo "<script>
                        alert('You have already taken a leave for this day.');
                        window.location='apply_leave.php';</script>";
                exit;
            }
        }
        // Handle multiple-day leave requests
        else if ($leave_duration == "multiple_days") {
            $sql1 = "SELECT start_date, end_date FROM leave_requests WHERE '".$start_date."' BETWEEN start_date AND end_date AND staff_id = '".$staff_id."'";
            $sql2 = "SELECT start_date, end_date FROM leave_requests WHERE '".$end_date."' BETWEEN start_date AND end_date AND staff_id = '".$staff_id."'";

            $result1 = mysqli_query($connection, $sql1) or die(mysqli_error($connection));
            $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));

            if (mysqli_num_rows($result1) == 0 && mysqli_num_rows($result2) == 0) {
                // Insert leave request
                $sql3 = "INSERT INTO leave_requests (staff_id, leave_type, start_date, end_date, days_requested, date_applied, leave_status) VALUES ('".$staff_id."', '".$leave_type."', '".$start_date."', '".$end_date."', '".$no_of_days."', '".date("Y-m-d")."', '".$status."')";
                mysqli_query($connection, $sql3) or die(mysqli_error($connection));
                echo "<script>
                        alert('Leave Request Submitted.');
                        window.location='apply_leave.php';</script>";
                exit;
            } else {
                echo "<script>
                        alert('You have already taken a leave for these days.');
                        window.location='apply_leave.php';</script>";
                exit;
            }
        }
    }
} else {
    echo "<script>
            alert('Leave statistics not found.');
            window.location='apply_leave.php';</script>";
    exit;
}

// Close the database connection
mysqli_close($connection);
?>
