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
$rd=$read_login_users['now_dream_id'];
require('../require/read_dream.php');
$user_id = $read_dream['user_id'];
require('../require/read_cheers_amount.php');

if (!empty($_POST)) {
  $dream_id = $rd;
  $achieve_1 = $_POST['a_hard'];
  $achieve_2 = $_POST['a_study'];
  $achieve_3 = $_POST['a_comment'];
  require('../require/make_achieve_comment.php');
  header('Location: register.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Dasha - Bootstrap Admin Template</title>
  <?php require('partial/head.php'); ?>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>
  <style type="text/css">
    .achieve-modal-wrapper {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 100;
    display: none;
    }

    .modal {
      position: absolute;
      top: 20%;
      left: 34%;
      background: linear-gradient(#FFFF22, #FF9900);
      padding: 20px 0 40px;
      border-radius: 10px;
      width: 450px;
      height: auto;
      text-align: center;
    }

    #form {
      width: 100%;
    }

    #form h2 {
      color: #5f5d60;
      letter-spacing: 1px;
      margin-bottom: 20px;
    }
  </style>

</head>
<body class="theme-default">
  <div class="layout-container">
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
                <?php
                $cat=$read_dream['category'];
                switch ($cat) {
                  case 1:
                    $cat = '仕事';
                    break;
                  case 2:
                    $cat = '人間関係';
                    break;
                  case 3:
                    $cat = '健康';
                    break;
                  case 4:
                    $cat = '勉強';
                    break;
                  case 5:
                    $cat = 'お金';
                    break;
                  case 6:
                    $cat = 'その他';
                    break;
                }
                echo $cat;
                $dream_id = $read_login_users['now_dream_id'];
                require('../require/read_tags.php');
                foreach ($read_tags as $tag) {
                  echo '#'.$tag;
                }
                $year = explode(' ',$read_dream['d_schedule']);
                $year = explode('-',$year[0]);
                ?>
                <span style="float:right">〆<?php echo $year[0].'年'.$year[1].'月'.$year[2].'日'; ?></span>
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
              <div id="achieve" class="btn btn-block btn-lg bg-gradient-warning" >達成</div>
              <!-- modal表示 -->
              <div class="achieve-modal-wrapper" id="achieve-modal">
                <div class="modal" style="height: 300px">
                  <div class="close-modal ion-close-round" style="text-align: right; margin-right: 20px">
                  </div>
                  <div id="form">
                    <h2>Congratulations!!</h2>
                    <p>あなたの"軌跡"は受け継がれ、</p>
                    <p>今後多くのDreamer達の助けになるでしょう。</p>
                    <p>次なる夢を叶えましょう。</p>
                    <p>Don't stop here.</p>
                      <button type="button" class="close-modal bg-blue-grey-50" style="float: left; margin-left: 40px">編集画面へ戻る</button>
                      <button type="submit" class=" close-modal bg-info " style="float: right ; margin-right: 40px">Next Dream</button>
                  </div>
                </div>
              </div>
              <!-- modal表示終了 -->
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.1.1.js"></script>
  <script src="js/jquery-migrate-1.4.1.js"></script>
  <script>
    $(function(){
        $('#achieve').click(function(){
            $('#achieve-modal').fadeIn();
        });

        $('#achieve').click(function(){
            $('.modal').fadeIn();
        });

        $('.close-modal').click(function(){
          $('#achieve-modal').fadeOut();
        })

    });
  </script>
<!-- Main Function Part End  ============================================ -->
      <!-- Script links-->
      <?php require('partial/script_links.php'); ?>
</body>
</html>