<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC") {
    // Create a connection using mysqli
    $connection = new mysqli("localhost", "root", "", "leavesystemphp");

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Check if staff_id and start_date are set in the POST request
    if (isset($_POST['staff_id']) && isset($_POST['start_date'])) {
        $staff_id = $_POST['staff_id'];
        $start_date = $_POST['start_date'];
        $leave_status = $_POST['approve_reject']; // Get the status from the form (Approved/Rejected)

        // Check if the leave is being approved or rejected by the Program Coordinator
        if ($leave_status == 'Approved') {
            // Update the Program Coordinator approval only
            $sql = "UPDATE leave_requests SET pc_approval = 1 WHERE staff_id = ? AND start_date = ?";
            $stmt = $connection->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ss", $staff_id, $start_date);

                if ($stmt->execute()) {
                    // Now check if both Program Coordinator and Admin have approved the leave
                    $check_approval_sql = "SELECT pc_approval, admin_approval FROM leave_requests WHERE staff_id = ? AND start_date = ?";
                    $check_stmt = $connection->prepare($check_approval_sql);
                    $check_stmt->bind_param("ss", $staff_id, $start_date);
                    $check_stmt->execute();
                    $result = $check_stmt->get_result();
                    $row = $result->fetch_assoc();

                    if ($row['pc_approval'] == 1 && $row['admin_approval'] == 1) {
                        // If both approvals are granted, set the leave_status to Approved
                        $final_approval_sql = "UPDATE leave_requests SET leave_status = 'Approved' WHERE staff_id = ? AND start_date = ?";
                        $final_stmt = $connection->prepare($final_approval_sql);
                        $final_stmt->bind_param("ss", $staff_id, $start_date);
                        $final_stmt->execute();
                        $final_stmt->close();
                    }

                    // Redirect back with success message
                    header("Location: view_leave_requests.php?msg=Program Coordinator approved leave.");
                    exit; // Ensure no further code is executed
                } else {
                    // Redirect back with an error message
                    header("Location: view_leave_requests.php?msg=Error approving leave request.");
                    exit; // Ensure no further code is executed
                }
                $stmt->close();
            } else {
                header("Location: view_leave_requests.php?msg=Error preparing statement.");
                exit; // Ensure no further code is executed
            }
        } else {
            // If rejected, simply update the leave_status to Rejected
            $sql = "UPDATE leave_requests SET leave_status = 'Rejected' WHERE staff_id = ? AND start_date = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ss", $staff_id, $start_date);

            if ($stmt->execute()) {
                header("Location: view_leave_requests.php?msg=Leave request rejected.");
                exit; // Ensure no further code is executed
            } else {
                header("Location: view_leave_requests.php?msg=Error rejecting leave request.");
                exit; // Ensure no further code is executed
            }
            $stmt->close();
        }
    } else {
        // Redirect back if parameters are missing
        header("Location: view_leave_requests.php?msg=Invalid request.");
        exit; // Ensure no further code is executed
    }

    $connection->close();
} else {
    header("Location: ../index1.php");
    exit; // Ensure no further code is executed
}
?>
