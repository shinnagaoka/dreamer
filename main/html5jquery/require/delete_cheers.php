<?php
	$sql ='DELETE FROM `dr_cheers` WHERE `dream_id`=? AND `user_id`=?';
	$data = array($dream_id,$_SESSION['login_user']['user_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
?>