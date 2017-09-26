<?php
session_start();
require('../dbconnect.php');

$_SESSION['login_user']['user_id'];
require('../require/read_users_session.php');

$sql ='SELECT * FROM `dr_steps` WHERE `dream_id`=?';
	$data = array($read_login_users['now_dream_id']);
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


if(!empty($_POST)){
	$c = count($_POST['step_contents']);
	for ($i=0; $i <$c ; $i++) {
	$sql = 'INSERT  INTO `dr_steps` SET `dream_id`=?,`step_contents`=?, `s_schedule`=?,`daily_goal_contents`=?,`daily_time`=?,`created`=NOW()';
	$data = array($read_login_users['now_dream_id'],$_POST['step_contents'][$i],$_POST['s_schedule'][$i],$_POST['daily_goal_contents'],$_POST['daily_time']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	}
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>夢追加</title>
</head>
<body>
<h1 style="color: #42a5f5;">ショートステップの追加をしました。</h1>
  <a href="dashboard.php">マイページへ</a>
</body>
</html>