<?php
// require('../dbconnect.php');
// $sum_time ='2017-02-12 00:15:05';
// $_SESSION['login_user']['user_id'] = 1;

	//$sum_time='';
	$date = explode(' ',$sum_time);
	$sum_time = $date[1];
	$date=$date[0];
	$sql ='INSERT INTO `dr_evas` SET `dream_id`=?, `time`=?, `date`=?, `created`=NOW()';
	$data = array($dream_id,$sum_time,$date);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
?>