<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $sql="UPDATE comp_details SET no_members = '".$_GET['mem_no']."' WHERE 1";
    if(mysqli_query($link,$sql))
    {
      header("location:admin_panel.php?msg=Number of Members changed successfully.");
      exit;
    }
    else {
      header("location:admin_panel.php?msg=Errot in changing Number of Members.");
      exit;
    }
?>
