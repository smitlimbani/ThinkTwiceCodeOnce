<?php
  session_start();
  if(!isset($_SESSION['admin']))
    header("location:admin_login.php?msg=Please Login to continue.");
  include("connection.php");
  $id=$_GET['id'];
  echo '<div class="row">';
  echo '<div class="col-sm-2 col-xs-2"><strong>RANK</strong></div>';
  echo '<div class="col-sm-6 col-xs-6"><strong>TEAM NAME</strong></div>';
  echo '<div class="col-sm-4 col-xs-4"><strong>SCORE</strong></div><br/><br/>';
  echo '</div>';
  echo '<div class="row">';
  echo '<div id="list_data">';
  $data=array();
  $i=0;
  $q=mysqli_query($link,"SELECT * FROM comp_details WHERE 1");
  $d=mysqli_fetch_assoc($q);
  $num= $d['no_of_ques'];
  $q=mysqli_query($link,"SELECT * FROM comp_users_score WHERE 1");
  while($a=mysqli_fetch_assoc($q))
  {
    $i++;
    $time=$a['problem_1'];
    $score=0;
    for($j=1;$j<=$num;$j++) {
      if($a['problem_'.$j] != 0) {
        $score++;
      if($time>$a['problem_'.$j])
        $time=$a['problem_'.$j];
      }
    }
    $data[]=array("name" => $a['team_name'] , "id" => $a['team_id'] , "score" => $score , "time" => $time);
  }
  $total=$i;
  array_multisort(array_column($data, 'score'), SORT_DESC,
                array_column($data, 'time'), SORT_DESC,
                $data);
    if($total<$id)
      $id=$total;
    for($i=0;$i<$id;$i++) {
    echo '<div class="col-md-2 col-xs-2">'.($i+1).'</div>';
    echo '<div class="col-md-6 col-xs-6">'.$data[$i]['name'].'</div>';
    echo '<div class="col-md-4 col-xs-4">'.$data[$i]['score'].'</div>';
    echo '<br/><br/>';
  }
  echo '</div>';
  echo '</div>';
?>
