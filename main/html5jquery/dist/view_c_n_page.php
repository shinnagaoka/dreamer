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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Bootstrap Admin Template">
	<meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
	<title>View Cheer Now Page</title>
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
					<li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><img class="header-user-image" src="img/user/<?php echo $read_users['profile_image_path']; ?>" alt="header-user-image"><!-- <sup class="badge bg-danger">3</sup> --></a>
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
		<div class="sidebar-toolbar-content text-center"><a href="#"><img class="rounded-circle thumb64" src="img/user/<?php echo $read_users['profile_image_path']; ?>" alt="Profile"></a>
			<div class="mt-3">
				<div class="lead"><?php echo $read_users['user_name']; ?></div>
				<div class="text-thin">北海道</div>
			</div>
		</div>
	</div>
	<nav class="sidebar-nav">
		<ul>
			<li>
				<div class="sidebar-nav-heading">マイページ</div>
			</li>
			<li><a href="dashboard.php"><span class="float-right nav-label"></span><span class="nav-icon">
				<em class="ion-ios-speedometer-outline"></em></span><span>進行中の夢</span></a>
			</li>
			<li><a href="#"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-settings"></em></span><span>達成された夢</span></a>
				<ul class="sidebar-subnav" id="elements">
					<li><a href="buttons.html"><span class="float-right nav-label"></span><span>No.1</span></a></li>
					<li><a href="bootstrapui.html"><span class="float-right nav-label"></span><span>No.2</span></a></li>
				</ul>
			</li>
			<li><a href="dashboard.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-gear-outline"></em></span><span>編集</span></a>
			</li>
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
		require('../require/read_dream.php');
		require('../require/read_cheers_amount.php');
		$user_id = $read_dream['user_id'];
		require('../require/read_users.php');
		//$read_dream[]で中身出せる ?>
				<div class="col-8 col-md-4"  style="margin-top: 20px;">
					<div class="card">
						<img class="card-img-top img-fluid" src="img/<?php echo $read_dream['dream_image_path']; ?>" alt="Card image cap" style="height: 100px; width: 100%;">
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
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</main>
		</div>
		<!-- Search template-->
		<div class="modal modal-top fade modal-search" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-search-form">
							<form action="#">
								<div class="input-group">
									<div class="input-group-btn">
										<button class="btn btn-flat" type="button" data-dismiss="modal"><em class="ion-arrow-left-c icon-lg text-muted"></em></button>
									</div>
									<input class="form-control header-input-search" type="text" placeholder="Search..">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Search template-->
		<!-- Settings template-->
		<div class="modal-settings modal modal-right fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="mt-0 modal-title"><span>Settings</span></h4>
						<div class="float-right clickable" data-dismiss="modal"><em class="ion-close-round text-soft"></em></div>
					</div>
					<div class="modal-body">
						<p>Dark sidebar</p>
						<div class="d-flex flex-wrap mb-3">
							<div class="setting-color">
								<label class="preview-theme-default">
									<input type="radio" checked name="setting-theme" value="theme-default"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-2">
									<input type="radio" name="setting-theme" value="theme-2"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-3">
									<input type="radio" name="setting-theme" value="theme-3"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-4">
									<input type="radio" name="setting-theme" value="theme-4"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-5">
									<input type="radio" name="setting-theme" value="theme-5"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-6">
									<input type="radio" name="setting-theme" value="theme-6"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
						</div>
						<p>White sidebar</p>
						<div class="d-flex flex-wrap mb-3">
							<div class="setting-color">
								<label class="preview-theme-default">
									<input type="radio" name="setting-theme" value="theme-default-w"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-2">
									<input type="radio" name="setting-theme" value="theme-2-w"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-3">
									<input type="radio" name="setting-theme" value="theme-3-w"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-4">
									<input type="radio" name="setting-theme" value="theme-4-w"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-5">
									<input type="radio" name="setting-theme" value="theme-5-w"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-6">
									<input type="radio" name="setting-theme" value="theme-6-w"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
						</div>
						<p>Sidebar Gradients</p>
						<div class="d-flex flex-wrap mb-3">
							<div class="setting-color">
								<label class="preview-theme-gradient-1">
									<input type="radio" name="setting-theme" value="theme-gradient-sidebar-1"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-2">
									<input type="radio" name="setting-theme" value="theme-gradient-sidebar-2"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-3">
									<input type="radio" name="setting-theme" value="theme-gradient-sidebar-3"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-4">
									<input type="radio" name="setting-theme" value="theme-gradient-sidebar-4"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-5">
									<input type="radio" name="setting-theme" value="theme-gradient-sidebar-5"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-6">
									<input type="radio" name="setting-theme" value="theme-gradient-sidebar-6"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
						</div>
						<p>Header Gradients</p>
						<div class="d-flex flex-wrap mb-3">
							<div class="setting-color">
								<label class="preview-theme-gradient-1">
									<input type="radio" name="setting-theme" value="theme-gradient-header-1"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-2">
									<input type="radio" name="setting-theme" value="theme-gradient-header-2"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-3">
									<input type="radio" name="setting-theme" value="theme-gradient-header-3"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-4">
									<input type="radio" name="setting-theme" value="theme-gradient-header-4"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-5">
									<input type="radio" name="setting-theme" value="theme-gradient-header-5"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
							<div class="setting-color">
								<label class="preview-theme-gradient-6">
									<input type="radio" name="setting-theme" value="theme-gradient-header-6"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
						</div>
						<p>Dark content</p>
						<div class="d-flex flex-wrap mb-3">
							<div class="setting-color">
								<label class="preview-theme-dark">
									<input type="radio" name="setting-theme" value="theme-dark"><span class="ion-checkmark-round"></span><span class="square24 b"></span>
								</label>
							</div>
						</div>
						<hr>
						<p>
							<label class="custom-control custom-checkbox">
								<input class="custom-control-input" id="sidebar-cover" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">Sidebar Cover</span>
							</label>
						</p>
						<p>
							<label class="custom-control custom-checkbox">
								<input class="custom-control-input" id="sidebar-showtoolbar" type="checkbox" checked><span class="custom-control-indicator"></span><span class="custom-control-description">Sidebar profile</span>
							</label>
						</p>
						<p>
							<label class="custom-control custom-checkbox">
								<input class="custom-control-input" id="fixed-footer" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">Fixed Footer</span>
							</label>
						</p>
						<hr>
						<button class="btn btn-secondary" type="button" data-toggle-fullscreen="">Toggle fullscreen</button>
						<hr>
						<p>Change language</p>
						<!-- START Language list-->
						<select class="language-select custom-select form-control">
							<option value="en" selected="">English</option>
							<option value="es">Spanish</option>
							<option value="fr">French</option>
						</select>
						<!-- END Language list-->
						<div class="mt-3" data-localize="translate.EXAMPLE">This is an example text using English as selected language.</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Settings template-->
		<!-- Modernizr-->
		<script src="vendor/modernizr/modernizr.custom.js"></script>
		<!-- PaceJS-->
		<script src="vendor/pace/pace.min.js"></script>
		<!-- jQuery-->
		<script src="vendor/jquery/dist/jquery.js"></script>
		<!-- Bootstrap-->
		<script src="vendor/tether/dist/js/tether.min.js"></script>
		<script src="vendor/bootstrap/dist/js/bootstrap.js"></script>
		<!-- Material Colors-->
		<script src="vendor/material-colors/dist/colors.js"></script>
		<!-- Screenfull-->
		<script src="vendor/screenfull/dist/screenfull.js"></script>
		<!-- jQuery Localize-->
		<script src="vendor/jquery-localize-i18n/dist/jquery.localize.js"></script>
		<!-- Flot charts-->
		<script src="vendor/flot/jquery.flot.js"></script>
		<script src="vendor/flot/jquery.flot.categories.js"></script>
		<script src="vendor/flot-spline/js/jquery.flot.spline.js"></script>
		<script src="vendor/flot.tooltip/js/jquery.flot.tooltip.js"></script>
		<script src="vendor/flot/jquery.flot.resize.js"></script>
		<script src="vendor/flot/jquery.flot.pie.js"></script>
		<script src="vendor/flot/jquery.flot.time.js"></script>
		<script src="vendor/sidebysideimproved/jquery.flot.orderBars.js"></script>
		<!-- Sparkline-->
		<script src="vendor/sparkline/index.js"></script>
		<!-- jQuery Knob charts-->
		<script src="vendor/jquery-knob/js/jquery.knob.js"></script>
		<!-- App script-->
		<script src="js/app.js"></script>
	</body>
	</html>