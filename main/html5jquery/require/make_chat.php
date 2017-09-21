<?php
	$user_id = $_SESSION['login_user']['user_id'];
	$sql = 'INSERT INTO `dr_chats` SET `dream_id`=?,
	`user_id`=?, `chats_contents`=?, `created`=NOW()';
	$data = array($dream_id,$user_id,$message);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
?>