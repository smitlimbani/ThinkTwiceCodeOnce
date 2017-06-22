<!DOCTYPE html>
<?php 
error_reporting(E_ALL ^ E_WARNING); 
session_destroy();?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CSI</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		body{
			background:url('img/bg1.jpg');
			
		}

		
		
	</style>
  </head>
  <body>
	<?php if(isset($_GET['msg']) and $_GET['msg'] == "khatam"){?>
		<div class="row " >
			<div class="col-md-12">
				<div   class="alert alert-info" role="alert" >
					<strong>Submitted!</strong><span ></span> 
				</div>
			</div>
		</div>
	<?php }?>
   <?php if(isset($_GET['msg']) and $_GET['msg'] == "added"){?>
	<div class="row">
		<div class="col-md-12">
			<div id="alert_input" style="font-size:1em;" class="alert alert-success" role="alert" >
				<strong style="font-size:1.2em;">Success!</strong>&emsp;<span id="error_text">You have registered successfully</span> 
			</div>
		</div>
	</div>
	<?php }?>
	
    <div class="container">
		<div class="row" style="margin-top:10%">
			<div class="col-xs-6 col-md-4"></div>
			<div class="col-xs-6 col-md-4"></div>
			<div class="col-xs-6 col-md-4">
				<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">CSI Portal</h3>
  </div>
 
  <div class="panel-body">
  
    <?php if(isset($_GET['msg']) and $_GET['msg'] == "wrong"){?>
	<div>
		<span style="color:red;">Username/Password is Wrong!</span>
	</div>
	<?php }?>
			<form action="validation_login.php" method="post">
	
  <div class="form-group center-block">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Team Name" name="username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  </div>
  
  <button type="submit" class="btn btn-success">Login</button>&nbsp;&nbsp;<a href="registration.php">Not Registered?Register here</a>
</form>
</div>
</div>
			</div>
			
</div>
		
	</div>
  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
  </body>
	
  
</html>
