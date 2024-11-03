<?php
session_start();
unset($_SESSION['staff_id']);
session_destroy();
header("Location: ../../index1.php");
exit;
