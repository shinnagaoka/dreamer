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
$category = array('職業','人間関係','健康','勉強','お金','その他');
$search_word='';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<title>View Category Page</title>
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
	<section class="section-container">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="welcome" ><h1 class="text-center">カテゴリー別 夢一覧</h1>
						<br>
					</div>
					<div class="row">
						<div class="col-8 col-md-4"  >
							<div class="cardbox bg-primary" style="height: 120px;">
								<a href="#1">
									<h1 class="text-center" >
										<br>
										<strong><span class="text-white">職業</span>
										</strong>
									</h1>
								</a>
							</div>
						</div>
						<div class="col-8 col-md-4"  >
							<div class="cardbox bg-info" style="height: 120px;">
								<a href="#2">
									<h1 class="text-center" >
										<br>
										<strong><span class="text-white">人間関係</span>
										</strong>
									</h1>
								</a>
							</div>
						</div>
						<div class="col-8 col-md-4"  >
							<div class="cardbox bg-primary" style="height: 120px;">
								<a href="#3">
									<h1 class="text-center" >
										<br>
										<strong><span class="text-white">健康</span>
										</strong>
									</h1>
								</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8 col-md-4"  >
							<div class="cardbox bg-info" style="height: 120px;">
								<a href="#4">
									<h1 class="text-center" >
										<br>
										<strong><span class="text-white">勉強</span>
										</strong>
									</h1>
								</a>
							</div>
						</div>
						<div class="col-8 col-md-4"  >
							<div class="cardbox bg-primary" style="height: 120px;">
								<a href="#5">
									<h1 class="text-center" >
										<br>
										<strong><span class="text-white">お金</span>
										</strong>
									</h1>
								</a>
							</div>
						</div>
						<div class="col-8 col-md-4"  >
							<div class="cardbox bg-info" style="height: 120px;">
								<a href="#6">
									<h1 class="text-center" >
										<br>
										<strong><span class="text-white">その他</span>
										</strong>
									</h1>
								</a>
							</div>
						</div>
					</div>
				</div>
<!-- Main Function Part Start  ============================================ -->
				<br><br>
				<?php $c_N=0; foreach ($category as $c_name) { $c_N++;
					$_SESSION['dream_category']=$c_N;?><br>
					<div class="container" id="<?php echo $c_N; ?>">
						<div class="row" style="margin-top: 50px;">
							<div class="col-xl-12">
								<div class="card  bg-info"><br>
									<div class="text-center"><h2><?php echo $c_name; ?></h2></div>
									<br>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<?php
							require('../require/read_all_dream.php');
							foreach ($read_dream as $dream) {
								$rd = $dream['dream_id'];
								$this_dream_id = $rd;
								require('../require/read_cheers_amount.php');
								$user_id=$dream['user_id'];
								require('../require/read_users.php');?>
								<div class="col-8 col-md-4"  style="margin-top: 20px;">
									<div class="card">
										<a href="other_mypage.php?dream=<?php echo $this_dream_id;?>">
										<img class="card-img-top img-fluid" src="img/<?php echo $dream['dream_image_path']; ?>" alt="Card image cap" style="height: 100%; width: 100%;">
										<div class="card-block">
											<h2 class="card-title"><?php echo $dream['dream_contents']; ?></h2>
											<?php echo $dream['created']; ?><br>
											応援された数：<?php echo $read_cheers_amount['cnt']; ?><br>
											<div>
												<span class="card-text">
														<img style="width: 30px; height: 30px;" class="rounded-circle" src="img/user/<?php echo $read_users['profile_image_path']; ?>">
														<?php echo $read_users['user_name'];?>
												</span>
											</div>
										</div>
									</a>
									</div>
								</div>
						<?php } ?>
							</div>
						</div>
						<?php } ?>
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