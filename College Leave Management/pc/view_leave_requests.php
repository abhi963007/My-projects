<?php
	session_start();
	if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC") {	
		$pc_id = $_SESSION['pc_id'];
		
		// Create a connection using mysqli
		$connection = new mysqli("localhost", "root", "", "leavesystemphp");

		// Check connection
		if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
		}
		
		$sql = "SELECT * FROM leave_requests WHERE leave_status = 'Pending'";
		$result = $connection->query($sql);
		
		$no_of_rows = $result->num_rows;
		
		if ($no_of_rows == 0) {
			echo "<script>
					alert('No Leave Requests to Show!');
					window.location = 'index.php';
				  </script>";
		}
?>

<!DOCTYPE html>
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
        <li><a class="greeting" href="#">Hi Teacher</a></li>
      </ul>
    </div>
  </div>
  <div id="content_panel">
    <div id="heading">Leave Requests Received<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
     <label for="total_leave_requests"><span style="width:300px; margin-left:10px;">Total Requests Received : <?php echo $no_of_rows; ?></span>
    </label>
    <label>
    <div id="table">
    	<span><table border="1" bgcolor="#006699">
				<tr>
                	<th width="280px">Student ID</th>
					<th width="180px">Leave Type</th>
					<th width="80px">Start Date</th>
					<th width="80px">No. of Days</th>
					<th width="90px">Applied On</th>
                    <th width="110px">Approve/Reject</th>
				</tr>
			</table></span>

    <?php
		while ($row = $result->fetch_assoc()) {
			$staff_id = $row['staff_id'];
			$leave_type = $row['leave_type'];
			$start_date = $row['start_date'];
			$no_of_days = $row['days_requested'];
			$date_applied = $row['date_applied'];
			$status = $row['leave_status'];
			
			echo "<table border=\"1\">
					<tr>
						<td width=\"280px\">".$staff_id."<a href='staff_profile.php?staff_id=".$staff_id."' style='text-decoration:none;'><button class='button-s'>View Profile</button></a></td>
						<td width=\"180px\">".$leave_type."</td>
						<td width=\"80px\">".$start_date."</td>
						<td width=\"80px\">".$no_of_days."</td>
						<td width=\"90px\">".$date_applied."</td>
						<td width=\"110px\"><a href='approve_reject_leave.php?staff_id=".$staff_id."&start_date=".$start_date."' style='text-decoration:none; color: #a90000;'><img src=\"../images/edit_find_replace.png\" />Details</a></td>
					</tr>
				</table>";
		}
	?>

    </label>
  </div>
  </div>
  <?php $page = 'view_leave_request'; include 'sidebar.php'; ?>
  <div id="footer">
  </div>
</div>
</body>
</html>

<?php
	} else {
		header("Location: ../index1.php");
	}
	$connection->close();
?>
