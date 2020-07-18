<?php 
	$conn=new mysqli("127.0.0.1","root","","coding_portal");
	if($conn->connect_error)
	{
		die("Couldn't connect to database");
	}
?>