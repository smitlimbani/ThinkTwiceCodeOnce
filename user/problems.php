<?php include("header.php");?>
	<div class="container">
		<?php 	
			if(isset($_GET['problem_id']) && $_GET['problem_id'] != ""){	
				$sql="select * from problems where id=".$_GET['problem_id'];
				$result=$conn->query($sql);
				$data=$result->fetch_assoc();
		?>
		<div>
			<h2><?php echo $data['problem_title']?></h2>
		</div>
		<div class="well well-lg">
			<?php echo nl2br($data['problem_file_content']);?>
		</div>
		<div class="row text-right" >
			<div class="col-md-2 col-md-offset-10">
				<a class="btn btn-primary" href="<?php echo 'submit_sol.php?problem_id='.$data['id'];?>">Submit</a>
			</div>
		</div>
		<?php
			}	
		?>
		
	</div>
<script>
	
</script>
<?php include("footer.php");?>