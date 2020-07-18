<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
    include("connection.php");
    $r=mysqli_query($link,"SELECT * FROM comp_details WHERE 1");
    $a=mysqli_fetch_assoc($r);
      if($a['no_of_ques'] > $_GET['no_ques']) {
        $i=$a['no_of_ques'];
      while($i>$_GET['no_ques'])
      {
        mysqli_query($link,"ALTER TABLE comp_users_score DROP problem_".$i);
        mysqli_query($link,"ALTER TABLE comp_users_score DROP penalty_".$i);
        echo mysqli_error($link);
        $i--;
      }
    }
    else if($a['no_of_ques'] < $_GET['no_ques']) {
      $i=$a['no_of_ques'];
      while($i<$_GET['no_ques'])
      {
        $i++;
        mysqli_query($link,"ALTER TABLE comp_users_score ADD COLUMN problem_".$i." VARCHAR(20) AFTER problem_".($i-1));
        echo mysqli_error($link);
        echo "</br>";
        mysqli_query($link,"ALTER TABLE comp_users_score ADD COLUMN penalty_".$i." VARCHAR(20) AFTER penalty_".($i-1));
        echo mysqli_error($link);
      }
    }
    $sql="UPDATE comp_details SET no_of_ques = '".$_GET['no_ques']."' WHERE 1";
    if(mysqli_query($link,$sql))
    {
      header("location:admin_panel.php?msg=Number of questions changed successfully.");
      exit;
  }
    else {
      header("location:admin_panel.php?msg=Error in changing number of questions.");
      exit;
    }
?>
