<?php
	$sql ='SELECT * FROM `dr_tags` WHERE `dream_id`=?';
	$data = array($dream_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_tags = array();
	while (true) {
		$record = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($record==false) {
			break;
		}
		$read_tags[] = $record;
	}
?>