<?php  
	include("connection.php");
	
	$query="SELECT comp_started FROM comp_users_score WHERE team_id='".$_GET['team_id']."'";
	$results=$conn->query($query);
	$result=$results->fetch_assoc();
	$data=array();
	if($result['comp_started'] == "none")
	{
		$data['status']=true;
	}
	else
	{
		$data['status']=false;
	}
	$data['time']=$result['comp_started'];
	$query="SELECT comp_time_hrs FROM comp_details WHERE 1";
	$results=$conn->query($query);
	$result=$results->fetch_assoc();
	$data['comp_time']=$result['comp_time_hrs'];
	echo json_encode($data);
	return;
?>