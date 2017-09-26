<?php
		session_start();
		require('../dbconnect.php');

		$_SESSION['login_user']['user_id'];
		require('../require/read_users_session.php');

		if (!isset($_GET['step_id'])) {
				header('Location: edit_step.php');
				exit();
		}

		//削除

		$sql = 'DELETE FROM `dr_steps` WHERE `step_id`=?';
		$data = array($_GET['step_id']);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);

		header('Location: edit_step.php');
		exit();

?>