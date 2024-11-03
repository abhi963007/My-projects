<?php
session_start();

// Check if the user is logged in as Admin
if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id() || !isset($_SESSION['user']) || strtolower($_SESSION['user']) != "admin") {
    // Redirect to login page if the session is not valid
    header("Location: ../index1.php");
    exit;
}

// Create a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch the form data
$staff_id = $_POST['staff_id'];
$start_date = $_POST['start_date'];
$status = $_POST['approve_reject'];
$admin_approval = ($status == "Approved") ? 1 : 0; // This determines if Admin has approved or not

// Update the leave request with Admin's decision
$sql = "UPDATE leave_requests SET admin_approval = ?, leave_status = ? WHERE staff_id = ? AND start_date = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("isss", $admin_approval, $status, $staff_id, $start_date);
$stmt->execute();

// Check if Program Coordinator has already approved the leave
$sql_check = "SELECT pc_approval, admin_approval FROM leave_requests WHERE staff_id = ? AND start_date = ?";
$stmt_check = $connection->prepare($sql_check);
$stmt_check->bind_param("ss", $staff_id, $start_date);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$row = $result_check->fetch_assoc();

if ($row['pc_approval'] == 1 && $row['admin_approval'] == 1) {
    // Both approvals are granted, set the leave_status to Approved
    $sql_update = "UPDATE leave_requests SET leave_status = 'Approved' WHERE staff_id = ? AND start_date = ?";
    $stmt_update = $connection->prepare($sql_update);
    $stmt_update->bind_param("ss", $staff_id, $start_date);
    $stmt_update->execute();
} else if ($row['pc_approval'] == 0 || $row['admin_approval'] == 0) {
    // If either rejects, mark the leave as Rejected
    $sql_update = "UPDATE leave_requests SET leave_status = 'Rejected' WHERE staff_id = ? AND start_date = ?";
    $stmt_update = $connection->prepare($sql_update);
    $stmt_update->bind_param("ss", $staff_id, $start_date);
    $stmt_update->execute();
}

// Show a success message and redirect back to the leave request page
echo "<script>alert('View Leave Request');</script>";
echo "<script>window.location='view_leave_requests.php';</script>";

// Close connections
$stmt->close();
$stmt_check->close();
$stmt_update->close();
$connection->close();
?>
