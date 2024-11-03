<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $token = bin2hex(random_bytes(50)); // Generate a secure random token

        // Store token in the database
        $expiry_time = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expires in 1 hour
        $insert_token_query = "INSERT INTO password_resets (email, token, expires_at) VALUES ('$email', '$token', '$expiry_time')";
        mysqli_query($conn, $insert_token_query);

        // Send the reset link via email
        $reset_link = "http://yourdomain.com/resetpassword.php?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Hi, \n\nClick the link below to reset your password: \n$reset_link \n\nIf you didn't request this, please ignore this email.";
        $headers = "From: noreply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            $_SESSION['message'] = "A password reset link has been sent to your email.";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to send email.";
            $_SESSION['msg_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "No account found with that email.";
        $_SESSION['msg_type'] = "error";
    }

    header("Location: forgotpassword.php");
}
?>
