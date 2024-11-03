<?php
// Retrieve the leave type from the GET request
$leave_type = $_GET['leave_type'];

// Create a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare delete queries
$sql1 = "DELETE FROM leave_types WHERE leave_type = ?";
$sql2 = "DELETE FROM leave_requests WHERE leave_type = ?";
$sql3 = "DELETE FROM leave_statistics WHERE leave_type = ?";

// Prepare statements
$stmt1 = $connection->prepare($sql1);
$stmt2 = $connection->prepare($sql2);
$stmt3 = $connection->prepare($sql3);

// Bind parameters
$stmt1->bind_param("s", $leave_type);
$stmt2->bind_param("s", $leave_type);
$stmt3->bind_param("s", $leave_type);

// Execute the delete queries
if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute()) {
    echo "<script>alert('Leave Type deleted successfully.');</script>";
} else {
    echo "<script>alert('Error deleting leave type: ".$connection->error."');</script>";
}

// Redirect back to the delete page
echo "<script>window.location='delete_leave_type.php';</script>";

// Close statements and connection
$stmt1->close();
$stmt2->close();
$stmt3->close();
$connection->close();
?>
