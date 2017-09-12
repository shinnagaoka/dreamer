<?php
	$user_id = $_SESSION['login_user']['user_id'];
	$sql = 'UPDATE `dr_dreams` SET `achieve_1`=?,`achieve_2`=?, `achieve_3`=? WHERE `dream_id`=? AND `user_id`=?';
	$data = array($achieve_1,$achieve_2,$achieve_3,$dream_id,$user_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
?>