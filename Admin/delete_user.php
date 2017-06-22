<?php
session_start();
if(!isset($_SESSION['admin']))
    header("location:admin_login.php?msg=Please Login to continue.");
  include("connection.php");
  if(mysqli_query($link,"DELETE FROM comp_users_score WHERE team_id='".$_GET['id']."'")) {
    header("location:manage_users.php?msg=Team Deleted.");
    exit;
  }
  else {
    header("location:manage_users.php?msg=Error in deleting team.");
    exit;
  }

?>
