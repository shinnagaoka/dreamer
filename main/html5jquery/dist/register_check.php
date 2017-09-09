<?php
session_start();
require('dbconnect.php');
if(!isset($_SESSION['dream_info'])){
	echo 'register.phpで処理せずにアクセス！！！'.'<br>';
	header('Location: register.php');
	exit();
}
	if (!empty($_POST)) {
	$dream_contents = $_SESSION['dream_info']['dream_contents'];
	$category = $_SESSION['dream_info']['category'];
	$tag = $_SESSION['dream_info']['tag'] ;
	$year_achieve = $_SESSION['dream_info']['year_achieve'];
	$month_achieve = $_SESSION['dream_info']['month_achieve'] ;
	$day_achieve =  $_SESSION['dream_info']['day_achieve'];
	$step_contents = $_SESSION['dream_info']['step_contents'];
	$year_step = $_SESSION['dream_info']['year_step'];
	$month_step = $_SESSION['dream_info']['month_step'];
	$day_step = $_SESSION['dream_info']['day_step'];
    $way = $_SESSION['dream_info']['way']; //AかB？
    $daily_goal_contents = $_SESSION['dream_info']['daily_goal_contents'];
    $daily_time = $_SESSION['dream_info']['daily_time'];
    $dream_image_path = $_SESSION['dream_info']['dream_image_path'];


   	//3件一気にまとめたい↓
    $d_schedule = $year_achieve .'-' . $month_achieve . '-' .$day_achieve;
    $s_schedule = $year_step.'-' . $month_step . '-' .$day_steps;

	//sql文作成(9/7から) → インサート処理
	//インサート処理（dr_dreamsテーブル） user_idを取得したいけど出来てない。
   $sql = 'INSERT INTO `dr_dreams`SET `dream_contents`=?, `dream_image_path`=?, `category`=?, `d_schedule`=?,`created`=NOW()';
    $data = array($dream_contents,$dream_image_path,$category,$d_schedule);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    //インサート処理(dr_tagsテーブル) dream_idを取得したいけどできてない。
    //データ取得できず。
    $sql = 'INSERT INTO `dr_tags` SET `tag_contents`=?, `created`=NOW()';
    $data = array($tag);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    //インサート処理(dr_stepsテーブル) dream_idを取得したいけどできてない。
    //データ取得できず。
    $sql = 'INSERT INTO `dr_steps`SET `step_contents`=?, `s_schedule`=?, `daily_goal_contents`=?, `daily_time`=? `created`=NOW()';
    $data = array($step_contents,$s_schedule,$daily_goal_contents,$daily_time);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    //インサート処理(dr_evaテーブル) step_idを取得したいけどできてない。
    $sql = 'INSERT INTO `dr_evas`SET `way`=?,`created`=NOW()';
    $data = array($way);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);






    header('Location: dashboard.html');
    exit();

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>夢登録確認</title>
</head>
<body>
	<div style="margin-top : 100px">
		<div style="margin-right : 300px">
			<div style="margin-bottom : 300px">
				<div style="margin-left : 300px">


					<div class="container-fluid">
						<h1 style="color: #01579b;">夢登録確認仮２</h1>
					</div><br>

					<div class="container-fluid">
						<h4 style="color: #42a5f5;">①夢</h4>
					</div>
					<?php echo $_SESSION['dream_info']['dream_contents'];?><br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">②カテゴリー</h4>
					</div>
					<?php echo $_SESSION['dream_info']['category'];?><br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">③タグ</h4>
					</div>
					<?php echo $_SESSION['dream_info']['tag'];?><br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">④夢達成 期限</h4>
					</div>
					<?php echo $_SESSION['dream_info']['year_achieve'];?>年
					<?php echo $_SESSION['dream_info']['month_achieve'];?>月
					<?php echo $_SESSION['dream_info']['day_achieve'];?>日<br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">⑤小ステップ</h4>
					</div>
					<?php echo $_SESSION['dream_info']['step_contents'];?><br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">⑤小ステップ 期限</h4>
					</div>
					<?php echo $_SESSION['dream_info']['year_step'];?>年
					<?php echo $_SESSION['dream_info']['month_step'];?>月
					<?php echo $_SESSION['dream_info']['day_step'];?>日<br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">⑥自己評価方法</h4>
					</div>
					<?php echo $_SESSION['dream_info']['way'];?><br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">⑥毎日の課題</h4>
					</div>
					<?php echo $_SESSION['dream_info']['daily_goal_contents'];?><br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">⑥毎日の時間</h4>
					</div>
					<?php echo $_SESSION['dream_info']['daily_time'];?>時間<br><br><br>
					<div class="container-fluid">
						<h4 style="color: #42a5f5;">⑦夢のイメージ画像</h4>
					</div>
					<?php echo $_SESSION['dream_info']['dream_image_path'];?><br><br>
					<img src="dream_image/<?php echo $_SESSION['dream_info']['dream_image_path']; ?>" width="150"><br><br><br>

					<form method="POST" action="">
						<input type="hidden" name="aaa" value="sss">
						<input type="button" value="戻る" onclick="history.back()" class="btn btn-primary btn-lg"><br>
						<input type="submit" value="マイページへ" class="btn btn-info btn-lg">
					</form>

				</div>
			</div>
		</div>
	</div>

	<!-- dream_imageフォルダ作成 -->



</body>
</html>



