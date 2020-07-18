<?php
  session_start();
  if(!isset($_SESSION['admin']))
      header("location:admin_login.php?msg=Please Login to continue.");
  include("connection.php");
  $prob=$_POST['prob_num'];
  $op=$_POST['op_num'];
  $name="op_file";
  if($_FILES[$name]['size']>0)
  {
    $f_name=$_FILES[$name]['name'];
    $info=new SplFileInfo($f_name);
    $new_name="output".$prob."_".$op;
    $file_name=$new_name.".".$info->getExtension();
    $file_type=$_FILES[$name]['type'];
    $file_size=$_FILES[$name]['size'];
    $file_tmp_name=$_FILES[$name]['tmp_name'];
    $fp = fopen($file_tmp_name, 'r');
    $content = fread($fp, filesize($file_tmp_name));
    $content = addslashes($content);
    fclose($fp);
  if($_POST['change']=="true") {
    $sql="UPDATE input_output_files SET file_type='".$file_type."' , file_name='".$file_name."' , file_content='".$content."' , file_size='".$file_size."' WHERE file_name REGEXP '^".$new_name."'";
  }
  else {
    $sql="INSERT INTO input_output_files (file_type,file_name,file_content,file_size) VALUES ( '".$file_type."' , '".$file_name."' , '".$content."' , '".$file_size."' )";
  }
  if(mysqli_query($link,$sql)) {
    header("location:io_files.php?msg=Output File Uploaded Successfully.&active=$prob");
    exit;
  }
  else {
    echo mysqli_error($link);
//    header("location:io_files.php?msg=Error in uploading Output File.Please Try Again.&active=$prob");
    exit;
  }
}
?>
