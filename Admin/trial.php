<?php
include("connection.php");
$res=mysqli_query($link,"SELECT * FROM comp_users_score WHERE 1");
$a=mysqli_fetch_assoc($res);
$i=1;
echo $a['member_'.$i];
?>
