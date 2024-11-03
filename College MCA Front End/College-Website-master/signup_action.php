<?php
session_start();
include('db_connection.php'); // A file to connect to your database

// Fetch user input
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

// Check if the username or email already exists
$query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['message'] = "Username or Email already exists!";
    $_SESSION['msg_type'] = "error";
    header("Location: signup.php");
} else {
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $insert_query = "INSERT INTO users (name, username, email, password, user_type) 
                     VALUES ('$name', '$username', '$email', '$hashed_password', '$user_type')";

    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['message'] = "Signup successful! You can now log in.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
        $_SESSION['msg_type'] = "error";
    }

    header("Location: signup.php");
}
?>
