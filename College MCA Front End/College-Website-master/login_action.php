<?php
session_start();
include('db_connection.php'); // A file to connect to your database

// Fetch user input
$username = $_POST['username'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

// Query to check if user exists in the database
$query = "SELECT * FROM users WHERE username='$username' AND user_type='$user_type'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Verify the password
    if (password_verify($password, $user['password'])) {
        $_SESSION['message'] = "Login successful!";
        $_SESSION['msg_type'] = "success";
        // Redirect to the dashboard or home page
        header("Location: index.html");
    } else {
        $_SESSION['message'] = "Invalid password!";
        $_SESSION['msg_type'] = "error";
        header("Location: login.php");
    }
} else {
    $_SESSION['message'] = "User not found!";
    $_SESSION['msg_type'] = "error";
    header("Location: login.php");
}
?>
