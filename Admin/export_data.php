<!DOCTYPE html>

<?php
/**
 * Created by PhpStorm.
 * User: Smit Limbani
 * Date: 6/19/2017
 * Time: 11:34 AM
 */
?>

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
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-xs-12">
            <div class="sidebar-nav">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".sidebar-navbar-collapse">
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
                            <li><a href="prob_files.php"><span class="glyphicon glyphicon-file"></span> Manage Problem
                                    files</a></li>
                            <li><a href="io_files.php"><span class="glyphicon glyphicon-transfer"></span> Manage
                                    Input-Output Files</a></li>
                            <li><a href="manage_users.php"><span class="glyphicon glyphicon-user"></span> Manage
                                    Users</a></li>
                            <li class="active"><a href="export_data.php"><span
                                        class="glyphicon glyphicon-download-alt"></span> Export Data</a></li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="col-sm-10 row">
            <div class="container-fluid">
                <h2 class="jumbotron" style="margin: 0px">Export data here.</h2>
                <br/><br/>

                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="col-xs-11 text-success">
                            Create a document for previous/current competition details.
                        </h4>
                        </br>
                        </br>
                        <form action="export_doc.php" method="post">
                            <div class="row">
                                <div class="col-xs-11">
                                    <input class="form-control input input-lg" type="text" name="filename"
                                           placeholder="preferred name">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-11">
                                    <button class="btn btn-lg btn-default btn-primary">Download</button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>

                    <div class="col-xs-6">
                        <h4 class="col-xs-11 text-success">
                            Create a Sheet for previous/current competition result.
                        </h4>
                        </br>
                        </br>
                        <form action="export_xls.php" method="post">
                            <div class="row">
                                <div class="col-xs-11">
                                    <input class="form-control input input-lg" type="text" name="filename" placeholder="preferred name">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-1">
                                    <h3>top</h3>
                                </div>
                                <div class="col-xs-4">
                                    <input class="input-lg form-control input" type="number" placeholder="all" name="selected">
                                </div>
                                <div class="col-xs-push-1 col-xs-4">
                                    <button class="btn btn-lg btn-default btn-primary">Download</button>
                                </div>
                            </div>
                            <br>
                        </form>
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
</div>
<div id="snackbar"><?php echo $_GET['msg']; ?></div>
<script>

</script>
</body>
</html>
