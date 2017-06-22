<?php include("header.php");?>	
	<div class="container">
	<?php 
		$sql="SELECT * FROM problems";
		$result=$conn->query($sql);
		
		while($data=$result->fetch_assoc()){
	?>
		<a href="problems.php?problem_id=<?php echo $data['id']?>"><?php echo $data['problem_title']?></a>
		<br>
	<?php		
		}
	?>
	</div>
<?php include("footer.php");?>