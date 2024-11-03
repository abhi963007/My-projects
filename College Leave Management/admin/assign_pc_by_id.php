<?php 
session_start();
if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin") {
    // Retrieving values from textboxes
    $staff_id = $_GET['staff_id'];

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

    // Sql query
    $sql1 = "SELECT * FROM staff WHERE staff_id = '".$connection->real_escape_string($staff_id)."'";
    $sql2 = "SELECT password FROM login WHERE user_id = '".$connection->real_escape_string($staff_id)."'"; 

    // Firing query
    $result1 = $connection->query($sql1);
    $result2 = $connection->query($sql2);

    if ($result1->num_rows == 0) {
        echo "<script>
                alert(\"Student ID " . $staff_id . " does not exist !\");
                window.location=\"search_staff_for_updation.php\";</script>";
    }

    // Fetching data from the first result set
    $first_name = $middle_name = $last_name = $password = ""; // Initialize variables
    while ($row1 = $result1->fetch_assoc()) {
        $first_name = $row1['first_name'];
        $middle_name = $row1['middle_name'];
        $last_name = $row1['last_name'];
    }

    // Fetching data from the second result set
    while ($row2 = $result2->fetch_assoc()) {
        $password = $row2['password'];
    }

    // Closing Connection
    $connection->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Assign Program Coordinator</title>
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
        <li><a class="greeting" href="#">Hi <?php echo $_SESSION['user']; ?></a></li>
      </ul>
    </div>
  </div>
  <div id="content_panel">
    <div id="heading">Update Staff<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
    <form action="assign_pc_db.php" method="get">
     <p>
        <label for="staff_id"><span>Student ID </span><input type="text" name="staff_id" id="staff_id" value="<?php echo htmlspecialchars($staff_id); ?>" required="required" readonly="readonly"/></label>
      </p>
        <label for="full_name"><span>Name </span>
        <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required="required" readonly="readonly"/>
      <input type="text" name="middle_name" id="middle_name" value="<?php echo htmlspecialchars($middle_name); ?>" readonly="readonly"/>
      <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required="required" readonly="readonly"/>
        </label>
        <label for="password"><span>Password </span><input type="text" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>" required="required" readonly="readonly"/></label>
      <label>
          <input type="submit" value="Assign" />
        </label>
    </form>
  </div>
  <?php $page = 'program_coordinator'; include 'sidebar.php'?>
  <div id="footer">
  </div>
</div>
</body>
</html>
<?php
} else {
    header("Location: ../index1.php");
}
?>
