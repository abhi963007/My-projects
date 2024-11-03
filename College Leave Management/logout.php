<?php
session_start();
session_destroy();
setcookie("PHPSESSID", session_id(), time() - 3600, "/"); // Use quotes for the cookie name
header("Location: index1.php");
exit(); // It's a good practice to exit after redirection
?>
