<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $sql="UPDATE comp_details SET neg_marking = '".$_GET['neg_marking']."' WHERE 1";
    if(mysqli_query($link,$sql))
    {
      header("location:admin_panel.php?msg=Negative Marking is changed successfully.");
      exit;
    }
    else {
      header("location:admin_panel.php?msg=Error in changing Negative Marking.");
      exit;
    }
?>
