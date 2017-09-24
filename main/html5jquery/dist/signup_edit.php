<?php
session_start();
require('../dbconnect.php');

    //バリデーション(検証)
$user_name ='';
require('../require/read_users_session.php');
$email = $read_login_users['email'];
$errors = array();

if (!empty($_POST)) {
  $user_name = $_POST['user_name'];

      //ユーザーネームが空か否か
  if ($user_name =='') {
    $errors['user_name'] = 'blank';
  }
      //画像拡張子チェック
  $fileName = $_FILES['profile_image_path']['name'];
  if(!empty($fileName)){
    $ext = substr($fileName,-3);
    $ext = strtolower($ext);
    if ($ext !='jpg' && $ext != 'png' && $ext != 'gif') {
      $errors['profile_image_path'] = 'type';
    }
  }else{
    $errors['profile_image_path']='blank';
  }
  if (empty($errors)) {
          //画像をdist/img/user/にアップロード。
      $upload_image_name = date('YmdHis').$fileName;
      echo'登録画像名'.$upload_image_name.'<br>';
      $profile_image_path = $upload_image_name;
      move_uploaded_file($_FILES['profile_image_path']['tmp_name'],'img/user/'.$upload_image_name);
  //ユーザー登録ボタンが押された際の処理
      $sql = 'UPDATE `dr_users` SET `user_name`=?,
      `profile_image_path`=?
      WHERE `email`=?';
      $data = array($user_name,$profile_image_path,$email);
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      header('Location: dashboard.php');
      exit();
    }
  }
?>

<!DOCTYPE html>
  <html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin Template">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <title>アカウントエディット</title>
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
                <form method="POST" action="" enctype="multipart/form-data">
                  <div class="cardbox-heading">
                    <div class="cardbox-title text-center" style="font-size: 20px">アカウント編集</div><br>
                  </div>
                  <div class="cardbox-body pb-0">
                    <div class="px-5">
                      <div>

                         <div class="form-group">
                        <input class="form-control form-control-inverse" id="user_name" type="text" name="user_name" placeholder="ユーザー名" value="<?php echo $user_name?>">
                      </div>

                      <?php if(isset($errors['user_name']) && $errors['user_name'] == 'blank') {?>
                      <div class="alert alert-danger">ユーザー名を入力してください</div>
                      <?php }?>

                        <input type="file" name="profile_image_path">
                        <?php if (isset($errors['profile_image_path']) && $errors['profile_image_path'] == 'blank') { ?>
                          <div class="alert alert-danger">プロフィール画像を選択してください</div>
                        <?php } elseif (!empty($errors)) {?>
                       <!--何かしらのエラーが出た場合-->
                          <div class="alert alert-danger">プロフィール画像を再度選択してください。</div>
                        <?php }?>

                        <?php if(isset($errors['profile_image_path']) && $errors['profile_image_path']=='type'){?>
                          <div class="alert alert-danger">プロフィール画像は「jpg」「png」「gif」拡張子のいずれかを選択してください</div>
                        <?php  } ?>
                      </div>

                     <div class="py-4 text-center">
                      <input type="submit" value="確認画面へ" class="btn btn-lg btn-gradient btn-oval btn-info btn-block" >
                    </div>
                  </div>
                </div>
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