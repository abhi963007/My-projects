<?php
// Start the session
session_start();
$staff_id = $_GET['staff_id'];

// Create a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare SQL queries
$sql1 = "SELECT user_id FROM login WHERE user_type = 'PC'";
$sql2 = "UPDATE login SET user_type = 'PC' WHERE user_id = ?";
$sql3 = "UPDATE login SET user_type = 'Staff' WHERE user_id = ?";

// Prepare statements
$stmt1 = $connection->prepare($sql1);
$stmt2 = $connection->prepare($sql2);
$stmt3 = $connection->prepare($sql3);

// Execute the first query to get the previous PC
$stmt1->execute();
$result = $stmt1->get_result();

// Get the previous PC's user ID
$previous_pc = null;
if ($row = $result->fetch_assoc()) {
    $previous_pc = $row['user_id'];
}

// If there was a previous PC, update their user type
if ($previous_pc) {
    $stmt3->bind_param("s", $previous_pc);
    $stmt3->execute();
}

// Now assign the new PC
$stmt2->bind_param("s", $staff_id);
$stmt2->execute();

// Close the prepared statements
$stmt1->close();
$stmt2->close();
$stmt3->close();

// Close the connection
$connection->close();

// Notify the user and redirect
echo "<script>
        alert('Program Coordinator Assigned Successfully.');
        window.location='search_staff_to_assign_pc.php';
      </script>";
?>
