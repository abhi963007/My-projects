<?php
session_start();
if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "Staff") {	
    $staff_id = $_SESSION['staff_id'];

    // Create a MySQLi connection
    $connection = new mysqli("localhost", "root", "", "leavesystemphp");

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare and execute the SQL statement
    $sql = "SELECT * FROM leave_requests WHERE staff_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "<script>
                alert(\"No Leave History to Show!\");
                window.location=\"index.php\";</script>";
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Leave History</title>
<style type="text/css">
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
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
                <li><a class="greeting" href="#">Hi Student</a></li>
            </ul>
        </div>
    </div>
    <div id="content_panel">
        <div id="heading">Leave History<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
        <div id="table">
            <span>
                <table border="1" bgcolor="#006699" >
                    <tr>
                        <th width="190px">Leave Type</th>
                        <th width="90px;">Start Date</th>
                        <th width="90px">End Date</th>
                        <th width="90px">No. of Days</th>
                        <th width="100px">Applied Date</th>
                        <th width="120px">Status</th>
                    </tr>
                </table>
            </span>
            <?php
            while ($row = $result->fetch_assoc()) {
                $leave_type = $row['leave_type'];
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
                $no_of_days = $row['days_requested'];
                $date_applied = $row['date_applied'];
                $status = $row['leave_status'];

                echo "<table border=\"1\">
                        <tr>
                            <td width=\"190px\">".$leave_type."</td>
                            <td width=\"90px\">".$start_date."</td>
                            <td width=\"90px\">".$end_date."</td>
                            <td width=\"90px\">".$no_of_days."</td>
                            <td width=\"100px\">".$date_applied."</td>
                            <td width=\"120px\">".$status."</td>
                        </tr>
                    </table>";
            }
            ?>
        </table>
    </div>
    </div>
    <?php $page = 'view_leave_history'; include 'sidebar.php'; ?>
    <div id="footer">
    </div>
</div>
</body>
</html>
<?php
    // Close the prepared statement and connection
    $stmt->close();
    $connection->close();
} else {
    header("Location: ../index1.php");
}
?>
