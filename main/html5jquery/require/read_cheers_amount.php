<?php
	$sql ='SELECT COUNT(*)AS`cnt` FROM `dr_cheers` WHERE `user_id`=? AND `dream_id`=?';
	$data = array($user_id,$rd);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_cheers_amount = $stmt->fetch(PDO::FETCH_ASSOC);
?>