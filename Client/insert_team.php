<?php 
include("connection.php");

$no_members=intval($_POST['no_members']);
$sql='INSERT INTO `comp_users_score` (team_id , team_name ';
for($i=1 ; $i <= $no_members ;$i++)
{
	$sql.=', member_'.$i.' ';
}
$sql .= ', password) VALUES("'.$_POST['team_id'].'","'.$_POST['username'].'"';
for($i=1 ; $i <= $no_members ;$i++)
{
	$sql.=',"'.$_POST['member_'.$i].'"';
}
$sql.=',"'.$_POST['password'].'")';

if($conn->query($sql)){
	header("location:index.php?msg=added");
}
else
{
?>
<html>
<body>
<span>Entered Slip No is already Registered!</span>
<p>You will be redirected in <span id="counter">5</span> second(s).</p>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML) <= 1) {
        location.href = 'registration.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script>
</body>
</html>
<?php	
}
?>