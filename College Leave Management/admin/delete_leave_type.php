<?php 
session_start();
if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "leavesystemphp";

    // Create a connection using mysqli
    $connection = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // SQL query
    $sql = "SELECT * FROM leave_types";
    // Firing query
    $result = $connection->query($sql);

    if ($result === FALSE || $result->num_rows == 0) {
        echo "<script>
                alert(\"No leave types found!\" );
                window.location=\"#\";
              </script>";
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Delete Leave Type</title>
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
                <li><a class="greeting" href="#">Hi <?php echo $_SESSION['user']; ?></a></li>
            </ul>
        </div>
    </div>
    <?php $page = 'delete_leave'; include 'sidebar.php'; ?>
    <div id="content_panel">
        <div id="heading">Delete Leave Type
            <hr size="2" color="#FFFFFF" ice:repeating=""/>
        </div>
        <div id="table">
            <table border="1" bgcolor="#006699">
                <tr>
                    <th width="210px">Leave Type</th>
                    <th width="130px">Number of Leaves</th>
                    <th width="100px">Action</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td width="210px"><?php echo $row['leave_type']; ?></td>
                    <td width="130px"><?php echo $row['no_of_days']; ?></td>
                    <td width="100px">
                        <a href='delete_leave_type_db.php?leave_type=<?php echo urlencode($row['leave_type']); ?>' style='text-decoration:none; color: #a90000;'>
                            <img src="../images/trash.gif" />Delete
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div id="footer">
    </div>
</div>
</body>
</html>
<?php
    // Close the connection
    $connection->close();
} else {
    header("Location: ../index1.php");
}
?>
