</body>
<script>
	$(document).ready(function(){
		$.ajax({
			 type: "get",
			 url: "get_time.php?team_id="+'<?php echo $_COOKIE['team_id'];?>',
			 dataType: "json",
			 success: function(data){
				console.log(data);
				if(!data.status)
				{
					setCookie("comp_started", data.time, 30);
					setCookie("comp_time", parseFloat(data.comp_time)*60*60, 30);
					// alert(parseFloat(data.comp_time)*60*60);
					// alert(data.time);
					setData();
					display();
				}
				else
				{
					alert('no data');
				}
			 } 
		});

	});
	
	function setData(){
		var timer=getCookie("comp_started");
		var comp_time=getCookie("comp_time");
		$('#timer_value').val(parseInt(timer)+parseInt(comp_time));
		$('#comp_time').val(comp_time);
	}
	function display()
	{
		var timer_value=$('#timer_value').val();
		var comp_time=$('#comp_time').val();
		timer_value=parseInt(timer_value);
		comp_time=parseInt(comp_time);
		var timeStamp = Math.floor(Date.now() / 1000);
		var left_time=timer_value-timeStamp;
		console.log(timer_value+"-"+timeStamp+"="+left_time);
		if(left_time <= 0)
		{
			alert("finish");
			window.location="khatam.php?team_id=<?php echo $_COOKIE['team_id'];?>";
		}
		var prog_bar=left_time*100/comp_time;
		prog_bar=parseInt(100-prog_bar);
		if(prog_bar >= 90)
		{
			changeToDanger();
		}
		$('#prog_bar').css("width",prog_bar+"%");
		var seconds = left_time % 60;
		var minutes = Math.floor(left_time / 60);
		var hours = Math.floor(minutes / 60);
		minutes %= 60;
		hours %= 60;
		timer(seconds,minutes,hours);

		setTimeout(function() {display()},1000);
	}
	function changeToDanger()
	{
		$('#prog_bar').removeClass();
		$('#prog_bar').addClass('progress-bar progress-bar-danger');
		
	}
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	//var timer_int=setInterval(timer,1000);
	function timer(sec,min,hr)
	{
		
		if(hr < 10)
		{
			$('#timer_hour').text("0"+hr+":");
		}
		else
		{
			$('#timer_hour').text(hr+":");
		}

		if(min < 10)
		{
			$('#timer_min').text("0"+min+":");
		}
		else
		{
			$('#timer_min').text(min+":");
		}

		if(sec < 10)
		{
			$('#timer_sec').text("0"+sec);
		}
		else
		{
			$('#timer_sec').text(sec);
		}
		
	}


</script>
</html>