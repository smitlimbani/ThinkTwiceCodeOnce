<?php
if($_POST['username']=='admin' && $_POST['password']=='csi123') {
  session_start();
  $_SESSION['admin']="true";
  header("location:admin_panel.php");
}
else
  header("location:admin_login.php?msg=Incorrect Username or Password.");
?>
