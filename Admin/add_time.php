<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $t=$_GET['time']*60;
    $id=$_GET['id'];
    $sql="UPDATE comp_users_score SET comp_started = comp_started + ".$t." WHERE team_id='$id' ";
    if(mysqli_query($link,$sql)) {
      header("location:manage_users.php?msg=Time Added.");
      exit;
    }
    else {
      header("location:manage_users.php?msg=Error in incresing Time...");
      exit;
    }
?>
