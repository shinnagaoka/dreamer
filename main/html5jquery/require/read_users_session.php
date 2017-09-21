<?php
//require('../dbconnect.php');
//if (!empty($_POST)) {
	$sql ='SELECT * FROM `dr_users` WHERE `user_id`=?';
	$data = array($_SESSION['login_user']['user_id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_login_users = $stmt->fetch(PDO::FETCH_ASSOC);
	$_SESSION['user_id']=$read_login_users['user_id'];
//}
?>