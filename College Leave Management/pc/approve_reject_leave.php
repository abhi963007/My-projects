<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC") {
    $pc_id = $_SESSION['pc_id'];
    $staff_id = $_GET['staff_id'];
    $start_date = $_GET['start_date'];

    // Create a connection using mysqli
    $connection = new mysqli("localhost", "root", "", "leavesystemphp");

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare and execute the first SQL statement
    $sql1 = "SELECT * FROM leave_requests WHERE staff_id = ? AND start_date = ?";
    $stmt1 = $connection->prepare($sql1);
    $stmt1->bind_param("ss", $staff_id, $start_date);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    // Prepare and execute the second SQL statement
    $sql2 = "SELECT first_name, middle_name, last_name FROM staff WHERE staff_id = ?";
    $stmt2 = $connection->prepare($sql2);
    $stmt2->bind_param("s", $staff_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $no_of_rows = $result1->num_rows;

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>View Leave History</title>
        <style type="text/css">
            body {
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
        <div id="content_panel">
            <div id="heading">Leave Requests Details<hr size="2" color="#FFFFFF"/></div>
            <?php
            while ($row = $result1->fetch_assoc()) {
                $staff_id = $row['staff_id'];
                $leave_type = $row['leave_type'];
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
                $no_of_days = $row['days_requested'];
                $date_applied = $row['date_applied'];
                $status = $row['leave_status'];
                $pc_approval = $row['pc_approval'];
                $admin_approval = $row['admin_approval'];
            }

            while ($row1 = $result2->fetch_assoc()) {
                $first_name = $row1['first_name'];
                $middle_name = $row1['middle_name'];
                $last_name = $row1['last_name'];
            }
            ?>
            <div id="form">
                <form method="post" action="approve_reject_db.php">
                    <fieldset>
                        <legend>General Information</legend>
                        <label for="staff_id"><span>Staff ID </span>
                            <input type="text" name="staff_id" id="staff_id" readonly="true" value="<?php echo htmlspecialchars($staff_id); ?>" style="background-color:#F6F6F6; color:#a90000" />
                        </label>
                        <label for="staff_name"><span>Staff Name </span>
                            <input type="text" readonly="true" value="<?php echo htmlspecialchars($first_name . " " . $middle_name . " " . $last_name); ?>" style="background-color:#F6F6F6; color:#a90000" />
                        </label>
                    </fieldset>
                    <br />
                    <fieldset>
                        <legend>Leave Information</legend>
                        <label for="leave_type"><span>Leave Type </span>
                            <input type="text" name="leave_type" id="leave_type" readonly="true" value="<?php echo htmlspecialchars($leave_type); ?>" style="background-color:#F6F6F6; color:#a90000" />
                        </label>
                        <label for="date_applied"><span>Leave Applied on </span>
                            <input type="text" name="date_applied_on" id="date_applied_on" readonly="true" value="<?php echo htmlspecialchars($date_applied); ?>" style="background-color:#F6F6F6; color:#a90000" />
                        </label>
                        <label for="leave_date"><span>Leave Date </span>
                            <input type="text" name="start_date" id="start_date" readonly="true" value="<?php echo htmlspecialchars($start_date); ?>" style="background-color:#F6F6F6; color:#a90000" /> &ndash; 
                            <input type="text" name="end_date" id="end_date" readonly="true" value="<?php echo htmlspecialchars($end_date); ?>" style="background-color:#F6F6F6; color:#a90000" />
                            <input type="text" name="no_of_days" id="no_of_days" readonly="true" value="<?php echo htmlspecialchars($no_of_days); ?> Day(s)" style="background-color:#F6F6F6; color:#a90000; width:80px; margin-left:10px;" />
                        </label>
                    </fieldset>

                    <br />

                    <fieldset>
                        <legend>Approve/Reject Leave</legend>
                        <label for="pc_approval_status"><span>Teacher Approval </span>
                            <input type="text" readonly="true" value="<?php echo $pc_approval == 1 ? 'Approved' : 'Pending'; ?>" style="background-color:#F6F6F6; color:#a90000"/> 
                        </label>
                        <label for="admin_approval_status"><span>Admin Approval </span>
                            <input type="text" readonly="true" value="<?php echo $admin_approval == 1 ? 'Approved' : 'Pending'; ?>" style="background-color:#F6F6F6; color:#a90000"/> 
                        </label>
                        <label for="approve_reject"><span>Approve / Reject </span>
                            <select name="approve_reject" id="approve_reject">
                                <option value="Approved">Approve</option>
                                <option value="Rejected">Reject</option>
                            </select>
                        </label>
                        <input type="hidden" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                        <input type="hidden" name="staff_id" value="<?php echo htmlspecialchars($staff_id); ?>">
                        <label>
                            <input type="submit" value="Submit" />
                        </label>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php $page = 'view_leave_request'; include 'sidebar.php'; ?>
        <div id="footer">
        </div>
    </div>
    </body>
    </html>
    <?php
    $stmt1->close();
    $stmt2->close();
    $connection->close();
} else {
    header("Location: ../index1.php");
}
?>
