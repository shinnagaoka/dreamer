<?php

session_start();
require('../dbconnect.php');

$_SESSION['login_user']['user_id'];
          //echo "<pre>";
          //var_dump($_SESSION);
          //echo "</pre>";
require('../require/read_users_session.php');

//前の画像のまま。無変更。
$sql = 'SELECT * FROM `dr_dreams` WHERE `dream_id`=?';
$data = array($read_login_users['now_dream_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$info=$stmt->fetch(PDO::FETCH_ASSOC);
//var_dump($info);



if(!empty($_POST)){

    //dr_dreamsの更新
  if ($_FILES['dream_image_path']['name']=='') {
    $sql = 'UPDATE `dr_dreams` SET `dream_contents`=?,`dream_image_path`=?,`category`=?,`d_schedule`=?,`modified`= NOW() WHERE `dream_id` = ?';
    $data = array($_POST['dream_contents'],$info['dream_image_path'],$_POST['category'],$_POST['d_schedule'],$read_login_users['now_dream_id']);
    $stmt = $dbh->prepare($sql);
    $stmt-> execute($data);
  }else {
    //画像について。 変更された場合
    // $dream_image_path=$_FILES['dream_image_path'];

    $fileName = $_FILES['dream_image_path']['name'];
    if(!empty($fileName)){
      $ext = substr($fileName,-3);
      $ext = strtolower($ext);
      if ($ext !='jpg' && $ext != 'png' && $ext != 'gif') {
        $errors['dream_image_path'] = 'type';
      }
    }
    $upload_image_name = date('YmdHis').$fileName;
    move_uploaded_file($_FILES['dream_image_path']['tmp_name'],'dream_image/'.$upload_image_name);


    $sql = 'UPDATE `dr_dreams` SET `dream_contents`=?,`dream_image_path`=?,`category`=?,`d_schedule`=?,`modified`= NOW() WHERE `dream_id` = ?';
    $data = array($_POST['dream_contents'],$upload_image_name, $_POST['category'],$_POST['d_schedule'],$read_login_users['now_dream_id']);
    $stmt = $dbh->prepare($sql);
    $stmt-> execute($data);
  }



 //dr_stepsの更新
  $sql = 'UPDATE `dr_steps` SET `daily_goal_contents`=?,`daily_time`=?,`modified`= NOW() WHERE `dream_id`=?';
  $data = array($_POST['daily_goal_contents'],$_POST['daily_time'],$read_login_users['now_dream_id']);
  $stmt = $dbh->prepare($sql);
  $stmt-> execute($data);
}



?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<?php require('partial/head.php'); ?>
  <title>edit_doneページ</title> 
</head>
<body>
<br><br><br>
<div align="center">
  <h1 style="color: #42a5f5;">夢を修正しました。</h1>
  </div>
  <br><br><br>
  <div align="center">
  <input type="button" onclick="location.href='dashboard.php'" value="マイページへ" class="btn btn-lg btn-gradient btn-oval btn-info btn-block"  style="WIDTH:300px; HEIGHT:70px;>
  </div>
  <?php require('partial/script_links.php'); ?>
</body>
</html>

