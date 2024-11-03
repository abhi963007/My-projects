<?php
session_start();
if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id() || !isset($_SESSION['user']) || strtolower($_SESSION['user']) != "admin") {
    header("Location: ../index1.php");
    exit;
}

$pc_id = $_POST['pc_id'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$email_id = $_POST['email_id'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$password = $_POST['password'];

// Create a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare the update statement
$sql = "UPDATE program_coordinator SET first_name = ?, middle_name = ?, last_name = ?, email_id = ?, contact = ?, gender = ?";

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password
    $sql .= ", password = ?";
}

// Complete the SQL statement
$sql .= " WHERE pc_id = ?";
$stmt = $connection->prepare($sql);

// Bind parameters
if (!empty($password)) {
    $stmt->bind_param("sssssssi", $first_name, $middle_name, $last_name, $email_id, $contact, $gender, $hashed_password, $pc_id);
} else {
    $stmt->bind_param("ssssssi", $first_name, $middle_name, $last_name, $email_id, $contact, $gender, $pc_id);
}

$stmt->execute();
echo "<script>alert('Teacher updated successfully.');</script>";
echo "<script>window.location='view_pc.php';</script>";

// Close connections
$stmt->close();
$connection->close();
?>
