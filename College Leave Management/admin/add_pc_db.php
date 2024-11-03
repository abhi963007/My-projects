<?php
session_start();
if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id() || !isset($_SESSION['user']) || strtolower($_SESSION['user']) != "admin") {
    header("Location: ../index1.php");
    exit;
}

$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$email_id = $_POST['email_id'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$password = $_POST['password']; // Store the plain text password

$connection = new mysqli("localhost", "root", "", "leavesystemphp");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Insert into program_coordinator table
$sql = "INSERT INTO program_coordinator (first_name, middle_name, last_name, email_id, contact, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("sssssss", $first_name, $middle_name, $last_name, $email_id, $contact, $gender, $password);
$stmt->execute();

// Insert into login table (for Program Coordinator login)
$sql_login = "INSERT INTO login (user_id, password, user_type) VALUES (?, ?, 'PC')";
$stmt_login = $connection->prepare($sql_login);
$stmt_login->bind_param("ss", $email_id, $password);
$stmt_login->execute();

echo "<script>alert('Program Coordinator added successfully.');</script>";
echo "<script>window.location='view_pc.php';</script>";

$stmt->close();
$stmt_login->close();
$connection->close();
?>
