<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $sql="UPDATE comp_details SET no_of_input_files = '".$_GET['ip_no']."' WHERE 1";
    if(mysqli_query($link,$sql))
    {
      header("location:admin_panel.php?msg=Number of input files changed successfully.");
      exit;
    }
    else {
      header("location:admin_panel.php?msg=Error in changing Number of Input files.");
      exit;
    }
?>
