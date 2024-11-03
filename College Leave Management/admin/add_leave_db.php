<?php
// Assuming you are connected to the database already
$leave_type = $_POST['type_of_leave'];
$number_of_days = $_POST['number_of_leaves'];

// Create a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// For primary key verification
$sql1 = "SELECT leave_type FROM leave_types WHERE leave_type = ?";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s", $leave_type);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows > 0) {
    echo "<script>
            alert(\"'".$leave_type."' already exists!\");
            window.location=\"add_leave.php\";</script>";
} else {
    // Update the column name to match the database structure
    $sql2 = "INSERT INTO leave_types (leave_type, no_of_days) VALUES (?, ?)";
    $stmt2 = $connection->prepare($sql2);
    $stmt2->bind_param("si", $leave_type, $number_of_days);

    if ($stmt2->execute()) {
        $sql3 = "SELECT staff_id FROM staff";
        $result2 = $connection->query($sql3);

        while ($row = $result2->fetch_assoc()) {
            $staff_id = $row['staff_id'];
            $sql4 = "INSERT INTO leave_statistics (staff_id, leave_type, maximum_leaves) VALUES (?, ?, ?)";
            $stmt4 = $connection->prepare($sql4);
            $stmt4->bind_param("ssi", $staff_id, $leave_type, $number_of_days);
            $stmt4->execute();
        }

        echo "<script>
                alert(\"New Leave Added and Leave Type is '".$leave_type."'\");
                window.location=\"add_leave.php\";</script>";
    } else {
        echo "<script>
                alert(\"Error adding leave type: " . $connection->error . "\");
                window.location=\"add_leave.php\";</script>";
    }
}

// Closing the connection
$stmt1->close();
$stmt2->close();
$stmt4->close();
$connection->close();
?>
