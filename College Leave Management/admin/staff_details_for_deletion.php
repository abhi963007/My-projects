<?php
// Retrieving values from textboxes
$staff_id = $_POST['staff_id'];

// Initializing the values
$host = "localhost";
$db_name = "leavesystemphp";
$db_user = "root";
$db_pass = "";

// Establishing the MySQLi connection
$connection = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// SQL queries
$sql1 = "SELECT * FROM staff WHERE staff_id = ?";
$sql2 = "SELECT password FROM login WHERE user_id = ?";

// Prepare and execute first query
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s", $staff_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

// Prepare and execute second query
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("s", $staff_id);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result1->num_rows > 0) {
    // Fetching the staff details
    while ($row1 = $result1->fetch_assoc()) {
        $first_name = $row1['first_name'];
        $middle_name = $row1['middle_name'];
        $last_name = $row1['last_name'];
    }
    
    // Fetching the password
    while ($row2 = $result2->fetch_assoc()) {
        $password = $row2['password'];
    }
} else {
    echo "<script>
            alert('Student ID $staff_id does not exist!');
            window.location='search_staff_for_deletion.php';
          </script>";
}

// Closing connection
$stmt1->close();
$stmt2->close();
$connection->close();
?>

<?php
session_start();
if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin") {
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Student</title>
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
    <div id="heading">Delete Student<hr size="2" color="#FFFFFF" /></div>
    <form action="delete_staff_db_by_id.php" method="get">
      <p>
        <label for="staff_id"><span>Student ID</span>
        <span class="db_data"> <?php echo $staff_id; $_SESSION['staff_id'] = $staff_id;?></span></label>
      </p>
      <label for="full_name"><span>Name</span>
      <span class="db_data"><?php echo $first_name . " " . $middle_name . " " . $last_name; ?></span></label>
      
      <label for="password"><span>Password</span>
      <span class="db_data"><?php echo $password; ?></span></label>
      
      <label><input type="Submit" value="Delete Student"/></label>
    </form>
  </div>
  
  <?php $page = 'delete_staff'; include 'sidebar.php'; ?>
  
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
