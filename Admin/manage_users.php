<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $sql="SELECT * FROM comp_details WHERE 1";
    $res=mysqli_query($link,$sql);
    $comp=mysqli_fetch_assoc($res);
    $num=$comp['no_members'];
    $prob=$comp['no_of_ques'];
    $res=mysqli_query($link,"SELECT * FROM comp_users_score");
    $total=mysqli_num_rows($res);
 ?>
<html>
<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
  <style>
  .scroll {
    height:18em;
    overflow-y:auto;
  }
  .score {
    height:20em;
    overflow-y:auto;
    overflow-x:hidden;
  }
  #list_data {
    height:20em;
    overflow-y:auto;
    overflow-x:hidden;
  }
  </style>
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
            <li><a href="prob_files.php"><span class="glyphicon glyphicon-file"></span> Manage Problem files</a></li>
            <li><a href="io_files.php"><span class="glyphicon glyphicon-transfer"></span> Manage Input-Output Files</a></li>
            <li class="active"><a href="manage_users.php"><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>
            <li><a href="export_data.php"><span class="glyphicon glyphicon-download-alt"></span> Export Data</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-10 col-xs-12">
    <div class="container">
      <h2>Manage the Team and Users Here</h2>
      <span class="text-primary">You can view the teams here along with the members and delete teams as per your choice<br/>You can also increasing the duration of the competition for a particular team.</span>
      <div class="btn-group pull-right">
      <button class="btn btn-lg btn-warning" data-toggle="modal" data-target="#add_all">ADD TIME TO ALL</button>
      <button class="btn btn-lg btn-danger" onclick="remove_all()">REMOVE ALL</button>
    </div>
    <div id="add_all" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Increase Competition Duration</h4>
          </div>
          <div class="modal-body">
            Add time to the Competition Time of the <strong>all the teams</strong><br/><br/>
            <form action="add_time_all.php" method="GET" id="form_add_all">
              <div class="form-group col-md-8">
                <input class="form-control" type="text" placeholder="Enter Time(in minutes)" name="time" id="time_all"/>
              </div>
            <div class="form-group">
              <button class="btn btn-primary" type="button" onclick="add_time_all()">ADD TIME</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <br/><br/>
      <hr />
      <h4 class="text-success">Total Teams : <strong><?php echo $total; ?></strong></h4/>
      <div class="scroll">
      <table class="table table-striped table-condensed">
        <thead>
          <tr>
            <th>Team ID</th>
            <th>Team Name</th>
            <?php
            $i=1;
            while($i<=$num)
            {
            ?>
              <th>Member <?php echo $i++;?></th>
            <?php
            }
            ?>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($user=mysqli_fetch_assoc($res))
          {
          ?>
          <tr>
            <td><?php echo $user['team_id']; ?></td>
            <td><?php echo $user['team_name']; ?></td>
            <?php
            $i=1;
              while($i<=$num)
              {
                  echo "<td>".$user['member_'.$i]."</td>";
                  $i++;
              }
            ?>
            <td>
              <div class="btn-group pull-right">
                <button class="btn btn-warning" data-toggle="modal" data-target="#add_<?php echo $user['team_id']; ?>">ADD TIME</button>
                <a class="btn btn-danger" href="delete_user.php?id=<?php echo $user['team_id']; ?>">REMOVE</a>
              </div>

            </td>
          </tr>
          <div id="add_<?php echo $user['team_id']; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Time</h4>
                </div>
                <div class="modal-body">
                  Add time to the Competition Time of the team <strong><?php echo $user['team_name']; ?></strong><br/><br/>
                  <form action="add_time.php" method="GET" id="form_add_<?php echo $user['team_id']; ?>">
                    <input type="hidden" value="<?php echo $user['team_id']; ?>" name="id" />
                    <div class="form-group col-md-8">
                      <input class="form-control" type="text" placeholder="Enter Time(in minutes)" id="time<?php echo $user['team_id']; ?>" name="time"/>
                    </div>
                  <div class="form-group">
                    <button class="btn btn-primary" type="button" onclick="add_time(<?php echo $user['team_id']; ?>)">ADD TIME</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
           ?>
        </tbody>
      </table>
    </div>
    <hr />
    <div class="text-center">
    <h3>RANKINGS</h3>
    <span class="text-primary">You can see the scores of all the users in the ongoing competition.<br/>Further you can also obtain the ranklist i.e TOP 5 or TOP 10 according to your choice. </span>
    <br/><br/>
    <div class="row">
      <div class="col-sm-6 col-xs-12">
        <h4 class="">SCORE BOARD</h4>
        <div class="row">
          <div class="col-md-6">
            <strong>TEAM NAME</strong>
          </div>
          <div class="col-md-6">
            <strong>SCORE</strong>
          </div>
        </div>
        <br/>
        <div class="score" id="score">
          <?php
          $sql=mysqli_query($link,"SELECT * FROM comp_users_score WHERE 1");
          while($sc=mysqli_fetch_assoc($sql))
          {
            $score=0;
            for($i=1;$i<=$prob;$i++) {
              if($sc['problem_'.$i] != 0)
                $score++;
            }
          ?>
          <div class="row">
          <div class="col-md-6">
            <?php echo $sc['team_name']; ?>
          </div>
          <div class="col-md-6">
            <?php echo $score; ?>
          </div>
        </div>
        <br/>
        <?php
        }
        ?>
      </div>
      <button class="btn btn-success" onclick="refresh_list()"><span class="glyphicon glyphicon-refresh"></span> REFRESH</button><br/><br/>
      </div>
      <div class="col-sm-6 col-xs-12">
        <h4 class="text-center">LEADER BOARD</h4>
        <span class="text-muted">Enter the criteria here.</span><br/><br/>
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
        <input class="form-control" id="top" placeholder="TOP" onchange="top_users()" />
      </div>
      </div>
      <br/>
      <div id="list">
      </div>
      </div>
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
  function top_users() {
    var id=$('#top').val();
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("list").innerHTML=this.responseText;
      }
    }
    xmlhttp.open("GET","fetch_top_users.php?id="+id,true);
    xmlhttp.send();
  }
  function add_time(id) {
    var t=$('#time'+id).val();
    if(isNaN(t)) {
      $('#snackbar').html("Please Enter a Valid Number...!!!");
      show_toast();
    }
    else {
      $('#form_add_'+id).submit();
    }
  }
  function add_time_all() {
    var t=$('#time_all').val();
    if(isNaN(t)) {
      $('#snackbar').html("Please Enter a Valid Number...!!!");
      show_toast();
    }
    else {
      $('#form_add_all').submit();
    }
  }
  function refresh_list() {
    $("#score").load(location.href + " #score");
  }
  function remove_all() {
    var x=confirm("Are you sure you want to remove all the teams?");
    if(x) {
      location.href="remove_all.php";
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
