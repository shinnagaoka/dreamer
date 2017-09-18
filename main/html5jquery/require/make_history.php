<?php
require('../dbconnect.php');
	$user_id=1;
	$dream_id=1;
	$this_dream_id = $dream_id;
	$make='';
	date_default_timezone_set('Asia/Manila');
	$sql ='SELECT * FROM `dr_histories` WHERE `user_id`=?AND`dream_id`=? ORDER BY `created` DESC';
	$data = array($user_id,$dream_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$history = $stmt->fetch(PDO::FETCH_ASSOC);
		if (empty($history['created'])) {
			$make = 'make';
		}else{
		// echo 'now  '.date('Y-m-d H:i:s').'<br>';
		// echo 'history  '.$history['created'].'<br>';
		$today = date('YmdH');
		// echo $today.'<br>';
		$target_day = $history['created'];
		$Ymd = explode(' ',$target_day);
		$H = explode(':',$Ymd[1]);

		$Ymd = explode('-',$Ymd[0]);
		// var_dump($Ymd);
		// echo "<br>";
		$Ymd = $Ymd[0].$Ymd[1].$Ymd[2];

		$target_day = $Ymd.$H[0];
		// $target_day = $target_day[0];
		// $target_day = implode($target_day);
		// echo $target_day;
		if($today == $target_day){
			$make = 'made today';
		}
		elseif ($today >= $target_day) {
			$make = 'make';
		}
		else{
			echo "ターゲット日付は未来です<br>";
		}
	}
	// if (empty($read_history)) {
	// 	$make = 'make';
	// }
	if ($make=='make') {
		$sql ='INSERT INTO `dr_histories` SET `user_id`=?, `dream_id`=?, `created`=NOW()';
		$data = array($user_id,$this_dream_id);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);
	}
?>