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
            <li class="active"><a href="admin_panel.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="prob_files.php"><span class="glyphicon glyphicon-file"></span> Manage Problem files</a></li>
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
      <h2 class="text-center">Competition Details</h2><br/>
      <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-primary">
      <div class="panel-heading text-center"><span style="font-size:22px">Name of the Competition</span></div>
      <div class="panel-body text-center"><h4><strong><?php echo $comp['name_of_comp']; ?></strong></h4>
        <div id="change_name" class="collapse">
          <form action="change_name.php" method="GET" id="form_name">
            <div class="input-group">
              <br/><span style="font-size:15px">Enter the new name for the Competition.</span><br/><br/>
            <div class="row">
              <div class="col-lg-9"><input id="name" type="text" class="form-control input-lg" name="name" placeholder="Competition Name"></div>
              <div class="col-lg-3"><button type="button" class="btn btn-md btn-warning" onclick="change_name()">SAVE</button></div>
              <br/>
          </div>
          </div>
          </form>

</div>
      </div>
            <div class="panel-footer text-center">
        <button class="btn btn-lg btn-success" data-toggle="collapse" data-target="#change_name">CHANGE</button>

      </div>
    </div>
  </div>
    <div class="col-sm-4">
    <div class="panel panel-primary">
  <div class="panel-heading text-center"><span style="font-size:22px">Number of Questions</span></div>
  <div class="panel-body text-center"><h4><strong><?php echo $comp['no_of_ques']; ?></strong></h4>
    <div id="ques" class="collapse">
      <form action="change_num.php" method="GET" id="form_num">
        <div class="input-group">
          <br/><span style="font-size:15px">Total Number of Questions in the Competition.</span><br/><br/>
        <div class="row">
          <div class="col-lg-9"><input id="no_ques" type="text" class="form-control input-lg" name="no_ques" placeholder="No. of Questions"></div>
          <div class="col-lg-3"><button type="button" class="btn btn-md btn-warning" onclick="change_num()">SAVE</button></div>
          <br/>
      </div>
      </div>
      </form>

</div>
  </div>
        <div class="panel-footer text-center">
    <button class="btn btn-lg btn-success" data-toggle="collapse" data-target="#ques">CHANGE</button>

  </div>
</div>
</div>
<div class="col-sm-4">
  <div class="panel panel-primary">
<div class="panel-heading text-center"><span style="font-size:22px">Duration of the Competition</span></div>
<div class="panel-body text-center"><h4><strong><?php echo $comp['comp_time_hrs']; ?> HOURS</strong></h4>
  <div id="change_time" class="collapse">
    <form action="change_duration.php" method="GET" id="form_time">
      <div class="input-group">
        <br/><span style="font-size:15px">Enter the duration for which the competition will be held(in Hours).</span><br/><br/>
        <div class="row">
        <div class="col-lg-9"><input id="time" type="text" class="form-control input-lg" name="time" placeholder="Time (in hours)"></div>
        <div class="col-lg-3"><button type="button" class="btn btn-md btn-warning" onclick="change_time()">SAVE</button></div>
        <br/>
      </div>
    </div>
    </form>

</div>
</div>
      <div class="panel-footer text-center">
  <button class="btn btn-lg btn-success" data-toggle="collapse" data-target="#change_time">CHANGE</button>

</div>
</div>
</div>
    </div>

    <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
    <div class="panel-heading text-center"><span style="font-size:22px">Negative Marking ?</span></div>
    <div class="panel-body text-center"><h4><strong><?php echo $comp['neg_marking']; ?></strong></h4>
      <div id="change_neg" class="collapse">
        <form action="change_neg_marking.php" method="GET" id="form_neg">
          <div class="input-group">
            <br/><span style="font-size:15px">Choose if negative marking is allowed.</span><br/><br/>
          <div class="row">
            <div class="col-lg-9">
              <label class="radio-inline"><input type="radio" name="neg_marking" value="YES">YES</label>
              <label class="radio-inline"><input type="radio" name="neg_marking" value="NO" checked>NO</label>
            </div>
            <div class="col-lg-3"><button type="submit" class="btn btn-md btn-warning">SAVE</button></div>
            <br/>
        </div>
        </div>
        </form>

</div>
    </div>
          <div class="panel-footer text-center">
      <button class="btn btn-lg btn-success" data-toggle="collapse" data-target="#change_neg">CHANGE</button>

    </div>
  </div>
</div>
<div class="col-sm-4">
  <div class="panel panel-primary">
<div class="panel-heading text-center"><span style="font-size:22px">Number of Input files for each problem</span></div>
<div class="panel-body text-center"><h4><strong><?php echo $comp['no_of_input_files']; ?></strong></h4>
  <div id="ip_change" class="collapse">
    <form action="change_ip_num.php" method="GET" id="form_ip">
      <div class="input-group">
        <br/><span style="font-size:15px">Input and Output files for each question.</span><br/><br/>
      <div class="row">
        <div class="col-lg-9"><input id="ip_no" type="text" class="form-control input-lg" name="ip_no" placeholder="No. of Input files"></div>
        <div class="col-lg-3"><button type="button" class="btn btn-md btn-warning" onclick="change_ip()">SAVE</button></div>
        <br/>
    </div>
    </div>
    </form>

</div>
</div>
      <div class="panel-footer text-center">
  <button class="btn btn-lg btn-success" data-toggle="collapse" data-target="#ip_change">CHANGE</button>

</div>
</div>
</div>
<div class="col-sm-4">
  <div class="panel panel-primary">
<div class="panel-heading text-center"><span style="font-size:22px">Number of Members in each team</span></div>
<div class="panel-body text-center"><h4><strong><?php echo $comp['no_members']; ?></strong></h4>
  <div id="mem_change" class="collapse">
    <form action="change_mem_num.php" method="GET" id="form_mem">
      <div class="input-group">
        <br/><span style="font-size:15px">Number of Members participating in each team.</span><br/><br/>
      <div class="row">
        <div class="col-lg-9"><input id="mem_no" type="text" class="form-control input-lg" name="mem_no" placeholder="No. of Members"></div>
        <div class="col-lg-3"><button type="button" class="btn btn-md btn-warning" onclick="change_mem()">SAVE</button></div>
        <br/>
    </div>
    </div>
    </form>

</div>
</div>
      <div class="panel-footer text-center">
  <button class="btn btn-lg btn-success" data-toggle="collapse" data-target="#mem_change">CHANGE</button>

</div>
</div>
</div>
  </div>
  <hr />
  <div class="row">
    <div class="col-md-6 text-center">
      <h3 class="text-center"><strong>Problems for the Competition</strong></h3><br/>
      <span>Clear all the problems files of the competition.</span><br/><br/>
      <button class="btn btn-lg btn-danger" onclick="verify_delete()">CLEAR PROBLEMS</button><br/><br/>
    </div>
    <div class="col-md-6 text-center">
      <h3 class="text-center"><strong>Input Files and Output Files</strong></h3><br/>
      <span>Clear all the input and output files of the competition.</span><br/><br/>
      <button class="btn btn-lg btn-danger" onclick="clear_all()">CLEAR FILES</button><br/><br/>
    </div>
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
<?php
if(isset($_GET['msg']))
{
  echo 'show_toast();';
}
?>
function change_name() {
  var name = $('#name').val();
  if(name=="") {
    $('#snackbar').html("Name of the competition cannot be empty");
    show_toast();
  }
  else {
    $('#snackbar').html("");
    $('#form_name').submit();
  }
}

function change_num() {
  var num=$('#no_ques').val();
  if(num=="") {
    $('#snackbar').html("Number of Questions cannot be empty.");
    show_toast();
  }
  else if(isNaN(num)) {
    $('#snackbar').html("Please enter a Number.");
    show_toast();
  }
  else {
    {
      $('#snackbar').html("");
      $('#form_num').submit();
    }
  }
}

function change_time() {
  var time=$('#time').val();
  if(time=="") {
    $('#snackbar').html("Duration cannot be empty.");
    show_toast();
  }
  else if(isNaN(time)) {
    $('#snackbar').html("Please enter a Number.");
    show_toast();
  }
  else {
    {
      $('#snackbar').html("");
      $('#form_time').submit();
    }
  }
}

function change_ip() {
  var num=$('#ip_no').val();
  if(num=="") {
    $('#snackbar').html("Number of Input files cannot be empty.");
    show_toast();
  }
  else if(isNaN(num)) {
    $('#snackbar').html("Please enter a Number.");
    show_toast();
  }
  else {
    {
      $('#snackbar').html("");
      $('#form_ip').submit();
    }
  }
}

function change_mem() {
  var mem=$('#mem_no').val();
  if(mem=="") {
    $('#snackbar').html("Number of Members cannot be empty.");
    show_toast();
  }
  else if(isNaN(mem)) {
    $('#snackbar').html("Please enter a Number.");
    show_toast();
  }
  else {
    {
      $('#snackbar').html("");
      $('#form_mem').submit();
    }
  }
}

</script>
</body>
</html>
