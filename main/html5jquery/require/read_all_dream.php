<?php
	$sql ='SELECT * FROM `dr_dreams` WHERE `category`=?';
	$data = array($_SESSION['dream_category']);
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