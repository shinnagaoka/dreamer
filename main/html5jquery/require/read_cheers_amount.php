<?php
	$sql ='SELECT COUNT(*)AS`cnt` FROM `dr_cheers` WHERE `dream_id`=?';
	$data = array($rd);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_cheers_amount = $stmt->fetch(PDO::FETCH_ASSOC);
?>