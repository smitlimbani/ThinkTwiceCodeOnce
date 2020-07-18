<?php
/**
 * Created by PhpStorm.
 * User: Smit Limbani
 * Date: 6/19/2017
 * Time: 2:15 PM
 */

include 'connection.php';


$sql_comp_details = "SELECT * FROM comp_details";

$result_comp_details = mysqli_query($link, $sql_comp_details);
$comp_details = mysqli_fetch_assoc($result_comp_details);

$file_name = $_POST['filename'].".xls";
if(file_exists($file_name))
{
    unlink($file_name);
}

$handle = fopen($file_name, 'a') or die("Cannot open file ".$file_name);

$sql_comp_users_score = "SELECT * FROM comp_users_score ORDER BY(";
for($j=1; $j<= $comp_details['no_of_ques']; $j++)
{
    $sql_comp_users_score.="IF(problem_$j = 0, 0, 1)+";
}
$sql_comp_users_score=rtrim($sql_comp_users_score, "+");

$sql_comp_users_score.=") DESC, (";
for($j=1; $j<= $comp_details['no_of_ques']; $j++)
{
    $sql_comp_users_score.="problem_$j+";
}
$sql_comp_users_score=rtrim($sql_comp_users_score, "+");

$sql_comp_users_score.=") ASC";

$result_comp_users_score = mysqli_query($link, $sql_comp_users_score);
//echo mysqli_num_rows($result_comp_users_score);
$user_score_list="Rank \t Team Id \t Team Name".PHP_EOL.PHP_EOL;
$i = 1;
if($_POST['selected'] < mysqli_num_rows($result_comp_users_score) && $_POST['selected'] > 0)
{
    $count = $_POST['selected'];
}
else
{
    $count = mysqli_num_rows($result_comp_users_score);
}
while($count--)
{
    $comp_users_score = mysqli_fetch_assoc($result_comp_users_score);
    $user_score_list.=$i." \t ".$comp_users_score['team_id']." \t ".$comp_users_score['team_name'].PHP_EOL;
    $i++;
}

fwrite($handle, PHP_EOL);
fwrite($handle, $user_score_list);
//echo $sql_comp_users_score;
//echo $user_score_list;
header("Location: download_exported_file.php?filename=".$file_name);
?>