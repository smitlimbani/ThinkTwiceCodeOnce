<?php include("header.php");?>	
	<div class="container" width="70%">
	<br>
	<br>
	<?php 
		$sql="SELECT * FROM problems";
		$result=$conn->query($sql);
	?>
	<div align="center">
	<table class="table table-bordered" style="width:60%">
		<thead>
		  <tr class="info">
			<th >PROBLEMS</th>
			<th style="width:30%;"><center>Successful Submissions</center></th>
		  </tr>
		</thead>
		<tbody>
	<?php
		while($data=$result->fetch_assoc()){
		$query="SELECT COUNT(*) as no FROM comp_users_score where problem_".$data['id']." != 0";
		$results=$conn->query($query);
		$no=$results->fetch_assoc();
	?>
		  <tr>
			<td><a href="problems.php?problem_id=<?php echo $data['id'];?>"><?php echo $data['problem_title'];?></a></td>
			<td><center><span class="badge badge-default badge-pill"><?php echo $no['no'];?></span></center></td>
		  </tr>
		
	<?php		
		}
	?>
		</tbody>
	</table>
	</div>
	</div>
<?php include("footer.php");?>