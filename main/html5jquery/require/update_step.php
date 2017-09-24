<?php
	$sql ='UPDATE `dr_steps` SET `achieve`=? WHERE `step_id`=?';
	$data = array('finish!',$step_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
?>