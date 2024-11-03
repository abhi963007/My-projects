<?php
    // Retrieving values from textboxes
    $name = $_POST['name'];

    // Obtaining connection using mysqli
    $connection = mysqli_connect("localhost", "root", "", "leavesystemphp");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sql query
    $sql1 = "SELECT * FROM staff WHERE first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%'";
    
    // Firing query
    $result1 = mysqli_query($connection, $sql1);

    if (mysqli_num_rows($result1) == 0) {
        echo "<script>
                alert(\"Search results not found!\");
                window.location=\"search_staff_for_updation.php\";
              </script>";
    }

    session_start();
    if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin") {
        ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Update Staff</title>
<style>
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
  <?php $page = 'update_staff'; include 'sidebar.php'; ?>
  <div id="content_panel">
    <div id="heading">Search Result
      <hr size="2" color="#FFFFFF" />
    </div>
    <div id="table">
        <?php
        echo "<span><table border=\"1\" bgcolor=\"#006699\" >
                <tr>
                    <th width=\"200px\">Staff ID</th>
                    <th width=\"100px\">First Name</th>
                    <th width=\"100px\">Middle Name</th>
                    <th width=\"100px\">Last Name</th>
                    <th width=\"100px\">Password</th>
                    <th width=\"100px\">Edit</th>
                </tr>
              </table></span>";

        while ($row1 = mysqli_fetch_assoc($result1)) {
            $staff_id = $row1['staff_id'];
            $first_name = $row1['first_name'];
            $middle_name = $row1['middle_name'];
            $last_name = $row1['last_name'];

            $sql3 = "SELECT password FROM login WHERE user_id = '$staff_id'";
            $result2 = mysqli_query($connection, $sql3);

            if ($row2 = mysqli_fetch_assoc($result2)) {
                $password = $row2['password'];
            }

            echo "<table border=\"1\">
                    <tr>
                        <td width=\"200px\">$staff_id</td>
                        <td width=\"100px\">$first_name</td>
                        <td width=\"100px\">$middle_name</td>
                        <td width=\"100px\">$last_name</td>
                        <td width=\"100px\">$password</td>
                        <td width=\"100px\"><a href='staff_details_for_updation.php?staff_id=$staff_id' style='text-decoration:none; color: #a90000;'><img src=\"../images/edit.png\" />Update</a></td>
                    </tr>
                  </table>";
        }

        mysqli_close($connection);
        ?>
    </div>
  </div>
  <div id="footer"></div>
</div>
</body>
</html>
<?php
    } else {
        header("Location:../index1.php");
    }
?>
