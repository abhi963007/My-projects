<?php
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin")
	{
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Student</title>
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
    <div id="heading">Add Student<hr size="2" color="#FFFFFF" ice:repeating=""/>
</div>
    <form action="add_staff_db.php" method="post">
        <label for="full_name" ><span>Name <span class="required">*</span></span>
          <input type="text" autocomplete="off" name="first_name" id="first_name" placeholder="First" required="required"/>
          <input type="text" autocomplete="off" name="middle_name" id="middle_name" placeholder="Middle"/>
          <input type="text" autocomplete="off" name="last_name" id="last_name" placeholder="Last" required="required"/>
        </label>
         <label for="email_id" ><span>Email ID <span class="required">*</span></span>
          <input type="email" autocomplete="off"  name="email_id" id="email_id" placeholder="Email" required="required" style="width:560px" />
        </label>

        <label for="gen" ><span>Gender <span class="required">*</span></span>
          <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </label>

        <label for="cp" ><span>Contact Number <span class="required">*</span></span>
          <input type="number" name="contact" id="contact" placeholder="Enter Contact" required="required" />
        </label>

        <label for="password" ><span>Create Password <span class="required">*</span></span>
          <input type="password" name="password" id="password" placeholder="Create Password" required="required" />
        </label>
        <label>
          <input type="submit" value="Add" />
        </label>
    </form>
  </div>
  <?php $page = 'add_staff'; include 'sidebar.php'?>
  <div id="footer">
  </div>
</div>
</body>
</html>
<?php
	}
	else
	{
		header("Location: ../index1.php");
	}
?>
