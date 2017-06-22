<?php
	include('connection.php');
	error_reporting(E_ALL ^ E_WARNING); 
	session_destroy();
	$query="UPDATE `comp_users_score` SET `submitted` = '1' WHERE `comp_users_score`.`team_id` = '".$_GET['team_id']."'";
	if($conn->query($query))
	{
		header("location:./../index.php?msg=khatam");
	}
	header("location:./../index.php?msg=khatam");
?>