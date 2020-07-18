<?php
	include('connection.php');
	error_reporting(E_ALL ^ E_WARNING); 
	setcookie("team_name", "", time()-3600);
	setcookie("team_id", "", time()-3600);
	setcookie("comp_started", "", time()-3600);
	$query="UPDATE `comp_users_score` SET `submitted` = '1' WHERE `comp_users_score`.`team_id` = '".$_GET['team_id']."'";
	if($conn->query($query))
	{
		header("location:./../index.php?msg=khatam");
	}
	header("location:./../index.php?msg=khatam");
?>