<?php
// Retrieving values from the form
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$email_id = $_POST['email_id'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$password = $_POST['password'];
$user_type = "Staff";

// Creating a connection using mysqli
$connection = new mysqli("localhost", "root", "", "leavesystemphp");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// SQL query to check if the staff ID (email) already exists in the staff table
$sql1 = "SELECT staff_id FROM staff WHERE staff_id = ?";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s", $email_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows == 0) {
    // Insert new staff details
    $sql2 = "INSERT INTO staff (staff_id, first_name, middle_name, last_name, gender, contact) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt2 = $connection->prepare($sql2);
    $stmt2->bind_param("ssssss", $email_id, $first_name, $middle_name, $last_name, $gender, $contact);

    if ($stmt2->execute()) {
        // If staff insertion is successful, proceed with login details
        $sql3 = "INSERT INTO login (user_id, password, user_type) VALUES (?, ?, ?)";
        $stmt3 = $connection->prepare($sql3);
        $stmt3->bind_param("sss", $email_id, $password, $user_type);
        $stmt3->execute();

        // Get all leave types from leave_types table to initialize leave statistics for the new staff
        $sql5 = "SELECT leave_type, no_of_days FROM leave_types";
        $result4 = $connection->query($sql5);
        
        while ($row4 = $result4->fetch_assoc()) {
            $leave_type = $row4['leave_type'];
            $no_of_days = $row4['no_of_days'];

            // Insert leave statistics for each leave type
            $sql4 = "INSERT INTO leave_statistics (staff_id, leave_type, maximum_leaves, leaves_taken) VALUES (?, ?, ?, 0)";
            $stmt4 = $connection->prepare($sql4);
            $stmt4->bind_param("ssi", $email_id, $leave_type, $no_of_days);
            $stmt4->execute();
        }

        echo "<script>alert(\"Student added successfully.\");</script>";
        echo "<script>window.location=\"add_staff.php\";</script>";
    } else {
        // Handle case where staff insertion failed
        echo "<script>alert(\"Error inserting Student details. Please try again.\");</script>";
        echo "<script>window.location=\"add_staff.php\";</script>";
    }
} else {
    // Handle case where staff ID (email) already exists
    echo "<script>alert(\"Student ID already exists, please use a different Email ID.\");</script>";
    echo "<script>window.location=\"add_staff.php\";</script>";
}

// Closing the connection
$connection->close();
?>
