
<?php
	
	//if want to use compiler without API than it will look like this
	
	$arr='client_secret=4e282a8f8bc82dcbceba414a1f58136d987a21bd&source=print "hello"&lang=PYTHON';
	//echo $arr;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, 'https://api.hackerearth.com/v3/code/run/');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_POST,3);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$arr);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
//step3
//$result=curl_exec($ch);
//step4
	curl_close($ch);
//step5
//echo "hello";
	echo "<pre>";
	print_r(json_decode($response));
	echo "</pre>";
?>