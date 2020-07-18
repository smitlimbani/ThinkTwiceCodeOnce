<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $sql="TRUNCATE TABLE comp_users_score";
    if(mysqli_query($link,$sql)) {
      header("location:manage_users.php?msg=All the User Data Deleted.");
      exit;
    }
    else {
      header("location:manage_users.php?msg=Error in removing all user data.Please Try Again.");
      exit;
    }
?>
