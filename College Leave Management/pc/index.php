<?php
session_start();
if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC") {
    $pc_id = $_SESSION['pc_id'];

    // Using MySQLi for database connection
    $connection = new mysqli("localhost", "root", "", "leavesystemphp");

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM leave_requests WHERE leave_status = 'Pending'";
    $sql2 = "SELECT * FROM staff WHERE staff_id = '$pc_id'";

    // Execute queries
    $result = $connection->query($sql);
    $result1 = $connection->query($sql2);

    // Fetch PC details
    $row1 = $result1->fetch_assoc();
    if ($row1) {
        $first_name = $row1['first_name'];
        $middle_name = $row1['middle_name'];
        $last_name = $row1['last_name'];
    } else {
        $first_name = "N/A";
        $middle_name = "N/A";
        $last_name = "N/A";
    }

    if ($result->num_rows == 0) {
        echo "<script>
                alert('No Leave Requests to Show!');
                window.location='index.php';
              </script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Program Coordinator Dashboard</title>
    <style type="text/css">
        body {
            margin: 0;
            background-image: url(../images/bg.gif);
        }
    </style>
    <link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
        <div id="title">Leave Management System</div>
        <div id="quick_links">
            <ul>
                <li><a class="home" href="index.php">Home</a></li>
                <li>|</li>
                <li><a class="logout" href="../logout.php">Logout</a></li>
                <li>|</li>
                <li><a class="greeting" href="#">Hi <?php echo htmlspecialchars($first_name . " " . $last_name); ?></a></li>
            </ul>
        </div>
    </div>
    <div id="content_panel">
        <div id="heading">Leave Requests Details<hr size="2" color="#FFFFFF"/></div>
        <form action="leave_history_pc.php" method="post">
            <div id="table">
                <table border="1" bgcolor="#006699">
                    <tr>
                        <th>Student ID</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>No. of Days</th>
                        <th>Date Applied</th>
                        <th>Approve/Reject</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $staff_id = $row['staff_id'];
                        $leave_type = $row['leave_type'];
                        $start_date = $row['start_date'];
                        $no_of_days = $row['days_requested'];
                        $date_applied = $row['date_applied'];
                        echo "<tr>
                                <td><a href='staff_profile.php?staff_id=".$staff_id."' style='color: #a90000;'>".$staff_id."</a></td>
                                <td>".$leave_type."</td>
                                <td>".$start_date."</td>
                                <td>".$no_of_days."</td>
                                <td>".$date_applied."</td>
                                <td><a href='approve_reject_leave.php?staff_id=".$staff_id."&start_date=".$start_date."' style='color: #a90000;'><img src='../images/edit_find_replace.png' />Details</a></td>
                              </tr>";
                    }
                    ?>
                </table>
            </div>
        </form>
    </div>
    <?php include 'sidebar.php'; ?>
    <div id="footer">
        <p><br />&copy; MCA <?php echo date("Y"); ?> Leave Management System</p>
    </div>
</div>
</body>
</html>
<?php
    $connection->close();
} else {
    header("Location: ../index1.php");
}
?>
