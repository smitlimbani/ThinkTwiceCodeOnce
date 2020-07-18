<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $sql="UPDATE comp_details SET name_of_comp = '".$_GET['name']."' WHERE 1";
    if(mysqli_query($link,$sql))
    {
      header("location:admin_panel.php?msg=Name of the competition changed successfully.");
      exit;
    }
    else {
      header("location:admin_panel.php?msg=Error in changing name.");
      exit;
    }
?>
