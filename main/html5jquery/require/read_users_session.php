<?php
//require('../dbconnect.php');
//if (!empty($_POST)) {
	$sql ='SELECT * FROM `dr_users` WHERE `email`=? AND `password`=?';
	$data = array($_COOKIE['email'],sha1($_COOKIE['password']));
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_users = $stmt->fetch(PDO::FETCH_ASSOC);
	$_SESSION['user_id']=$read_users['user_id'];
//}
?>