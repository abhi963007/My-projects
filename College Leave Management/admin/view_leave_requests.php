<?php
session_start();

// Check if the user is logged in as Admin
if (isset($_SESSION['sid']) && $_SESSION['sid'] == session_id() && isset($_SESSION['user']) && strtolower($_SESSION['user']) == "admin") {
    // Create a connection using mysqli
    $connection = new mysqli("localhost", "root", "", "leavesystemphp");

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Fetch pending leave requests
    $sql = "SELECT * FROM leave_requests WHERE leave_status = 'Pending'";
    $result = $connection->query($sql);

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Pending Leave Requests</title>
        <style>
            /* General styling for the page */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }

            h1 {
                text-align: center;
                color: #333;
                margin-top: 20px;
            }

            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
                background-color: #fff;
            }

            th, td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            tr:hover {
                background-color: #f1f1f1;
            }

            /* Styling for form elements */
            form {
                display: inline-block;
            }

            select {
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #f8f8f8;
            }

            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 5px 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }

            h3 {
                text-align: center;
                color: #888;
                margin-top: 20px;
            }

            table, select, input[type="submit"] {
                font-size: 14px;
            }
        </style>
    </head>
    <body>
    <?php

    // If there are pending leave requests
    if ($result->num_rows > 0) {
        echo "<h1>Pending Leave Requests</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Staff ID</th><th>Leave Type</th><th>Start Date</th><th>End Date</th><th>Days Requested</th><th>Current Status</th><th>Action</th></tr>";

        // Display each leave request in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['staff_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['leave_type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['days_requested']) . "</td>";
            echo "<td>" . htmlspecialchars($row['leave_status']) . "</td>";
            echo "<td>";
            echo "<form action='approve_reject_admin.php' method='POST'>";
            echo "<input type='hidden' name='staff_id' value='" . $row['staff_id'] . "'>";
            echo "<input type='hidden' name='start_date' value='" . $row['start_date'] . "'>";
            echo "<select name='approve_reject'>";
            echo "<option value='Approved'>Approve</option>";
            echo "<option value='Rejected'>Reject</option>";
            echo "</select>";
            echo "<input type='submit' value='Submit'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<h3>No pending leave requests.</h3>";
    }

    // Close the database connection
    $connection->close();
} else {
    // User is not logged in as Admin, show an error message
    echo "You must be logged in as Admin to view this page.";
}
?>
    </body>
    </html>
