<?php
session_start();
if(!isset($_SESSION['admin'])) {
  header("location:admin_login.php?msg=Please Login To continue.");
  exit;
}
include("connection.php");
$sql="TRUNCATE TABLE problems";
if(mysqli_query($link,$sql)) {
  header("location:prob_files.php?msg=All Problem Files Deleted.");
  exit;
}
else {
  header("location:prob_files.php?msg=Error in deleting files.");
  exit;
}
?>
