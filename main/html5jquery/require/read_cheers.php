<?php
	$sql ='SELECT * FROM `dr_cheers` WHERE `user_id`=? ORDER BY `created` DESC';
	$data = array($user_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_cheers = array();
	while (true) {
	$read=$stmt->fetch(PDO::FETCH_ASSOC);
	if ($read==false) {
		break;
	}
	$read_cheers[]=$read;
	}
?>