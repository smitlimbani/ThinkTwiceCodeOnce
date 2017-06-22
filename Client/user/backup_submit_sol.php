<?php include("header.php"); ?>
<style>
#quickview-load-img {
    position: fixed;
    top: 50%;
    left: 0;
    right: 0;
    bottom: 0;
    text-align: center;
    z-index: 9999;
    margin: auto;
}
#quickview-bg-block {
    background-color: rgba(0,0,0,0.9);
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    position: fixed;
    z-index: 9999;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div id="alert_lang" style="display:none;" class="alert alert-danger" role="alert" >
			<strong>Error!</strong><span id="error_text"></span> 
		</div>
	</div>
</div>
<div class="container">
	<form id="code_form" action="compile_run.php" method="post">
		<div class="form-group">
			<label for="source_code">Paste Your Code Here...</label>
			<textarea rows="20" class="form-control" id="source_code" rows="3" name="source_code"></textarea>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<div id="" style="width:'30%';" >
					<select id="lang_select" name="lang_select" class="form-control">
						<option value="none">Select Language</option>			
						<option value="C">C</option>			
						<option value="PHP">PHP</option>			
						<option value="PYTHON">Python</option>			
						<option value="CPP">Cpp</option>			
					</select>							
				</div>
			</div>
			
		</div>
	</form>
	<div class="row">
		<div class="col-md-1 col-md-offset-11">
			<button id="sub_code" name="sub_code" class="btn btn-primary">Submit</button>
		</div>
	</div>
	<br>
	<br>
	<br>
	<div id="output_details" style="display:none">
		<div class="panel panel-default" id="output_panel">
			<div class="panel-heading">
				<div class="row-fluid">
					<span style="padding-right:17%"><b>Status:</b><span id="output_status">Runtime Error</span></span>
					<span style="padding-right:22%"><b>Time:</b><span id="time_used">12.121</span>SEC</span>
					<b>Memory:</b><span id="memory_used">4561</span>B
			</div>
		
			</div>
			<div class="panel-body" >
				<span id="output_error_title" style="font-size:1.2em;">Anything:</span><br>
				<span id="output_error" ></span>
			</div>
		</div>
	</div>
</div>
<div id="quickview-bg-block" style="display:none;">
    
</div>
<div id="quickview-load-img" style="display:none;">
    <img src="img/loader.gif" alt="" width="50px">
	<h2 style="color:gray;">Running</h2>
</div>


<script>
$(document).on("click","#sub_code",function(e) {
	e.preventDefault();
	$('#output_panel').className = '';
	$('#output_details').hide();
	$('#quickview-bg-block').show();
	$('#quickview-load-img').show();
	var selected_lang=$('#lang_select').val();
	var source_code=$('#source_code').val();
	//alert(source_code);
	if(selected_lang != "none" && source_code != "")
	{
		//alert(selected_lang);
		//$("#code_form").submit();
		var post_data={"source_code": source_code , "lang_select":selected_lang , "problem_id": <?php echo $_GET['problem_id'];?>};
		$.ajax({
			 type: "POST",
			 url: "compile_run.php",
			 data: post_data,	
			 dataType: "json",
			 success: function(data){
				console.log(data);
				 if(data.compilation) {
						$('#quickview-bg-block').hide();
						$('#quickview-load-img').hide();
						$('#output_details').show();
						$('#output_status').text(data.result.run_status);
						$('#time_used').text(data.result.time_used);
						$('#memory_used').text(data.result.memory_used);
						if(data.result.run_status == "AC"){
							$('#output_error').html(data.result.output_html);
							$('#output_error_title').text("Output:");
							$('#output_panel').className = '';
							$('#output_panel').addClass('panel panel-success');
						}
						else{
							$('#output_error').text(data.result.run_stderr);
							$('#output_error_title').text("Error:");
							$('#output_panel').className = '';
							$('#output_panel').addClass('panel panel-warning');
						}
					} else {
						$('#quickview-bg-block').hide();
						$('#quickview-load-img').hide();
						$('#output_details').show();
						//alert('coudnt compile');
						$('#output_status').text('Compilation Error');
						$('#time_used').text('0');
						$('#memory_used').text('0');
						$('#output_error').text(data.result.compile_status);
						$('#output_error_title').text("Error:");
						$('#output_panel').className = '';
						$('#output_panel').addClass('panel panel-warning');
				 }
			 } 
		});
	}
	else if(selected_lang == "none")
	{
		//alert("none");
		$('#error_text').html(" Please Select Your Lang.");
		$("#alert_lang").css("display","block");
	}
	else
	{
		$('#error_text').html(" Please Paste Your code here.");
		$("#alert_lang").css("display","block");
	}

});
</script>
<?php include("footer.php"); ?>