<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $sql="UPDATE comp_details SET comp_time_hrs = '".$_GET['time']."' WHERE 1";
    if(mysqli_query($link,$sql))
    {
      header("location:admin_panel.php?msg=Competition Duration changed successfully");
      exit;
    }
    else {
      header("location:admin_panel.php?msg=Error in changing Duration.");
      exit;
    }
?>
