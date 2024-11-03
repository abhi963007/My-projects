<?php
session_start();
if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "Staff") {
    $staff_id = $_SESSION['staff_id'];
    
    // Establishing a connection using MySQLi
    $connection = @mysqli_connect("localhost", "root", "", "leavesystemphp") or die(mysqli_connect_error());
    
    // Sql query
    $sql1 = "SELECT * FROM staff WHERE staff_id = '".$staff_id."'";
    $sql2 = "SELECT * FROM leave_statistics WHERE staff_id = '".$staff_id."'";
    
    // Firing query
    $result1 = mysqli_query($connection, $sql1);
    $result2 = mysqli_query($connection, $sql2);
    
    // Fetching staff details
    $first_name = $middle_name = $last_name = "";
    while ($row1 = mysqli_fetch_array($result1)) {
        $first_name = $row1['first_name'];
        $middle_name = $row1['middle_name'];
        $last_name = $row1['last_name'];
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Student Profile</title>
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
                <li><a class="greeting" href="#">Hi Student</a></li>
            </ul>
        </div>
    </div>
    <div id="content_panel">
        <div id="heading">Home<hr size="2" color="#FFFFFF" /></div>
        <div id="form">
            <form method="post" action="approve_reject_db.php">
                <fieldset>
                    <legend>Personal Information</legend>
                    <label for="staff_id"><span>Student ID </span>
                        <input type="text" name="staff_id" id="staff_id" readonly="true" value="<?php echo $staff_id ?>" style="background-color:#F6F6F6; color:#a90000" />
                    </label>
                    <label for="staff_name"><span>Student Name </span>
                        <input type="text" readonly="true" value="<?php echo $first_name . " " . $middle_name . " " . $last_name ?>" style="background-color:#F6F6F6; color:#a90000" />
                    </label>
                </fieldset>
                <br />
                <fieldset>
                    <legend>Current Leave Balances</legend>
                    <div id="table">
                        <span>
                            <table border="1" bgcolor="#006699">
                                <tr>
                                    <th width="190px">Leave Types</th>
                                    <th width="180px">Maximum Allowed Leaves</th>
                                    <th width="120px">Leaves Taken</th>
                                    <th width="150px">Remaining Leaves</th>
                                </tr>
                            </table>
                        </span>
                        <?php
                        while ($row2 = mysqli_fetch_array($result2)) {
                            $leave_type = $row2['leave_type'];
                            $maximum_leaves = $row2['maximum_leaves'];
                            $leaves_taken = $row2['leaves_taken'];
                            $remaining_leaves = $maximum_leaves - $leaves_taken;
                            echo "<table border=\"1\">
                                    <tr>
                                        <td width=\"190px\">".$leave_type."</td>
                                        <td width=\"180px\">".$maximum_leaves."</td>
                                        <td width=\"120px\">".$leaves_taken."</td>
                                        <td width=\"150px\">".$remaining_leaves."</td>
                                    </tr>
                                  </table>";
                        }
                        ?>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php include 'sidebar.php' ?>
    <div id="footer">
        <p><br />&copy;    MCA   <?php echo date("Y"); ?> Leave Management System</p>
    </div>
</div>
</body>
</html>
<?php
    // Closing the connection
    mysqli_close($connection);
} else {
    header("Location: ../index1.php");
}
?>
