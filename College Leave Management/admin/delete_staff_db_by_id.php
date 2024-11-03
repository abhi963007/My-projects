<?php
session_start();
$staff_id = $_SESSION['staff_id'];

// Create a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare SQL queries to delete related records
$sql1 = "DELETE FROM staff WHERE staff_id = ?";
$sql2 = "DELETE FROM login WHERE user_id = ?";
$sql3 = "DELETE FROM leave_statistics WHERE staff_id = ?";
$sql4 = "DELETE FROM leave_requests WHERE staff_id = ?";

// Prepare and bind statements
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s", $staff_id);

$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("s", $staff_id);

$stmt3 = $connection->prepare($sql3);
$stmt3->bind_param("s", $staff_id);

$stmt4 = $connection->prepare($sql4);
$stmt4->bind_param("s", $staff_id);

// Execute the queries
if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute() && $stmt4->execute()) {
    echo "<script>alert('Student and related records deleted successfully.');</script>";
} else {
    echo "<script>alert('Error deleting staff: " . $connection->error . "');</script>";
}

// Redirect after alert
echo "<script>window.location='search_staff_for_deletion.php';</script>";

// Close the connection
$stmt1->close();
$stmt2->close();
$stmt3->close();
stmt4->close();
$connection->close();
?>
