<?php
session_start();
if (!isset($_SESSION['sid']) || $_SESSION['sid'] != session_id() || !isset($_SESSION['user']) || strtolower($_SESSION['user']) != "admin") {
    header("Location: ../index1.php");
    exit;
}

$connection = new mysqli("localhost", "root", "", "leavesystemphp");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT * FROM program_coordinator";
$result = $connection->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Program Coordinator to Update</title>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Select Teacher to Update</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Select</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['pc_id'] . "</td>";
            echo "<td>" . htmlspecialchars($row['first_name'] . " " . $row['last_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
            echo "<td><a href='update_pc.php?id=" . $row['pc_id'] . "'>Select</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$connection->close();
?>
