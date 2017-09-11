<?php
session_start();
require('../dbconnect.php');

    //バリデーション(検証)
$user_name ='';
$email = '';
$errors = array();

if (!empty($_POST)) {
  $user_name = $_POST['user_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];

      //ユーザーネームが空か否か
  if ($user_name =='') {
    $errors['user_name'] = 'blank';
  }
      //メールが空か否か
  if ($email == '') {
    $errors['email'] = 'blank';
  }
      //パスワードが空か否か
  if ($password == '') {
    $errors['password'] = 'blank';
  }elseif (strlen($password) < 3) {
    $errors['password'] = 'length';
  }

  if ($password2 == '') {
    $errors['password2'] = 'blank';
  }

  if ($password != $password2) {
    $errors['password'] = 'incrrect';
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

      //メールアドレスの重複チェック
  if (empty($errors)) {
    $sql = 'SELECT COUNT(*) FROM `dr_users` WHERE `email`=?';
    $data = array($email);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($record['COUNT(*)']>0) {
          $errors['email'] = 'duplicate'; //duplicate(重複)
        }
      }


      //上記全てにエラーが無かった場合
      if (empty($errors)) {
          //画像をdist/img/user/にアップロード。
        $upload_image_name = date('YmdHis').$fileName;
        echo'登録画像名'.$upload_image_name.'<br>';
        move_uploaded_file($_FILES['profile_image_path']['tmp_name'],'img/user/'.$upload_image_name);

        $_SESSION['user_info']['user_name'] = $user_name;
        $_SESSION['user_info']['email'] = $email;
        $_SESSION['user_info']['password'] = $password;
        $_SESSION['user_info']['profile_image_path'] = $upload_image_name;
        header('Location: sign_check.php');
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
    <title>登録画面</title>
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
                    <div class="cardbox-title text-center" style="font-size: 20px">登録</div><br>
                  </div>
                  <div class="cardbox-body pb-0">
                    <div class="px-5">

                      <div class="form-group">
                        <input class="form-control form-control-inverse" id="user_name" type="text" name="user_name" placeholder="ユーザー名" value="<?php echo $user_name?>">
                      </div>

                      <?php if(isset($errors['user_name']) && $errors['user_name'] == 'blank') {?>
                      <div class="alert alert-danger">ユーザー名を入力してください</div>
                      <?php }?>

                      <div class="form-group">
                        <input class="form-control form-control-inverse" type="email" name="email" placeholder="メールアドレス" value="<?php echo $email?>">
                      </div>

                      <?php if(isset($errors['email']) && $errors['email'] == 'blank') {?>
                        <div class="alert alert-danger">メールアドレスを入力してください</div>
                      <?php }elseif(isset($errors['email']) && $errors['email'] == 'duplicate'){?>
                        <div class="alert alert-danger">メールアドレスが重複しています</div>
                      <?php }?>

                      <div class="form-group">
                        <input class="form-control form-control-inverse" id="password" type="password" name="password" placeholder="パスワード(4文字以上)">
                      </div>

                      <div class="form-group">
                        <input class="form-control form-control-inverse" id="password2" type="password" name="password2"  placeholder="もう一度パスワードを入力してください">
                      </div>

                      <?php if(isset($errors['password']) && $errors['password'] == 'blank') {?>
                        <div class="alert alert-danger">パスワードを入力してください</div>
                      <?php }elseif(isset($errors['password']) && $errors['password'] == 'length') {?>
                        <div class="alert alert-danger">4文字以上で設定してください</div>
                      <?php }elseif(isset($errors['password']) && $errors['password'] == 'incrrect') {?>
                        <div class="alert alert-danger">パスワードが一致しません</div>
                      <?php }?>

                      <div>
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