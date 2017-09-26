<?php

session_start();
require('../dbconnect.php');

$_SESSION['login_user']['user_id'];

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
require('../require/read_users_session.php');

$sql ='SELECT * FROM `dr_steps` WHERE `dream_id`=?';
$data = array($read_users['now_dream_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$read_step = array();
while (true) {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($record==false) {
    break;
  }
  $read_step[] = $record;
}

// echo '<pre>ポスト送信';
// var_dump($_POST);
// echo '</pre>';

if(!empty($_POST)){
 $c = count($_POST['step_contents']);
 //var_dump($c);

     //dr_stepsの更新
 for ($i=0; $i < $c ; $i++) {
  $sql = 'UPDATE `dr_steps` SET `step_contents`=?,`s_schedule`=?,`modified`= NOW() WHERE `dream_id`=? AND `step_id`=?';
  $data = array($_POST['step_contents'][$i],$_POST['s_schedule'][$i],$read_users['now_dream_id'],$read_step[$i]['step_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
}
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>edit_doneページ</title>
</head>
<body>
  <h1 style="color: #42a5f5;">ステップを修正しました。</h1>
  <a href="dashboard.php">マイページへ</a>

</body>
</html>