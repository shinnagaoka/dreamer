<?php
session_start();
require('../dbconnect.php');
if(!isset($_SESSION['dream_info'])){
	echo 'register.phpで処理せずにアクセス！！！'.'<br>';
	header('Location: register.php');
	exit();
}


$_SESSION['login_user']['user_id'];
require('../require/read_users_session.php');


if (!empty($_POST)) {
	$dream_contents = $_SESSION['dream_info']['dream_contents'];
	$category = $_SESSION['dream_info']['category'];
//$tag = $_SESSION['dream_info']['tag'] ;
	$d_schedule = $_SESSION['dream_info']['d_schedule'];

	$_SESSION['dream_info']['step_contents'];
	$_SESSION['dream_info']['s_schedule'];

	$daily_goal_contents = $_SESSION['dream_info']['daily_goal_contents'];
	$daily_time = $_SESSION['dream_info']['daily_time'];
	$dream_image_path = $_SESSION['dream_info']['dream_image_path'];



	$c= count($_SESSION['dream_info']['step_contents']);

	//sql文作成(9/7から) → インサート処理
	//インサート処理（dr_dreamsテーブル） user_idを取得。（require）
	$sql = 'INSERT INTO `dr_dreams`SET `user_id`=?,`dream_contents`=?, `dream_image_path`=?, `category`=?, `d_schedule`=?,`created`=NOW()';
	$data = array($read_login_users['user_id'],$dream_contents,$dream_image_path,$category,$d_schedule);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);

	$sql ='SELECT * FROM `dr_dreams` WHERE`user_id`=? AND`dream_image_path`=?';
	$data = array($read_login_users['user_id'],$dream_image_path);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_dream = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($read_dream);

//インサート処理(dr_tagsテーブル) dream_idを取得。(require)
// $sql = 'INSERT INTO `dr_tags` SET `dream_id`=?,`tag_contents`=?, `created`=NOW()';
// $data = array($read_login_dream['dream_id'],$tag);
// $stmt = $dbh->prepare($sql);
// $stmt->execute($data);


//インサート処理(dr_stepsテーブル)
//セッションにcを入れる。jquery。

	for ($i=0; $i <$c ; $i++) {
		$sql = 'INSERT INTO `dr_steps`SET `dream_id`=?,`step_contents`=?, `s_schedule`=?, `daily_goal_contents`=?, `daily_time`=?, `created`=NOW()';
		$data = array($read_dream['dream_id'],$_SESSION['dream_info']['step_contents'][$i],$_SESSION['dream_info']['s_schedule'][$i],$daily_goal_contents,$daily_time);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);
	}



    //インサート処理(dr_usersテーブル)
	$sql ='SELECT * FROM `dr_dreams` WHERE `user_id`=? ORDER BY `created` DESC';
	$data = array($read_login_users['user_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_dream = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($read_dream);
	$now_dream_id = $read_dream['dream_id'];
	$sql = 'UPDATE `dr_users` SET `now_dream_id`=? WHERE `user_id`=?';
	$data = array($now_dream_id,$_SESSION['login_user']['user_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);




	header('Location: dashboard.php');
	exit();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<title>夢登録確認</title>
	<?php require('partial/head.php'); ?>
</head>
<body>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h1 style="color: #01579b;">夢登録確認</h1>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h4 style="color: #42a5f5;">①夢</h4>
				<?php echo $_SESSION['dream_info']['dream_contents'];?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h4 style="color: #42a5f5;">②カテゴリー</h4>
				<?php
				$cat = $_SESSION['dream_info']['category'];
				switch ($cat) {
					case 1:
					$cat = '仕事';
					break;
					case 2:
					$cat = '人間関係';
					break;
					case 3:
					$cat = '健康';
					break;
					case 4:
					$cat = '勉強';
					break;
					case 5:
					$cat = 'お金';
					break;
					case 6:
					$cat = 'その他';
					break;
				}
				echo $cat;
				?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h4 style="color: #42a5f5;">③夢達成 期限</h4>
				<?php echo $_SESSION['dream_info']['d_schedule'];?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h4 style="color: #42a5f5;">④ショートステップ</h4>
				<?php
				$step_cnt = count($_SESSION['dream_info']['step_contents']);
				$step_cnt = $step_cnt-1;
				$i = 0;
				echo "<ul>";
				while ($step_cnt >= $i) {
					echo "<li>";
					echo $_SESSION['dream_info']['step_contents'][$i];
					echo " ";
					echo $_SESSION['dream_info']['s_schedule'][$i];
					echo "</li>";
					$i ++;
				}
				echo "</ul>";
				?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h4 style="color: #42a5f5;">⑤毎日の課題</h4>
				<?php echo $_SESSION['dream_info']['daily_goal_contents'];?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h4 style="color: #42a5f5;">⑤毎日の時間</h4>
				<?php echo $_SESSION['dream_info']['daily_time'];?>時間
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<h4 style="color: #42a5f5;">⑥夢のイメージ画像</h4>
				<?php echo $_SESSION['dream_info']['dream_image_path'];?><br>
				<img src="dream_image/<?php echo $_SESSION['dream_info']['dream_image_path']; ?>" width="150">
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
					<form method="POST" action="">
						<input type="hidden" name="aaa" value="sss">
						<input type="button" value="戻る" onclick="history.back()" class="btn btn-lg btn-gradient btn-oval btn-info btn-block"><br>
						<button type="submit" class="btn btn-lg btn-gradient btn-oval btn-info btn-block">マイページへ</button>
					</form>
			</div>
		</div>
	</div>
<!-- <div class="container-fluid">
<h4 style="color: #42a5f5;">③タグ</h4>
</div>
<?php //echo $_SESSION['dream_info']['tag'];?><br><br><br> -->
</body>
<?php require('partial/script_links.php'); ?>
</html>
