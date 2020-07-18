<?php 
	include('connection.php');
	$team_id=$_GET['team_id'];
	$problem_id=$_GET['problem_id'];
	$query="SELECT comp_started FROM comp_users_score WHERE team_id='".$team_id."'";
	$results=$conn->query($query);
	$result=$results->fetch_assoc();
	$comp_started=(int)$result['comp_started'];
	$time=time() - $comp_started;
	$query="SELECT `penalty_".$problem_id."` FROM comp_users_score WHERE team_id='".$team_id."'";
	$results=$conn->query($query);
	$result=$results->fetch_assoc();
	$penalty_time=(int)$result['penalty_'.$problem_id];
	$penalty_time=$penalty_time*60;
	$time=$time+$penalty_time;
	$query="UPDATE `comp_users_score` SET `problem_".$problem_id."` = '".$time."' WHERE `comp_users_score`.`team_id` = '".$team_id."'";
	$data=array();
	if($conn->query($query))
	{
		$data['success']=true;
	}
	else
	{
		$data['success']=false;
	}
	echo json_encode($data);
	return;
?>