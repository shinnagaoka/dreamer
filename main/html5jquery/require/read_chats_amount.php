<?php
require('../dbconnect.php');
$notification =0;
	$sql ='SELECT COUNT(*)AS`cnt` FROM `dr_chats` WHERE `dream_id`=?';
	$data = array($rd);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$record = $stmt->fetch(PDO::FETCH_ASSOC);
	$read_chats_amo = $record['cnt'];


	$sql ='SELECT * FROM `dr_users` WHERE `user_id`=?';
	$data = array($_SESSION['login_user']['user_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$ru = $stmt->fetch(PDO::FETCH_ASSOC);

	$chats_amo = $ru['chats_notification'];
	if ($read_chats_amo >= $chats_amo) {
		$notification = $read_chats_amo-$chats_amo;
		if (isset($reset) && $reset == 'reset') {
			$sql = 'UPDATE `dr_users` SET `chats_notification`=? WHERE `user_id`=?';
			$data = array($read_chats_amo,$_SESSION['login_user']['user_id']);
			$stmt = $dbh->prepare($sql);
			$stmt->execute($data);
		}
	}
?>