<?php include("connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CSI Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-default" role="navigation" style="margin-bottom:0px;">
		<div class="navbar-header ">
			<img src="logo.jpg" height=120 width=800/>
		</div>	
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<li><p class="navbar-text"><?php if(isset($_COOKIE['team_name'])){echo"Welcome ".$_COOKIE['team_name'];}else{ echo "cookie deleted";}?></p></li>
				<li><a href="khatam.php?team_id=<?php echo $_COOKIE['team_id'];?>">Log Out</a></li>
				<div>
					<span id="timer_hour">Cookie</span><span id="timer_min">Deleted</span><span id="timer_sec">By User</span>
				<div>
			</ul>
		</div>
</nav>
<div class="progress" style="height: 5px;">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100"
  aria-valuemin="0" aria-valuemax="100" id="prog_bar" style="width:40%">
  </div>
</div>
<input type="hidden" value="" id="timer_value">
<input type="hidden" value="" id="comp_time">
