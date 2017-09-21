<?php
	$sql ='INSERT INTO `dr_cheers` SET `user_id`=?, `dream_id`=?, `created`=NOW()';
	$data = array($user_id,$dream_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
?>