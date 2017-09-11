<?php
$sql ='SELECT COUNT(*)AS`cnt` FROM `dr_users` WHERE `email`=? AND `password`=?';
$data = array($_SESSION['login_user']['email'],sha1($_SESSION['login_user']['password']));
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$login_checked_user = $stmt->fetch(PDO::FETCH_ASSOC);
?>