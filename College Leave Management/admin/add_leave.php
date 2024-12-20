<?php
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin")
	{
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Leave</title>
<style>
#content_panel form label > span {
	width: 130px;
}
#content_panel form input[type="submit"]{
	margin-left: 195px;
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
        <li><a class="greeting" href="#">Hi HOD</a></li>
        </ul>
    </div>
  </div>
  <div id="content_panel">
    <div id="heading">Add Leave Types<hr size="2" color="#FFFFFF" />
</div>
    <form action="add_leave_db.php" method="post">
        <label for="type_of_leave" ><span>Type of Leave <span class="required">*</span></span>
          <input type="text" name="type_of_leave" id="type_of_leave" placeholder="Type of Leave" required="required" oninvalid="setCustomValidity('Please enter the type of leave.')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </label>
        
        <label for="number_of_leaves" ><span>Number of Leaves <span class="required">*</span></span>
          <input type="number" min="1" max="99" maxlength="10" name="number_of_leaves" id="number_of_leaves" placeholder="Number of Leaves" required="required" oninvalid="setCustomValidity('Please enter the number of Leaves.')" onchange="try{setCustomValidity('')}catch(e){}" />
        </label>
        <label>
          <input type="submit" value="Add" />
        </label>
    </form>
  </div>
  <?php $page = 'add_leave'; include 'sidebar.php'?>
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
