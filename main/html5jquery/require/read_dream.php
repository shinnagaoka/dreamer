<?php
	$sql ='SELECT * FROM `dr_dreams` WHERE `dream_id`=?';
	$data = array($rd);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_dream = $stmt->fetch(PDO::FETCH_ASSOC);
?>