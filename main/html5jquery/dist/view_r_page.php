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

if(isset($_GET['search_word']) && !empty($_GET['search_word'])){
    $search_word =$_GET['search_word'];
    $sql='SELECT * FROM `dr_dreams` WHERE `dream_contents` LIKE ?';
    $word='%'. $search_word. '%';
    $data = array($word);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
}
$search_word='';


?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<title>View Result Page</title>
	<?php require('partial/head.php'); ?>
	<link rel="stylesheet" href="css/app.css">
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
					<div class="welcome" ><h2 class="text-center">"<?php echo $search_word?>"の検索結果</h2></div>
				</div>
			</div>

<!-- Main Function Part Start  ============================================ -->
				<br><br>
					<div class="container">
						<div class="row">
							<?php
							    $target =array();
									    while (true) {
									    	$record = $stmt->fetch(PDO::FETCH_ASSOC);
									    	if ($record==false) {
									    		break;
									    	}
									    	$target[] = $record;
									    }

									$errors=array();
									if(empty($target)){
										  $errors['target'] = 'blank';
										};

								// 夢ごとに必要なデータを取得する
										foreach ($target as $dream) {
												$dr_user_id = $dream['user_id'];
								// dr_usersテーブルから、dreamのuser_idと一致するユーザーのデータを全件取得
												$sql ='SELECT * FROM `dr_users` WHERE `user_id`=?';
												$data = array($dr_user_id);
												$stmt = $dbh->prepare($sql);
												$stmt->execute($data);
												$read_users = $stmt->fetch(PDO::FETCH_ASSOC);
												$rd =$dream['dream_id'];
												$this_dream_id = $rd;
												$sql ='SELECT COUNT(*) AS `cnt` FROM `dr_cheers` WHERE `dream_id`=?';
												$data = array($rd);
												$stmt = $dbh->prepare($sql);
												$stmt->execute($data);
												$read_cheers_amount = $stmt->fetch(PDO::FETCH_ASSOC);
								?>
								<div class="col-8 col-md-4"  style="margin-top: 20px;">
									<div class="card">
										<a href="other_mypage.php?dream=<?php echo $this_dream_id;?>">
										<img class="card-img-top img-fluid" src="img/<?php echo $dream['dream_image_path']; ?>" alt="Card image cap" style="height: 100%; width: 100%;">
										<div class="card-block">
											<h2 class="card-title"><?php echo $dream['dream_contents']; ?></h2>
											<?php echo $dream['d_schedule']; ?><br>
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
							<?php if(isset($errors['target'])) {?>
                <h1 class="bg-light-blue-300 text-center" style="padding: 10px">検索結果が該当しませんでした。</h1>
              <?php }?>
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