<?php 
include("connection.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$query='SELECT * FROM comp_users_score WHERE team_name = "'.$username.'"';
	//echo $query;
	$results = $conn->query($query);
	if($results->num_rows > 0 )
	{
		$row=$results->fetch_assoc();
		if($row['password'] == $password and (int)$row['submitted'] == 0)
		{
			//session_start();
			//$_SESSION['team_name']=$username;
			//$_SESSION['team_id']=$row['team_id'];
			setcookie('team_name');
			setcookie('team_id');
			setcookie('team_name', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
			setcookie('team_id', $row['team_id'], time() + (86400 * 30), "/"); // 86400 = 1 day
			$query="SELECT comp_started FROM comp_users_score WHERE team_id='".$row['team_id']."'";
			$results=$conn->query($query);
			$result=$results->fetch_assoc();
			if($result['comp_started'] == "none")
			{
				$query="UPDATE `comp_users_score` SET `comp_started` = '".time()."' WHERE `comp_users_score`.`team_id` = '".$row['team_id']."'";
				if($conn->query($query))
				{
					setcookie('comp_started', time(), time() + (86400 * 30), "/"); // 86400 = 1 day
					header("location:user/index.php");				
				}
				else
				{
					header('location:index.php?msg=wrong');
				}
			}
			else
			{
				setcookie('comp_started',$result['comp_started'], time() + (86400 * 30), "/"); // 86400 = 1 day
				header("location:user/index.php");
			}
			
		}
	}
	else
	{
		header('location:index.php?msg=wrong');
	}
}

?>