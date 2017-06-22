<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
  include("connection.php");
  $sql='TRUNCATE TABLE input_output_files';
  if(mysqli_query($link,$sql)) {
    header("location:io_files.php?msg=All files Deleted.");
    exit;
  }
  else {
    header("location:io_files.php?msg=Error in deleting all Files");
    exit;
  }
?>
