<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}
?>

<h1>Admin Dashboard</h1>

<!-- Manage Users -->
<a href="manage_users.php">Manage Users</a>

<!-- Manage Content -->
<a href="manage_content.php">Manage Content</a>

<!-- Logout -->
<a href="admin_logout.php">Logout</a>
