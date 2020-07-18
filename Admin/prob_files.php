<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['admin']))
header("location:admin_login.php?msg=Please Login to continue.");
include("connection.php");
$sql="SELECT * FROM comp_details WHERE 1";
$res=mysqli_query($link,$sql);
$comp=mysqli_fetch_assoc($res);
?>
<html>
<head>
  <title>Admin Panel</title>
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
      <li><a href="admin_logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<div class="row">
  <div class="col-sm-2 col-xs-12">
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="admin_panel.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li class="active"><a href="prob_files.php"><span class="glyphicon glyphicon-file"></span> Manage Problem files</a></li>
            <li><a href="io_files.php"><span class="glyphicon glyphicon-transfer"></span> Manage Input-Output Files</a></li>
            <li><a href="manage_users.php"><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>
            <li><a href="export_data.php"><span class="glyphicon glyphicon-download-alt"></span> Export Data</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div class="col-sm-10 col-xs-12">
    <div class="container">
      <h3>View and Change the Problem Settings here.</h3>
      <br/><br/>
      <div class="row">
        <div class="col-sm-2 col-xs-2">
          <strong>PROBLEM NUMBER</strong>
      </div>
    <div class="col-sm-4 col-xs-4">
      <strong>PROBLEM TITLE</strong>
    </div>
    <div class="col-sm-2 col-xs-2">
      <strong>TIME LIMIT<br/>(seconds)</strong>
    </div>
    <div class="col-sm-2 col-xs-2">
      <strong>MEMORY LIMIT<br/>(bytes)</strong>
    </div>
    <div class="col-sm-2 col-xs-2">
    </div>
  </div>
  <hr />
  <?php
    $r=mysqli_query($link,"SELECT * FROM problems WHERE 1");
    $i=0;
    while($i!=$comp['no_of_ques'])
    {
      $i++;
      $flag=true;
      $prob=mysqli_fetch_assoc($r);
      if($prob==null)
        $flag=false;
  ?>
  <div class="row">
    <div class="col-sm-2 col-xs-2">
      <?php if($flag) echo $prob['id']; else echo $i; ?>
  </div>
<div class="col-sm-4 col-xs-4">
  <?php if($flag) echo $prob['problem_title']; else echo "-----"; ?>
</div>
<div class="col-sm-2 col-xs-2">
  <?php if($flag) echo $prob['problem_time_limit']; else echo "---";?>
</div>
<div class="col-sm-2 col-xs-2">
  <?php if($flag) echo $prob['problem_memory_limit']; else echo "---"; ?>
</div>
<div class="col-sm-2 col-xs-2">
  <button class="btn btn-<?php if($flag) echo "primary"; else echo "warning"; ?>" data-toggle="modal" data-target="#modal<?php if ($flag) echo $prob['id']; else echo $i; ?>"><?php if ($flag) echo "CHANGE"; else echo "UPLOAD"; ?></button>
</div>
</div>
<div class="modal fade" id="modal<?php if($flag) echo $prob['id']; else echo $i; ?>" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change the problem settings for Problem Number <?php if($flag) echo $prob['id']; else echo $i; ?></h4>
      </div>
      <div class="modal-body">
        <form id="form<?php if($flag) echo $prob['id']; else echo $i; ?>" action="upload_problem.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" value="<?php if($flag) echo "update"; else echo "new"; ?>" name="option">
          <input type="hidden" value="<?php if($flag) echo $prob['id']; else echo $i; ?>" name="id">
          <div class="form-group">
            <label for="title">Problem Title:</label><span class="pull-right error" id="title_err"></span>
            <input type="text" class="form-control" id="prob_title" name="title">
          </div>
          <div class="form-group">
            <label for="time">Time Limit (in sec):</label><span class="pull-right error" id="time_err"></span>
            <input type="text" class="form-control" id="time" name="time">
          </div>
          <div class="form-group">
            <label for="memory">Memory Limit (in bytes):</label><span class="pull-right error" id="memory_err"></span>
            <input type="text" class="form-control" id="memory" name="memory">
          </div>
          <div class="form-group">
            <label for="prob_file">Problem File</label><span class="pull-right error" id="file_err"></span>
            <input type="file" class="form-control-file" id="prob_file" aria-describedby="fileHelp" name="prob_file">
            <small id="fileHelp" class="form-text text-muted">Select the problem file to upload</small>
          </div>
          <div class="text-center"><button type="button" id="btn<?php if($flag) echo $prob['id']; else echo $i; ?>" class="btn btn-primary btn-lg" onclick="verify_upload(<?php if($flag) echo $prob['id']; else echo $i; ?>)">UPLOAD</button></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<hr />
  <?php
    }
   ?>
</div>
<br/>
<div class="row">
  <div class="col-md-4">
  </div>
  <div class="col-md-4 col-xs-12 text-center">
    <h3><strong>CLEAR PROBLEMS</strong></h3><br/>
Clear all the problems and re-upload them.<br/><br/>
<button class="btn btn-lg btn-danger" onclick="verify_delete()">CLEAR PROBLEM FILES</button><br/><br/>
  </div>
  <div class="col-md-4">
  </div>
</div>
</div>

</div>
  <div class="footer-bottom">
  <div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="design">
      <span class="pull-right">Computer Society Of India-DDU Student Branch. 2017 </span>
    </div>
    </div>
  </div>
  </div>
  </div>
  <div id="snackbar"><?php echo $_GET['msg']; ?></div>
<script>
function verify_upload(id) {
  var name=$('#form'+id+' #prob_title').val();
  var time=$('#form'+id+' #time').val()
  var mem=$('#form'+id+' #memory').val()
  var file=$('#form'+id+' #prob_file').val()
  var flag=true;
  if(name == "") {
    $('#form'+id+' #title_err').html("*Title cannot be empty.");
    flag=false;
  }
  else {
    $('#form'+id+' #title_err').html("");
  }

  if(time == "") {
    $('#form'+id+' #time_err').html("*Time Limit cannot be empty.");
    flag=false;
  }
  else if(isNaN(time)) {
    $('#form'+id+' #time_err').html("*Time Limit has to be a number only.");
    flag=false;
  }
  else {
    $('#form'+id+' #time_err').html("");
  }

  if(mem == "") {
    $('#form'+id+' #memory_err').html("*Memory Limit cannot be empty.");
    flag=false;
  }
  else if(isNaN(mem)) {
    $('#form'+id+' #memory_err').html("*Memory Limit has to be a number only.");
    flag=false;
  }
  else {
    $('#form'+id+' #memory_err').html("");
  }

  if(file == "") {
    $('#form'+id+' #file_err').html("*Please Select a file to upload.");
    flag=false;
  }
  else {
    $('#form'+id+' #file_err').html("");
  }
  if(flag) {
    $('#form'+id).submit();
  }
}
<?php
if(isset($_GET['msg']))
{
  echo 'show_toast();';
}
?>
</script>
</body>
  </html>
