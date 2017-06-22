<?php 
	include('connection.php');
	$query="UPDATE `comp_users_score` SET `comp_started` = '".time()."' WHERE `comp_users_score`.`team_id` = '".$_GET['team_id']."'";
	$data=array();
	if($conn->query($query))
	{
		$data['success']=true;
	}
	else
	{
		$data['success']=false;
	}
?>