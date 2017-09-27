<?php
	$sql ='SELECT * FROM `dr_steps` WHERE `dream_id`=? ORDER BY `s_schedule` ASC';
	$data = array($rd);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_step = array();
	while (true) {
		$record = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($record==false) {
			break;
		}
		$read_step[] = $record;
	}
?>