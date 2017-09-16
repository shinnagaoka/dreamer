<?php
	$sql ='SELECT COUNT(*)AS`cnt` FROM `dr_cheers` WHERE `dream_id`=? AND `user_id`=?';
	$data = array($rd,$_SESSION['login_user']['user_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_cheers_check = $stmt->fetch(PDO::FETCH_ASSOC);
?>