<?php
	$sql ='SELECT * FROM `dr_chats` WHERE `dream_id`=?  ORDER BY `created` DESC';
	$data = array($rd);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_chats = array();
	while (true) {
		$record = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($record==0) {
			break;
		}
		$read_chats[] = $record;
	}
?>