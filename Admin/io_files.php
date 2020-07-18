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
            <li><a href="prob_files.php"><span class="glyphicon glyphicon-file"></span> Manage Problem files</a></li>
            <li class="active"><a href="io_files.php"><span class="glyphicon glyphicon-transfer"></span> Manage Input-Output Files</a></li>
            <li><a href="manage_users.php"><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>
            <li><a href="export_data.php"><span class="glyphicon glyphicon-download-alt"></span> Export Data</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div class="col-sm-10 col-xs-12">
    <div class="container">
      <h3>Manage Input and Output Files here.</h3>
      <hr />
      <ul class="nav nav-tabs">
        <?php
        $flag=true;
        $i=1;
        while($i<=$comp['no_of_ques'])
          {
            ?>
            <li id="up<?php echo $i; ?>" ><a data-toggle="tab" href="#tab<?php echo $i; ?>">Problem Number <?php echo $i; ?></a></li>
          <?php
          $i++;
          }
        ?>
      </ul>
      <div class="tab-content">
        <?php
          for($i=1;$i<=$comp['no_of_ques'];$i++)
          {
        ?>
        <div class="tab-pane fade" id="tab<?php echo $i; ?>" >
        <br/>
          <div class="row">
            <div class="col-md-6">
              <h4 class="text-center">INPUT FILES</h4>
              <table class="table">
                <thead>
                  <tr>
                    <th>FILE NUMBER</th>
                    <th>FILE NAME</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $j=1;
                    while($j<=$comp['no_of_input_files'])
                    {
                      $sql=mysqli_query($link,"SELECT * FROM input_output_files WHERE file_name REGEXP '^input".$i."_".$j."'");
                      $num=mysqli_num_rows($sql);
                        if($num!=0) {
                        $f=mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <tr>
                    <td><?php echo $j; ?></td>
                    <td><?php if($num!=0) echo $f['file_name']; else echo '-----'; ?></td>
                    <td><button class="btn btn-<?php if($num==0) echo 'primary'; else echo 'success'; ?>" onclick="$('#ip_file_<?php echo $i."_".$j; ?>').click()"><?php if($num!=0) echo "CHANGE"; else echo "UPLOAD"; ?></button></td>
                    <form method="post" action="change_ip_file.php" id="ip_form_<?php echo $i.'_'.$j; ?>" enctype="multipart/form-data">
                      <input type="file" style="display:none" name="ip_file" id="ip_file_<?php echo $i."_".$j; ?>" onchange="$('#ip_form_<?php echo $i.'_'.$j; ?>').submit()"  />
                      <input type="hidden" value="<?php if($num!=0) echo "true"; else echo 'false'; ?>" name="change" />
                      <input type="hidden" value="<?php echo $i; ?>" name="prob_num" />
                      <input type="hidden" value="<?php echo $j; ?>" name="ip_num" />
                    </form>
                  </tr>
                  <?php
                      $j++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <h4 class="text-center">OUTPUT FILES</h4>
              <table class="table">
                <thead>
                  <tr>
                    <th>FILE NUMBER</th>
                    <th>FILE NAME</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $j=1;
                    while($j<=$comp['no_of_input_files'])
                    {
                      $sql=mysqli_query($link,"SELECT * FROM input_output_files WHERE file_name REGEXP '^output".$i."_".$j."'");
                      $num=mysqli_num_rows($sql);
                        if($num!=0) {
                        $f=mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <tr>
                    <td><?php echo $j; ?></td>
                    <td><?php if($num!=0) echo $f['file_name']; else echo '-----'; ?></td>
                    <td><button class="btn btn-<?php if($num==0) echo 'primary'; else echo 'success'; ?>" onclick="$('#op_file_<?php echo $i."_".$j; ?>').click()"><?php if($num!=0) echo "CHANGE"; else echo "UPLOAD"; ?></button></td>
                    <form method="post" action="change_op_file.php" id="op_form_<?php echo $i.'_'.$j; ?>" enctype="multipart/form-data">
                      <input type="file" style="display:none" name="op_file" id="op_file_<?php echo $i."_".$j; ?>"  onchange="$('#op_form_<?php echo $i.'_'.$j; ?>').submit()" />
                      <input type="hidden" value="<?php if($num!=0) echo 'true'; else echo 'false'; ?>" name="change" />
                      <input type="hidden" value="<?php echo $i; ?>" name="prob_num" />
                      <input type="hidden" value="<?php echo $j; ?>" name="op_num" />
                    </form>
                  </tr>
                  <?php
                      $j++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <hr />
      <div class="text-center">
        <h3><strong>Clear Input And Output Files</strong></h3><br/>
        <span>Clear All the input and output files for all the problems and re-upload them.</span><br/><br/>
        <button class="btn btn-lg btn-danger" onclick="clear_all()">CLEAR ALL</button>
      </div>
    </div>
  </div>
</div>
<div id="snackbar"><?php echo $_GET['msg']; ?></div>
<script>
$(document).ready(function () {
  var current=<?php  if(isset($_GET['active'])) echo $_GET['active']; else echo "1"; ?>;
  $('#up'+current).addClass("active");
  $('#tab'+current).addClass("active in");
})
<?php
if(isset($_GET['msg']))
{
  echo 'show_toast()';
}
?>
</script>
</body>
</html>
