<?php
		session_start();
		require('../dbconnect.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div>
<?php
// dr_dreamsテーブルからdreamを全件取得
		$sql ='SELECT * FROM `dr_dreams` WHERE 1';
		$data = array();
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);

		// 空の配列を用意
		$dreams = array();
		while (true) {
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($record == false) {
				break;
			}
			$dreams[] = $record;
		}
//夢全件取得完了！！

// 夢ごとに必要なデータを取得する
		foreach ($dreams as $dream) {
				$dr_user_id = $dream['user_id'];
// dr_usersテーブルから、dreamのuser_idと一致するユーザーのデータを全件取得
				$sql ='SELECT * FROM `dr_users` WHERE `user_id`=?';
				$data = array($dr_user_id);
				$stmt = $dbh->prepare($sql);
				$stmt->execute($data);
				$user = $stmt->fetch(PDO::FETCH_ASSOC);
				$rd =$dream['dream_id'];
				$sql ='SELECT COUNT(*) AS `cnt` FROM `dr_cheers` WHERE `dream_id`=?';
				$data = array($rd);
				$stmt = $dbh->prepare($sql);
				$stmt->execute($data);
				$read_cheers_amount = $stmt->fetch(PDO::FETCH_ASSOC);
				echo '----------------------<br>';
				echo $dream['dream_id'].'<br>';
				echo $dream['d_schedule'].'<br>';
				echo $dream['dream_contents'].'<br>';
				echo $dream['dream_image_path'].'<br>';
				echo $user['user_name'].'<br>';
				echo $user['profile_image_path'].'<br>';
				echo $read_cheers_amount['cnt'].'<br>';
			}
?>
</div>
</body>
</html>

									$errors=array();
									if(!isset($target)){
										  $errors['target'] = 'blank';
										}