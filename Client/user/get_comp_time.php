<?php  
	include("connection.php");
	
	$query="SELECT comp_time_hrs FROM comp_details WHERE 1";
	$results=$conn->query($query);
	$result=$results->fetch_assoc();
	$data=array();
	$data['comp_time']=$result['comp_time_hrs'];
	echo json_encode($data);
	return;
?>