<?php
// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Retrieve form data
    $user_id = $_POST['txt_username'];
    $password_input = $_POST['pswd_password'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM login WHERE user_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching user was found
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_type = $row['user_type'];
            $db_password = $row['password'];  // Plain text password from DB

            // Compare the input password with the plain text password in the DB
            if ($password_input == $db_password) {
                $_SESSION['sid'] = session_id();
                $_SESSION['user'] = $user_type;

                if ($user_type == "admin") {
                    header("Location: admin/index.php");
                    exit(); // Stop further script execution
                } elseif ($user_type == "Staff") {
                    $_SESSION['staff_id'] = $user_id;
                    header("Location: staff/index.php");
                    exit(); // Stop further script execution
                } elseif ($user_type == "PC") {
                    $_SESSION['pc_id'] = $user_id;
                    header("Location: pc/index.php");
                    exit(); // Stop further script execution
                }
            } else {
                // Handle invalid password
                echo "<script>
                    alert('Incorrect Username and Password Match.');
                    window.location='index1.php';
                </script>";
            }
        }
    } else {
        // Handle invalid login
        echo "<script>
            alert('Incorrect Username and Password Match.');
            window.location='index1.php';
        </script>";
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file here -->
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="POST">
            <label for="txt_username">Username:</label>
            <input type="text" id="txt_username" name="txt_username" required>

            <label for="pswd_password">Password:</label>
            <input type="password" id="pswd_password" name="pswd_password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
