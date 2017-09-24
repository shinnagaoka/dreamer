<?php
	// $sql ='SELECT * FROM `dr_dreams` WHERE `dream_contents`=?';
	// $data = array($rd);
	// $stmt = $dbh->prepare($sql);
	// $stmt->execute($data);
	// $read_dream = $stmt->fetch(PDO::FETCH_ASSOC);

	function getUserData($id){
		require('../dbconnect.php');
		$sql='SELECT * FROM `dr_users` WHERE user_id=?';
		$data = array($id);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data); //object型→このままでは使えない。
		$data_user=array();

		while (true) {
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($record == false) {
				break;
			}
			$data_user[] = $record;
		}

		$sql='SELECT  * FROM `dr_dreams` WHERE user_id = ?';
		$data = array($data_user[0]['user_id']);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data); //object型→このままでは使えない。
		$data_dreams=array();


		while (true) {
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($record == false) {
				break;
			}
			$data_dreams[] = $record;
		}

		$sql='SELECT  * FROM `dr_cheers` WHERE user_id = ?';
		$data = array($data_user[0]['user_id']);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data); //object型→このままでは使えない。
		$data_cheers=array();


		while (true) {
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($record == false) {
				break;
			}
			$data_cheers[] = $record;
		}

		$data=array();
		$data['user']=$data_user;
		$data['dreams']=$data_dreams;
		$data['cheers']=$data_cheers;
		return $data;
	}
	$data = getUserData(2);

	echo '<pre>';
	var_dump($data['user'][0]['profile_image_path']);
	var_dump($data['user'][0]['user_name']);
	var_dump($data['dreams'][0]['dream_id']);
	var_dump($data['dreams'][0]['dream_contents']);
	var_dump($data['dreams'][0]['dream_image_path']);
	var_dump($data['dreams'][0]['d_schedule']);
	var_dump($data['cheers'][0]['cheer_id']);
	echo '</pre>';

	echo '<pre>';
	var_dump($data);
	echo '</pre>';
	exit();

?>






