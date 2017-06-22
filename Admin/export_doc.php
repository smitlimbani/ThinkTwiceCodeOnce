<?php
/**
 * Created by PhpStorm.
 * User: Smit Limbani
 * Date: 6/19/2017
 * Time: 2:15 PM
 */

$file_name = $_POST['filename'].".doc";
if(file_exists($file_name))
{
    unlink($file_name);
}

$handle = fopen($file_name, 'a') or die("Cannot open file ".$file_name);

include 'connection.php';

$sql_comp_details = "SELECT * FROM comp_details";

$result_comp_details = mysqli_query($link, $sql_comp_details);
$comp_details = mysqli_fetch_assoc($result_comp_details);

$st1 = "Competition Name : ".$comp_details['name_of_comp'].PHP_EOL;
$st2 = "No. of Question : ".$comp_details['no_of_ques'].PHP_EOL;

fwrite($handle, $st1);
fwrite($handle, PHP_EOL);
fwrite($handle, $st2);
fwrite($handle, PHP_EOL);

$st3 = "Below are the participants with their scores.".PHP_EOL;

fwrite($handle, $st3);

$sql_comp_users_score = "SELECT * FROM comp_users_score";

$result_comp_users_score = mysqli_query($link, $sql_comp_users_score);
//echo mysqli_num_rows($result_comp_users_score);
$user_score_list="Team Id \t Team Name";
for($j=1; $j <= $comp_details['no_members']; $j++)
{
    $user_score_list.=" \t member_".$j;
}
$user_score_list.=PHP_EOL.PHP_EOL;
$i = 1;
while($comp_users_score = mysqli_fetch_assoc($result_comp_users_score))
{
    $user_score_list.=$comp_users_score['team_id']." \t ".$comp_users_score['team_name'];
    for($j=1; $j <= $comp_details['no_members']; $j++)
    {
        $user_score_list.=" \t ".$comp_users_score["member_$j"];
    }
    $user_score_list.=PHP_EOL;

    $i++;
}

fwrite($handle, PHP_EOL);
fwrite($handle, $user_score_list);
echo $user_score_list;
header("Location: download_exported_file.php?filename=".$file_name);
?>