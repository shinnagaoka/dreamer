<?php
//require('../dbconnect.php');
//if (!empty($_POST)) {
	$sql ='SELECT * FROM `dr_users` WHERE `user_id`=?';
	$data = array($user_id);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($data);
	$read_users = $stmt->fetch(PDO::FETCH_ASSOC);
//	var_dump($read_users);
//}
?>
<!-- <!DOCTYPE html'>
<html lang="ja">
<head>
<meta charset="utf-8">
	<title></title>
</head>
<body>
<form method="post" action="">
	<input type="hidden" name="email" value="test@gmail.com">
	<input type="hidden" name="password" value="12345">
	<input type="submit" value="submit">


</form>
</body>
</html> -->