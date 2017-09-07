<?php
	$sql ='SELECT * FROM `dr_evas` WHERE `user_id`=?';
	$data = array($user_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_users = $stmt->fetch(PDO::FETCH_ASSOC);
?>