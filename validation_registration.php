<?php include("connection.php");
$team_name=$_POST['team_name'];
$query='SELECT * FROM comp_users_score WHERE team_name="'.$team_name.'"';
$result=$conn->query($query);
$data=array();
if($result->num_rows > 0)
{
	$data['success']=false;
	echo json_encode($data);
	return;
}	
else
{
	$data['success']=true;
	echo json_encode($data);
	return;
}
?>