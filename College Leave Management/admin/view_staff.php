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
    $sql = "SELECT * FROM staff";

    // Firing query
    $result = $connection->query($sql);

    if ($result->num_rows == 0) {
        echo "<script>
                alert(\"Search results not found !\");
                window.location=\"#\";
              </script>";
    }
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View Staff</title>
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
        <div id="heading">Registered Students
            <hr size="2" color="#FFFFFF" ice:repeating=""/>
        </div>
        <div id="table">
            <?php
            echo "<span><table border=\"1\" bgcolor=\"#006699\">
                <tr>
                    <th width=\"200px\">Fullname</th>
                    <th width=\"200px\">Email</th>
                    <th width=\"70px\">Gender</th>
                    <th width=\"100px\">Contact</th>
                </tr>
            </table></span>";

            while ($row = $result->fetch_assoc()) {
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $staff_id = $row['staff_id'];
                $gender = $row['gender'];
                $contact = $row['contact'];
                echo "<table border=\"1\">
                        <tr>
                            <td width=\"200px\">" . $first_name . " " . $last_name . "</td>
                            <td width=\"200px\">" . $staff_id . "</td>
                            <td width=\"70px\">" . $gender . "</td>
                            <td width=\"100px\">" . $contact . "</td>
                        </tr>
                    </table>";
            }

            // Close the connection
            $connection->close();
            ?>
        </div>
    </div>
    <?php $page = 'view_staff'; include 'sidebar.php' ?>
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
