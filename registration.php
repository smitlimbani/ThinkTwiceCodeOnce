<?php 
include("connection.php");
include("header.php");
$query="SELECT * FROM comp_details";
$result=$conn->query($query);
$row=$result->fetch_assoc();
$no_members=(int)$row['no_members'];
?>
<div class="row">
	<div class="col-md-12">
		<div id="alert_input" style="display:none;font-size:1.2em;" class="alert alert-danger" role="alert" >
			<strong style="font-size:1.4em;">Warning!</strong>&emsp;<span id="error_text"></span> 
		</div>
	</div>
</div>
<div class="container">
	<form action="insert_team.php" id="submit_form" method="POST">
	  <input type="hidden" value="<?php echo $no_members;?>" name="no_members" id="no_members">
	  <div class="form-group">
		<label for="team_id">Slip Number:</label>
		<input type="number" name="team_id" class="form-control" id="team_id" required>
	  </div>
	  <?php for($i=1;$i<=$no_members;$i++) {?>
	  <div class="form-group">
		<label for="member_<?php echo $i;?>">Member <?php echo $i;?>:</label>
		<input type="text"  name="member_<?php echo $i;?>" class="form-control members" id="member_<?php echo $i;?>" required>
	  </div>
	  <?php }?>
	  <div class="form-group">
		<label for="username">Team/User Name:</label><br>
		<span id="team_name_valid" insert_valid="no" style="color:red;display:none;">Sorry! This Name Is Already Taken</span>
		<input type="text" name="username" class="form-control" id="username" required>
	  </div>
	  <div class="form-group">
		<label for="password">Password:</label>
		<input type="password" class="form-control" name="password" id="password" required>
	  </div>
	</form>
	  <div align="right">
		  <button id="insert_team" type="" class="btn btn-default">Submit</button>
	  </div>
</div>
<?php include("footer.php");?>
<script>

$('#insert_team').on("click",function(){
	//alert($('#team_name_valid').attr("insert_valid"));
	if($('#team_name_valid').attr("insert_valid") == "yes" && $('#team_id').val() != "" && $('.members').val() != "" && $('#username').val() != "" && $('#team_id').val() != "password")
	{
		$('#submit_form').submit();
	}
	else
	{
		if($('#team_id').val() == ""){
			$('#error_text').html("Slip no is not valid");
		}
		else if($('.members').val() == ""){
			$('#error_text').html("Member name is not valid");
		}
		else if($('#team_name_valid').attr("insert_valid") == "no"){
			$('#error_text').html("Team/User Name is not valid!");
		}
		else if($('#password').val() == ""){
			$('#error_text').html("Password is not valid");
		}
		$('#alert_input').show();
	}
});
$('#username').on("input",function(){
	//alert("in");
	//alert($("#username").val());
	$.ajax({
		 type: "POST",
		 url: "validation_registration.php",
		 data: {"team_name": $("#username").val()},	
		 dataType: "json",
		 success: function(data){
			console.log(data);
			 if(data.success) {
					$('#team_name_valid').css("display","none");
					$('#team_name_valid').attr("insert_valid","yes");
				} else {
					$('#team_name_valid').css("display","");
					$('#team_name_valid').attr("insert_valid","no");
			 }
		 }, 
	});
});

</script>