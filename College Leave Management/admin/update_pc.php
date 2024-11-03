<?php
session_start();
if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id() || !isset($_SESSION['user']) || strtolower($_SESSION['user']) != "admin") {
    header("Location: ../index1.php");
    exit;
}

// Check if the 'id' is passed in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No Program Coordinator ID specified.";
    exit;
}

$pc_id = $_GET['id'];
$connection = new mysqli("localhost", "root", "", "leavesystemphp");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch existing details for the selected Program Coordinator
$sql = "SELECT * FROM program_coordinator WHERE pc_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $pc_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "No such Program Coordinator found.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Teacher</title>
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
    <h1>Update Teacher</h1>
    <form action="update_pc_db.php" method="POST">
        <input type="hidden" name="pc_id" value="<?php echo $row['pc_id']; ?>">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required>
        <label>Middle Name:</label>
        <input type="text" name="middle_name" value="<?php echo htmlspecialchars($row['middle_name']); ?>">
        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required>
        <label>Email ID:</label>
        <input type="email" name="email_id" value="<?php echo htmlspecialchars($row['email_id']); ?>" required>
        <label>Contact:</label>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($row['contact']); ?>" required>
        <label>Gender:</label>
        <select name="gender">
            <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        </select>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Leave empty to keep unchanged">
        <input type="submit" value="Update Teacher">
    </form>
</body>
</html>
<?php
$connection->close();
?>
