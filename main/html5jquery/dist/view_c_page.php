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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Bootstrap Admin Template">
	<meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
	<title>View Category Page</title>
	<!-- Vendor styles-->
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
<body class="theme-default">
	<div class="layout-container">
		<!-- top navbar-->
		<header class="header-container">
			<nav>
				<ul class="hidden-lg-up">
					<li><a class="sidebar-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
				</ul>
				<ul class="hidden-xs-down">
					<li><a class="covermode-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
				</ul>
				<h2 class="header-title"></h2>
				<ul class="float-right">
					<li><a id="header-search" href="#"><em class="ion-ios-search-strong"></em></a></li>
					<li><a id="header-settings" href="#"><em class="ion-more"></em></a></li>
					<li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><em class="ion-ios-keypad"></em></a>
					</li>
					<li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><img class="header-user-image" src="img/user/<?php echo $read_login_users['profile_image_path']; ?>" alt="header-user-image"><!-- <sup class="badge bg-danger">3</sup> --></a>
						<div class="dropdown-menu dropdown-menu-right dropdown-scale">
							<h6 class="dropdown-header">ユーザーメニュー</h6><a class="dropdown-item" href="#"><!-- <span class="float-right badge badge-primary">4</span> --><em class="ion-ios-email-outline icon-lg text-primary"></em>マイページ</a><a class="dropdown-item" href="#"><em class="ion-ios-gear-outline icon-lg text-primary"></em>編集</a>
							<div class="dropdown-divider" role="presentation"></div><a class="dropdown-item" href="logout.php"><em class="ion-log-out icon-lg text-primary"></em>ログアウト</a>
						</div>
					</li>
				</ul>
			</nav>
		</header>
		<!-- sidebar-->
		<aside class="sidebar-container">
			<div class="brand-header">
				<div class="float-left pt-4 text-muted sidebar-close"><em class="ion-arrow-left-c icon-lg"></em></div><a class="brand-header-logo" href="#">
<!-- Logo Imageimg(src="img/logo.png", alt="logo")
--><span class="brand-header-logo-text">Dreamer</span></a>
</div>
<div class="sidebar-content">
	<div class="sidebar-toolbar">
		<div class="sidebar-toolbar-background"></div>
		<div class="sidebar-toolbar-content text-center"><a href="#"><img class="rounded-circle thumb64" src="img/user/<?php echo $read_login_users['profile_image_path']; ?>" alt="Profile"></a>
			<div class="mt-3">
				<div class="lead"><?php echo $read_login_users['user_name']; ?></div>
				<div class="text-thin">北海道</div>
			</div>
		</div>
	</div>
	<nav class="sidebar-nav">
		<ul>
			<li>
				<div class="sidebar-nav-heading">マイページ</div>
			</li>
			<li><a href="dashboard.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-speedometer-outline"></em></span><span>進行中の夢</span></a></li>
              <li><a href="achived_dream.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-settings"></em></span><span>達成された夢</span></a></li>
              <li><a href="dashboard.html"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-gear-outline"></em></span><span>編集</span></a></li>
			<li>
				<div class="sidebar-nav-heading">閲覧</div>
			</li>
			<li><a href="view_c_page.php"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-list-outline"></em></span><span>カテゴリー別</span></a>
				<ul class="sidebar-subnav" id="tables">
					<li><a href="view_c_page.php"><span class="float-right nav-label"></span><span>カテゴリー別</span></a></li>
					<li><a href="view_c_page.php #1"><span class="float-right nav-label"></span><span>職業</span></a></li>
					<li><a href="view_c_page.php #2"><span class="float-right nav-label"></span><span>人間関係</span></a></li>
					<li><a href="view_c_page.php #3"><span class="float-right nav-label"></span><span>健康</span></a></li>
					<li><a href="view_c_page.php #4"><span class="float-right nav-label"></span><span>勉強</span></a></li>
					<li><a href="view_c_page.php #5"><span class="float-right nav-label"></span><span>お金</span></a></li>
					<li><a href="view_c_page.php #6"><span class="float-right nav-label"></span><span>その他</span></a></li>
				</ul>
			</li>
			<li><a href="view_c_n_page.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-settings"></em></span><span>応援している夢</span></a></li>
			<li><a href="view_h_page.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-speedometer-outline"></em></span><span>履歴</span></a></li>
		</ul>
	</nav>
</div>
</aside>
<div class="sidebar-layout-obfuscator"></div>
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