<?php
// Start session
session_start();
$staff_id = $_SESSION['staff_id'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$password = $_POST['password'];
$user_type = "Staff";

// Create a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare SQL queries
$sql1 = "UPDATE staff SET first_name = ?, middle_name = ?, last_name = ? WHERE staff_id = ?";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("sssi", $first_name, $middle_name, $last_name, $staff_id);

// Execute the first query
if ($stmt1->execute()) {
    // Prepare second SQL query
    $sql2 = "UPDATE login SET password = ?, user_type = ? WHERE user_id = ?";
    $stmt2 = $connection->prepare($sql2);
    $stmt2->bind_param("sss", $password, $user_type, $staff_id);

    // Execute the second query
    if ($stmt2->execute()) {
        echo "<script>alert(\"Staff Updated Successfully.\");</script>";
    } else {
        echo "<script>alert(\"Error updating login details: " . $connection->error . "\");</script>";
    }
} else {
    echo "<script>alert(\"Error updating staff details: " . $connection->error . "\");</script>";
}

// Redirect after alert
echo "<script>window.location=\"search_staff_for_updation.php\";</script>";

// Close the connection
$connection->close();
?>
