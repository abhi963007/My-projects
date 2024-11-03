<?php
session_start();
if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id() || !isset($_SESSION['user']) || strtolower($_SESSION['user']) != "admin") {
    header("Location: ../index1.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Program Coordinator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Add Teachers</h1>
    <form action="add_pc_db.php" method="POST">
        <label>First Name:</label>
        <input type="text" name="first_name" required>
        <label>Middle Name:</label>
        <input type="text" name="middle_name">
        <label>Last Name:</label>
        <input type="text" name="last_name" required>
        <label>Email ID:</label>
        <input type="email" name="email_id" required>
        <label>Contact:</label>
        <input type="text" name="contact" required>
        <label>Gender:</label>
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Add Teacher">
    </form>
</body>
</html>
