<?php
session_start();
require('../dbconnect.php');
//$_SESSIONが存在し、なおかつログインできればそのまま進める
if (isset($_SESSION['login_user']['user_id']) && $_SESSION['login_user']['user_id'] !='') {
    require('../require/read_users_session.php');
    //login!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
}
//$_SESSIONがなければsignin.phpに戻す
elseif (!isset($_SESSION['login_user']['user_id']) && $_SESSION['login_user']['user_id']=='') {
    header('Location: signin.php');
    exit();
}
$search_word='';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<title>View Cheer Now Page</title>
	<?php require('partial/head.php'); ?>
</head>
<body class="theme-default">
	<div class="layout-container">
		<!-- top navbar-->
    <?php require('partial/header.php');?>
    <!-- sidebar-->
    <?php require('partial/sidebar.php');?>
<!-- Main section-->
<main class="main-container">
	<!-- Page content-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="welcome"><h1 class="text-center">応援中の夢一覧</h1>
						<br>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
		<?php
		$user_id = $_SESSION['login_user']['user_id'];
		require('../require/read_cheers.php');
		foreach ($read_cheers as $cheered) {
		$rd=$cheered['dream_id'];
		$this_dream_id = $rd;
		require('../require/read_dream.php');
		require('../require/read_cheers_amount.php');
		$user_id = $read_dream['user_id'];
		require('../require/read_users.php');
		//$read_dream[]で中身出せる ?>
				<div class="col-8 col-md-4"  style="margin-top: 20px;">
					<div class="card">
						<a href="other_mypage.php?dream=<?php echo $this_dream_id;?>">
						<img class="card-img-top img-fluid" src="img/<?php echo $read_dream['dream_image_path']; ?>" alt="Card image cap" style="height: 100%; width: 100%;">
						<div class="card-block">
							<h2 class="card-title"><?php echo $read_dream['dream_contents']; ?></h2>
								<?php echo $read_dream['created']; ?><br>
								応援された数：<?php echo $read_cheers_amount['cnt']; ?><br>
								<div>
									<span class="card-text">
										<img style="width: 30px; height: 30px;" class="rounded-circle" src="img/user/<?php echo $read_users['profile_image_path']; ?>">
										<?php  echo $read_users['user_name'];?><br>
										<?php echo $cheered['created']; ?>に応援
									</span>
								</div>
						</div>
						</a>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</main>
		</div>
<!-- Main Function Part End  ============================================ -->
		<!-- 検索機能 Search template-->
      <?php require('partial/search_template.php'); ?>

      <!-- Settings template-->
      <?php require('partial/settings_template.php'); ?>

		  <!-- Script links-->
      <?php require('partial/script_links.php'); ?>
	</body>
	</html>