<?php
function check_login()
{
if(strlen($_SESSION['admin_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index1.php";
		$_SESSION["admin_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>