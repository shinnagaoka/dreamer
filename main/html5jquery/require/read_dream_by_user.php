<?php
	$sql ='SELECT * FROM `dr_dreams` WHERE `user_id`=? ORDER BY `created` DESC';
	$data = array($user_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_dream = array();
	while (true) {
		$record = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($record==false) {
			break;
		}
		$read_dream[] = $record;
	}
?>