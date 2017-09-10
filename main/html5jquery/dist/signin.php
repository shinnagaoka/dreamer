<?php
session_start();
require('dbconnect.php');
if (isset($_COOKIE['email']) && $_COOKIE['email'] != '' && isset($_COOKIE['password']) && $_COOKIE['password'] != '' ) {
// $_POST['email'] = $_COOKIE['email'];
// $_POST['password'] = $_COOKIE['password'];
  $_POST['auto_login'] = 'checked';
  var_dump($_COOKIE);
}
$errors =array();
if (!empty($_POST)) {
  if (!empty($_POST['auto_login'])) {
    if (!empty($_COOKIE['email']) && !empty($_COOKIE['password'])) {
      var_dump($_POST);
      $sql = 'SELECT * FROM `dr_users` WHERE `email` =? AND
      `password`=?';
      $data = array($_COOKIE['email'],sha1($_COOKIE['password']));
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      $record =$stmt->fetch(PDO::FETCH_ASSOC);
      if ($record != false) {
        $_SESSION['login_users']['user_id'] = $record['user_id'];
        setcookie('login_user_id',$_SESSION['login_users']['user_id'],time()+ 60*60);//*24*14
        if (isset($_POST['auto_login']) && $_POST['auto_login'] == 'checked') {
          setcookie('email',$_POST['email'],time()+ 60*60);//*24*14
          setcookie('password',$_POST['password'],time()+ 60*60);//*24*14
        }
        header('Location: dashboard.php');
        exit();
      }
      else{
        $errors['login'] = 'incorrect';
      }
    }
    else{
      $errors['login'] = 'blank';
    }
  }
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    var_dump($_POST);
    $sql = 'SELECT * FROM `dr_users` WHERE `email` =? AND
    `password`=?';
    $data = array($_POST['email'],sha1($_POST['password']));
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $record =$stmt->fetch(PDO::FETCH_ASSOC);
    if ($record != false) {
      $_SESSION['login_users']['user_id'] = $record['user_id'];
      setcookie('login_user_id',$_SESSION['login_users']['user_id'],time()+ 60*60);//*24*14
      setcookie('email',$_POST['email'],time()+ 60*60);//*24*14
      setcookie('password',$_POST['password'],time()+ 60*60);//*24*14
      header('Location: dashboard.php');
      exit();
    }
    else{
      $errors['login'] = 'incorrect';
    }
  }
  else{
      $errors['login'] = 'blank';
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
  <title>ログイン</title>
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
            <form method="POST" action="">
              <div class="cardbox-heading">
                <div class="cardbox-title text-center" style="font-size: 20px">ログイン</div><br>
              </div>
              <div class="cardbox-body">
                <div class="px-5">
                  <div class="form-group">
                    <input class="form-control form-control-inverse" type="email" name="email" placeholder="メールアドレス">
                  </div>
                  <div class="form-group">
                    <input class="form-control form-control-inverse" type="password" name="password" placeholder="パスワード">
                  </div>

                  <?php if(isset($errors['login']) && $errors['login'] == 'blank') {?>
                  <div class="alert alert-danger">メールアドレスとパスワードを入力してください</div>
                  <?php }elseif(isset($errors['login']) && $errors['login'] == 'incorrect') {?>
                  <div class="alert alert-danger">メールアドレスとパスワードが一致しません</div>
                  <?php }?>
                  <div class="form-group mt-4">
                    <input type="checkbox" name="auto_login" id="auto_login" value="checked">
                    <!-- PHPが下記連想配列を育成する。$_POST['auto_login']  = 'checked'; -->
                    <label for="auto_login">自動ログイン</label>
                  </div>



                  <div class="text-center my-4">
                    <input type="submit" value="認証" class="btn btn-lg btn-gradient btn-oval btn-info btn-block" >
                  </div>
                </div>
                <!-- <div class="text-center"><small><a class="text-inherit" href="recover.html">パスワードを忘れましたか?</a></small></div> -->
              </div>
              <div class="cardbox-footer text-center text-sm"><span class="mr-2">アカウントがありませんか?</span><a class="text-inherit" href="signup.php"><strong>今すぐ登録！</strong></a></div>
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