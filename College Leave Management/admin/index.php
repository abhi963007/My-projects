<?php
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin")
	{
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
    <div id="heading">Hello HOD<hr size="2" color="#FFFFFF" />
    </div>

    <div class="main-section">

      <div class="dashbord">
        <div class="icon-section">
          <i class="fa fa-users" aria-hidden="true"></i><br>
          <small>Registered Students</small>
          <p><?php include 'counters/staffcount.php'?></p>
        </div>
       
      </div>

      <div class="dashbord dashbord-green">
        <div class="icon-section">
          <i class="fa fa-sign-out" aria-hidden="true"></i><br>
          <small>Leave Types</small>
          <p><?php include 'counters/leavetypescount.php'?></p>
        </div>
       
      </div>
      
      <div class="dashbord dashbord-orange">
        <div class="icon-section">
          <i class="fa fa-sign-out" aria-hidden="true"></i><br>
          <small>Leaves Requested</small>
          <p><?php include 'counters/leavereqcount.php'?></p>
        </div>
       
      </div>
      

      <div class="dashbord dashbord-blue">
        <div class="icon-section">
          <i class="fa fa-user-check" aria-hidden="true"></i><br>
          <small>Approved Leaves</small>
          <p><?php include 'counters/approvecount.php'?></p>
        </div>
        
      </div>

      <div class="dashbord dashbord-skyblue">
        <div class="icon-section">
          <i class="fa fa-user-tie" aria-hidden="true"></i><br>
          <small>Teacher</small>
          <p><?php include 'counters/programcocount.php'?></p>
        </div>
       
      </div>

      <div class="dashbord dashbord-red">
        <div class="icon-section">
          <i class="fa fa-user-times" aria-hidden="true"></i><br>
          <small>Rejected Leaves</small>
          <p><?php include 'counters/rejectcount.php'?></p>
        </div>
        
      </div>

    </div>
    <br>
   
  </div>

  
  <?php include 'sidebar.php'?>
  <div id="footer">
  	<p><br />&copy;MCA        <?php echo date("Y"); ?>     Leave Management System    </p>
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


<style>
  .main-section{
	width:80%;
	margin:0 auto;
	text-align: center;
	padding: 0px 5px;
}
.dashbord{
	width:32%;
	display: inline-block;
	background-color:#34495E;
	color:#fff;
	margin-top: 50px; 
}
.icon-section i{
	font-size: 30px;
	padding:10px;
	border:1px solid #fff;
	border-radius:50%;
	margin-top:-25px;
	margin-bottom: 10px;
	background-color:#34495E;
}
.icon-section p{
	margin:0px;
	font-size: 20px;
	padding-bottom: 10px;
}
.detail-section{
	background-color: #2F4254;
	padding: 5px 0px;
}
.dashbord .detail-section:hover{
	background-color: #5a5a5a;
	cursor: pointer;
}
.detail-section a{
	color:#fff;
	text-decoration: none;
}
.dashbord-green .icon-section,.dashbord-green .icon-section i{
	background-color: #16A085;
}
.dashbord-green .detail-section{
	background-color: #149077;
}
.dashbord-orange .icon-section,.dashbord-orange .icon-section i{
	background-color: #F39C12;
}
.dashbord-orange .detail-section{
	background-color: #DA8C10;
}
.dashbord-blue .icon-section,.dashbord-blue .icon-section i{
	background-color: #2980B9;
}
.dashbord-blue .detail-section{
	background-color:#2573A6;
}
.dashbord-red .icon-section,.dashbord-red .icon-section i{
	background-color:#E74C3C;
}
.dashbord-red .detail-section{
	background-color:#CF4436;
}
.dashbord-skyblue .icon-section,.dashbord-skyblue .icon-section i{
	background-color:#8E44AD;
}
.dashbord-skyblue .detail-section{
	background-color:#803D9B;
}
</style>
