<?php
	require_once("hack_api.php");
	include("connection.php");
	session_start();
	$obj=new HackApi;
	$source_code=$_POST['source_code'];
	$source_code=str_replace(';','&#59;',$source_code);
	
	$lang=$_POST['lang_select'];
	$problem_id=$_POST['problem_id'];
	$sql=$conn->query("SELECT * FROM problems WHERE id=".$problem_id);
	$result=$sql->fetch_assoc();
	$time_limit=$result['problem_time_limit'];
	$memory_limit=$result['problem_memory_limit'];
	$obj->set_client_secret("4e282a8f8bc82dcbceba414a1f58136d987a21bd"); //client secret key
	$query="SELECT * FROM comp_details WHERE 1";
	$results=$conn->query($query);
	$result=$results->fetch_assoc();
	$penalty_time=$result['penalty_time_min'];
	$penalty=$result['neg_marking'];
	$io_no=(int)$result['no_of_input_files'];
	for($i=1;$i<=$io_no;$i++)
	{
		$query="SELECT * from input_output_files where file_name='input".$problem_id."_".$i.".txt'";
		
		$results=$conn->query($query);
		$result=$results->fetch_assoc();
		$input=$result['file_content'];
		$obj->init($lang,$source_code,$input,$time_limit,$memory_limit);  //first id lang code , second is code to run , third is for input,fourth for time limit,n last for memoy limit
		$obj->compile();
		$data=array();
		if($obj->arr['compile_status'] == "OK")
		{
			$data['compilation']=true;
		}
		else
		{
			$data['compilation']=false;
			if($penalty == "yes")
			{
				$query="UPDATE comp_users_score SET penalty_".$problem_id." = penalty_".$problem_id." + ".$penalty_time." WHERE team_id = ".$_COOKIE['team_id'];
				if($conn->query($query))
				{
					$data['penalty']="added";
				}
			}
			break;
		}	
		$obj->run(); 
		$query="SELECT * from input_output_files where file_name='output".$problem_id."_".$i.".txt'";
		$results=$conn->query($query);
		$result=$results->fetch_assoc();
		$actual_output=preg_replace('/\s+/', '', $result['file_content']);
		$output=preg_replace('/\s+/', '', $obj->arr['output']);
		if($actual_output != $output)
		{
			if($penalty == "yes")
			{
				$query="UPDATE comp_users_score SET penalty_".$problem_id." = penalty_".$problem_id." + ".$penalty_time." WHERE team_id = ".$_COOKIE['team_id'];
				if($conn->query($query))
				{
					$data['penalty']="added";
				}
			}
			$data['extra']="in";
			$data['result']=$obj->arr;
			$data['result']['run_status']="WA";
			echo json_encode($data);	
			return;
		}
	}
	$data['extra']=$i;
	$data['result']=$obj->arr;
	echo json_encode($data);	
	return;

	

?>