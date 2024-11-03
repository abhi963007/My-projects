<?php 
    // Retrieving values from textboxes
    $staff_id = $_GET['staff_id'];
    
    // Database credentials
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "leavesystemphp";
    
    // Establishing connection using mysqli
    $connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    // Checking the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    // SQL queries
    $sql1 = "SELECT * FROM staff WHERE staff_id = ?";
    $sql2 = "SELECT password FROM login WHERE user_id = ?";
    
    // Prepare and bind the first query
    $stmt1 = $connection->prepare($sql1);
    $stmt1->bind_param("s", $staff_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    
    // Prepare and bind the second query
    $stmt2 = $connection->prepare($sql2);
    $stmt2->bind_param("s", $staff_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    
    if ($result1->num_rows == 0) {
        echo "<script>
            alert('Staff ID $staff_id does not exist!');
            window.location='search_staff_for_updation.php';
            </script>";
    } else {
        // Fetching the results
        while ($row1 = $result1->fetch_assoc()) {
            $first_name = $row1['first_name'];
            $middle_name = $row1['middle_name'];
            $last_name = $row1['last_name'];
        }
        while ($row2 = $result2->fetch_assoc()) {
            $password = $row2['password'];
        }
    }
    
    // Closing the connection
    $stmt1->close();
    $stmt2->close();
    $connection->close();
?>
<?php
    session_start();
    if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Student</title>
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
  <div id="content_panel">
    <div id="heading">Update Student<hr size="2" color="#FFFFFF" /></div>
    <form action="update_staff_db.php" method="post">
     <p>
        <label for="staff_id"><span>Student ID </span><span class="db_data"><?php echo $staff_id; $_SESSION['staff_id'] = $staff_id; ?></span></label>
      </p>
        <label for="full_name"><span>Name </span>
        <input type="text" name="first_name" id="first_name" value="<?php echo $first_name ?>" required="required"/>
        <input type="text" name="middle_name" id="middle_name" value="<?php echo $middle_name ?>" />
        <input type="text" name="last_name" id="last_name" value="<?php echo $last_name ?>" required="required"/>
        </label>
        <label for="password"><span>Password </span><input type="text" name="password" id="password" value="<?php echo $password ?>" required="required" />
        </label>
        <label>
          <input type="submit" value="Save Changes" />
        </label>
    </form>
  </div>
  <?php $page = 'update_staff'; include 'sidebar.php' ?>
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
