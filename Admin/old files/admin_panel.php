<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=false");
    include("connection.php");
 ?>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
</head>
<body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="font-size:28px">ADMIN PANEL</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="admin_panel.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li><a href="admin_users.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="admin_logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<div class="row">
<div class="col-xs-12 col-md-2" style="background-color:yellow;">
wefgh
</div>
<div class="col-xs-12 col-md-10">
  <div class="container">
    <h2>Competition Details</h2>
  <br/>
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
    <div class="panel-body"><span style="align:center">Name of the Competition</span></div>
  </div>
    </div>
  </div>
  </div>
</div>

</body>
</html>
