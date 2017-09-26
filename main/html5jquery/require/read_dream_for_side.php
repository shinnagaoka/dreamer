<?php
	$sql ='SELECT * FROM `dr_dreams` WHERE `dream_id`=?';
	$data = array($read_login_users['now_dream_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$rdfs = $stmt->fetch(PDO::FETCH_ASSOC);
?>