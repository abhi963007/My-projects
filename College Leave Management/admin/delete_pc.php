<?php
session_start();
if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id() || !isset($_SESSION['user']) || strtolower($_SESSION['user']) != "admin") {
    header("Location: ../index1.php");
    exit;
}

$pc_id = $_GET['id'];

// Create a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare the delete statement
$sql = "DELETE FROM program_coordinator WHERE pc_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $pc_id);
$stmt->execute();

echo "<script>alert('Program Coordinator deleted successfully.');</script>";
echo "<script>window.location='view_pc.php';</script>";

// Close connections
$stmt->close();
$connection->close();
?>
