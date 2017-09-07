<?php
	session_start();
	require('dbconnect.php');

	if(!isset($_SESSION['user_info'])){
		echo 'signup.phpで処理せずにアクセス！！！'.'<br>';
		header('Location: signup.php');
		exit();
	}

	//ユーザー登録ボタンが押された際の処理
	if (!empty($_POST)) {

		$user_name = $_SESSION['user_info']['user_name'];
		$email = $_SESSION['user_info']['email'];
		$password = $_SESSION['user_info']['password'];
		$profile_image_path = $_SESSION['user_info']['profile_image_path'];

		$sql = 'INSERT INTO `dr_users` SET `user_name`=?,
																		`email`=?,
																		`password`=?,
																		`profile_image_path`=?,
																		`created` = NOW()';
		$data = array($user_name,$email,sha1($password),$profile_image_path);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);

		header('Location: signin.php');
		exit();
	}
	?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Bootstrap Admin Template">
	<meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
	<title>確認画面</title>
	<!-- Animate.CSS-->
	<link rel="stylesheet" href="vendor/animate.css/animate.css">
	<!-- Bootstrap-->
	<link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.min.css">
	<!-- Ionicons-->
	<link rel="stylesheet" href="vendor/ionicons/css/ionicons.css">
	<!-- Material Colors-->
	<link rel="stylesheet" href="vendor/material-colors/dist/colors.css">
	<!-- Application styles-->
	<link rel="stylesheet" href="css/app.css">
</head>
<body>
	<div class="layout-container">
		<div class="page-container bg-blue-grey-900">
			<div class="d-flex align-items-center align-items-center-ie bg-light-blue-300">
				<div class="fw">
					<div class="container container-xs">
						<div class="cardbox-heading">
							<div class="cardbox-title text-center" style="font-size: 20px">登録内容確認</div><br>
						</div>
						<div class="cardbox-body text-center" style="font-size: 20px">
							<p>ユーザー名:<?php echo htmlspecialchars($_SESSION['user_info']['user_name']);?></p>
							<p>メールアドレス:<?php echo htmlspecialchars($_SESSION['user_info']['email']);?></p>
							<p>パスワード:●●●●●●●	</p>
							<img src="img/user/<?php echo $_SESSION['user_info']['profile_image_path']; ?>" width="150"><br><br>
						</div>
						<form method="POST" action="" class="text-center"><!-- このinput hiddenのname、valueはなんでも良い -->
							<input type="hidden" name="action" value="submit">  <!-- これがないと上のif(!empty($_POST))が反応しなくなる -->
							<input class="btn btn-lg btn-gradient btn-oval btn-info btn-block" type="submit" value="夢登録へ">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

						<!-- Modernizr-->
					<script src="vendor/modernizr/modernizr.custom.js"></script>
					<!-- jQuery-->
					<script src="vendor/jquery/dist/jquery.js"></script>
					<!-- Bootstrap-->
					<script src="vendor/tether/dist/js/tether.min.js"></script>
					<script src="vendor/bootstrap/dist/js/bootstrap.js"></script>
					<!-- Material Colors-->
					<script src="vendor/material-colors/dist/colors.js"></script>
					<!-- jQuery Form Validation-->
					<script src="vendor/jquery-validation/dist/jquery.validate.js"></script>
					<script src="vendor/jquery-validation/dist/additional-methods.js"></script>
					<!-- App script-->
					<script src="js/app.js"></script>
</body>
</html>