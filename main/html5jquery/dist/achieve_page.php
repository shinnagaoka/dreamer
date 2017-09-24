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
$rd=$read_users['now_dream_id'];
require('../require/read_dream.php');
$user_id = $read_dream['user_id'];
require('../require/read_cheers_amount.php');

if (!empty($_POST)) {
  var_dump($_POST);
  var_dump($rd);
  $dream_id = $rd;
  $achieve_1 = $_POST['a_hard'];
  $achieve_2 = $_POST['a_study'];
  $achieve_3 = $_POST['a_comment'];
  require('../require/make_achieve_comment.php');
  header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Dasha - Bootstrap Admin Template</title>
  <?php require('partial/head.php'); ?>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>


  <SCRIPT LANGUAGE="JavaScript">

    // カウントダウン機能
    <!--
    // 指定日までの残り日数を表示する
    function apDay(y,m,d) {
      today = new Date();
      apday = new Date(y,m-1,d);
      dayms = 24 * 60 * 60 * 1000;
      n = Math.floor((apday.getTime()-today.getTime())/dayms) + 1;
      // 指定日から何日たったかを表示するには、"n"を"-n"にする
      document.write(n);
    }
    // -->
  </SCRIPT>

</head>
<body class="theme-default">
  <div class="layout-container">
    <!-- Main section-->
      <!-- Page content-->
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-rol-3">
              <img src="img/congratulations.png" style=" display: block; margin-left: auto;margin-right: auto;">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-rol-3">
              <div class="cardbox" style="margin:0">
                <div class="cardbox-body">
                  <div class="clearfix mb-3">
                    <div class="text-center">
                      <h1 style="margin-top: 20px"><?php echo $read_dream['dream_contents']; ?></h1>
                    </div>
                  </div>
                  <div class="">
                    <div style="margin: 0">
                      仕事 #エンジニア #英語
                      <span style="float:right">〆2019年2月13日</span>
                    </div>
                  </div>
                  <div style="margin:10px">
                    <a href="#" class="btn btn-xs btn-info">
                    <span class="glyphicon glyphicon-thumbs-up"></span>
                    応援された数：<?php echo $read_cheers_amount['cnt']; ?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-rol-3">
              <div class="cardbox" style="margin:0">
                <div class="cardbox-body">
                  <div class="clearfix mb-3">
                  <h4>感想</h4>感想を記入して、Dreamerたちと努力をシェアしよう！
                  <form method="POST" action="">
                    <div class="row">
                      <div class="col-lg-3 col-xs-12">
                        <h5 class="btn-lg bg-primary text-center">困難だったこと</h5>
                      </div>
                      <div class="col-lg-9 col-xs-12">
                        <textarea name="a_hard" style="width: 100%; height: 40px;" placeholder="例）　資金調達にとても時間がかかった。"></textarea>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-3 col-xs-12">
                        <h5 class="btn-lg bg-primary text-center">学んだこと</h5>
                      </div>
                      <div class="col-lg-9 col-xs-12">
                        <textarea name="a_study" style="width: 100%; height: 40px;" placeholder="例）　人とのつながりが大切であること！"></textarea>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-3 col-xs-12">
                        <h5 class="btn-lg bg-primary text-center">Dreamerたちへのコメント</h5>
                      </div>
                      <div class="col-lg-9 col-xs-12">
                        <textarea name="a_comment" style="width: 100%; height: 40px;" placeholder="例）　つながりを作るためにイベントに参加しよう！"></textarea>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-block btn-lg bg-gradient-warning" value="達成"></input>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
            </div>
          </div>
  </div>
<!-- Main Function Part End  ============================================ -->
      <!-- Script links-->
      <?php require('partial/script_links.php'); ?>
    </body>
  </html>