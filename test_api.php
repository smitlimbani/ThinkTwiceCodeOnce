<?php
	require_once('hack_api.php');
	
	$obj=new HackApi;
	$obj->set_client_secret("4e282a8f8bc82dcbceba414a1f58136d987a21bd"); //client secret key
	$obj->init("PYTHON","print 'hello'",null,1,null);  //first id lang code , second is code to run , third is for input,fourth for time limit,n last for memoy limit
	$obj->run(); //to compile $obj->compile();
	echo "<pre>";
	echo $obj->run_stderr;    //different data variables returned by hackerearth
	//echo $obj->time_limit; 
	//echo $obj->memory_limit; 
	echo $obj->signal; 		//to use them $object_name => variable_name(available in hack_api.php)
	echo $obj->output;		//prints output of the code
	echo "</pre>";
?>