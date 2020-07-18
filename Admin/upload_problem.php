<?php
  session_start();
  if(!isset($_SESSION['admin']))
    header("location:admin_login.php?msg=false");
  include("connection.php");
  $title=$_POST['title'];
  $id=$_POST['id'];
  $mem_limit=$_POST['memory'];
  $time_limit=$_POST['time'];
  $name='prob_file';
  if($_FILES[$name]['size']>0)
  {
    $f_name=$_FILES[$name]['name'];
    $info=new SplFileInfo($f_name);
    $new_name="problem".$id;
    $file_name=$new_name.".".$info->getExtension();
    $file_type=$_FILES[$name]['type'];
    $file_size=$_FILES[$name]['size'];
    $file_tmp_name=$_FILES[$name]['tmp_name'];
    $fp = fopen($file_tmp_name, 'r');
    $content = fread($fp, filesize($file_tmp_name));
    $content = addslashes($content);
    fclose($fp);
    if($_POST['option']=="update") {
      $sql="UPDATE problems SET problem_name='$file_name' , problem_file_type='$file_type' , problem_file_content='$content' , problem_file_size='$file_size' , problem_title='$title' , problem_time_limit='$time_limit' , problem_memory_limit='$mem_limit' WHERE id='$id'";
    }
    else if($_POST['option']=="new") {
      $sql="INSERT INTO problems (id,problem_name,problem_file_type,problem_file_content,problem_file_size,problem_title,problem_time_limit,problem_memory_limit) VALUES ( '$id' , '$file_name' , '$file_type' , '$content' , '$file_size' , '$title' , '$time_limit' , '$mem_limit' )";
    }
    if(mysqli_query($link,$sql))
      {
      echo "DONE";
      header("location:prob_files.php?msg=Problem File has been uploaded successfully.");
      exit;
    }
    else {
      header("location:prob_files.php?msg=Error in uploading Problem File.");
      exit;
    }
  }
?>
