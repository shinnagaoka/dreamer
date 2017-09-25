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
$rd = $read_login_users['now_dream_id'];
require('../require/read_step.php');
require('../require/read_dream.php');
require('../require/read_cheers_amount.php');
if (isset($_POST['message']) && $_POST['message']!='') {
  $dream_id = $read_dream['dream_id'];
  $message = $_POST['message'];
  require('../require/make_chat.php');

  var_dump($_POST['message']);
  header('Location: dashboard.php');
  exit();
}
if (isset($_POST['myFormTime']) && $_POST['myFormTime']!=' ') {
  $sum_time = $_POST['myFormTime'];
  $dream_id = $read_dream['dream_id'];
  require('../require/make_evas.php');
  header('Location: dashboard.php');
  exit();
}
if (isset($_POST['step_finsh']) && $_POST['step_finsh']!=' ') {
  $step_id = $_POST['step_finsh'];
  require('../require/update_step.php');
  header('Location: dashboard.php');
  exit();
}
$search_word='';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="Bootstrap Admin Template">
  <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
  <title>Dasha - Bootstrap Admin Template</title>
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

  <!-- <script src="https://cdn.plot.ly/plotly-latest.min.js"></script> -->

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script> -->

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>
  <script src="js/jquery-3.1.1.js"></script>
  <script src="js/jquery-migrate-1.4.1.js"></script>
  <style type="text/css">.finish_step_content{display: none;}</style>

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
    //-->
    //<!--
    myButton = 0; // [Start]/[Stop]のフラグ
    function myCheck(){
      if (myButton==0){ // Startボタンを押した
      myStart=new Date(); // スタート時間を退避
      myButton = 1;
      document.myForm.myFormButton.value = "Stop!";
      myInterval=setInterval("myDisp()",1);
      }else{  // Stopボタンを押した
      myDisp();
      myButton = 0;
      document.myForm.myFormButton.value = "Start";
      clearInterval( myInterval );
      }
    }
    function myDisp(){
      myStop=new Date();  // 経過時間を退避
      year = myStop.getFullYear();
      month = myStop.getMonth()+1;
      date = myStop.getDate();
      myTime = myStop.getTime() - myStart.getTime();  // 通算ミリ秒計算
      myH = Math.floor(myTime/(60*60*1000));  // '時間'取得
      myTime = myTime-(myH*60*60*1000);
      myM = Math.floor(myTime/(60*1000)); // '分'取得
      myTime = myTime-(myM*60*1000);
      myS = Math.floor(myTime/1000);  // '秒'取得
      myMS = myTime%1000; // 'ミリ秒'取得
              if( myH < 10 ){
                  myH = '0' + myH;
              }
              if( myM < 10 ){
                  myM = '0' + myM;
              }
              if( myS < 10 ){
                  myS = '0' + myS;
              }
      document.myForm.myFormTime.value = year+"-"+month+"-"+date+" "+myH+":"+myM+":"+myS;
      document.getElementById( 'stopwatchHour' ).innerHTML= myH;
      document.getElementById( 'stopwatchMinute' ).innerHTML= myM;
      document.getElementById( 'stopwatchSecond' ).innerHTML= myS;
    }
    // -->
  </SCRIPT>

</head>
<body class="theme-default">
  <div class="layout-container">
    <!-- top navbar-->
    <header class="header-container">
      <nav >
                    <ul class="hidden-lg-up">
          <li><a class="sidebar-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
        </ul>
        <ul class="hidden-xs-down">
          <li><a class="covermode-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
        </ul>
        <h2 class="header-title"></h2>
        <ul class="float-right">
          <li><a id="header-search" href="#"><em class="ion-ios-search-strong"></em></a></li>
          <li><a id="header-settings" href="#"><em class="ion-paintbrush"></em></a></li>
          <li><a href="view_c_page.php"><em class="ion-ios-paper"></em> dreams</a>
          </li>
          <li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><img class="header-user-image" src="img/user/<?php echo $read_login_users['profile_image_path']; ?>" alt="header-user-image"><!-- <sup class="badge bg-danger">3</sup> --></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-scale">

              <h6 class="dropdown-header">ユーザーメニュー</h6><a class="dropdown-item" href="dashboard.php"><!-- <span class="float-right badge badge-primary">4</span> --><em class="ion-android-person icon-lg text-primary"></em>マイページ</a>
              <div class="dropdown-divider" role="presentation"></div><a class="dropdown-item" href="#"><em class="ion-ios-gear-outline icon-lg text-primary"></em>アカウント編集</a>
              <a class="dropdown-item" href="#"><em class="ion-ios-gear-outline icon-lg text-primary"></em>夢編集</a>
              <a class="dropdown-item" href="#"><em class="ion-ios-gear-outline icon-lg text-primary"></em>ショートステップ編集</a>

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
          <!-- Logo Imageimg(src="img/logo.png", alt="logo") -->
          <span class="brand-header-logo-text"><img src="img/Dreamer.png"></span></a>
      </div>
      <div class="sidebar-content">
        <div class="sidebar-toolbar">
          <div class="sidebar-toolbar-background"></div>
          <div class="sidebar-toolbar-content text-center"><a href="#"><img class="rounded-circle thumb64" src="img/user/<?php echo $read_login_users['profile_image_path']; ?>" alt="Profile"></a>
            <div class="mt-3">
              <div class="lead"><?php echo $read_login_users['user_name']; ?></div>
             </div>
          </div>
        </div>
        <nav class="sidebar-nav">
          <ul>
            <li>
              <div class="sidebar-nav-heading">マイページ</div>
            </li>
              <li><a href="dashboard.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-timer"></em></span><span>進行中の夢</span></a></li>
              <li><a href="achieved_dream.php?user=<?php echo $read_login_users['user_id']; ?>"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ribbon-a"></em></span><span>達成した夢</span></a></li>
              <li><a href="dashboard.html"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-gear"></em></span><span>編集</span></a>
              <ul class="sidebar-subnav" id="tables">
                  <li><a href="signup_edit.php"><span class="float-right nav-label"></span><span>アカウント編集</span></a></li>
                  <li><a href=""><span class="float-right nav-label"></span><span>夢編集</span></a></li>
                  <li><a href=""><span class="float-right nav-label"></span><span>ショートステップ編集</span></a></li>
              </ul>
              <div class="sidebar-nav-heading">閲覧</div>
            </li>
              <li><a href="view_c_page.php"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-paper"></em></span><span>カテゴリー別</span></a>
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

              <li><a href="view_c_n_page.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-heart"></em></span><span>応援している夢</span></a></li>
              <li><a href="view_h_page.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-rewind"></em></span><span>履歴</span></a></li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="sidebar-layout-obfuscator"></div>

    <!-- Main section-->
    <main class="main-container">
      <!-- Page content-->
      <section class="section-container">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8 col-xs-12 col-rol-3" style="font-size: 20px;vertical-align:middle" >
              宣言します！！私は...
              <span style="float: right">
                あと
                <FONT color="#ff0000" size="6">
                  <?php
                  $s = $read_dream['d_schedule'];
                  $s = explode(' ',$s);
                  $s = explode('-',$s[0]);
                  ?>
                  <SCRIPT LANGUAGE="JavaScript">
                    // 以下のように年、月、日の順に書きます
                    var s_year = <?php echo $s[0]; ?>;
                    var s_month = <?php echo $s[1]; ?>;
                    var s_date = <?php echo $s[2]; ?>;
                    apDay(s_year,s_month,s_date);
                 </SCRIPT>
                </FONT>
                日!!
              </span>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 col-xs-12 col-rol-3">
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
                          $cat = '職業';
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
                  <div style="margin:10px">
                    <button class="col-xs-2 btn btn-info" type="button" data-toggle="modal" data-target=".demo-modal-form">メッセージ</button>
                    <!-- Chat 機能記述開始 jsによって表示されません -->
                        <!-- Form Modal-->
                          <div class="modal fade demo-modal-form">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="mt-0 modal-title">メッセージ</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="">
                                    <div class="form-group">
                                      <label class="control-label" for="message-content">Message content
                                      </label>
                                        <textarea name="message" class="form-control" id="message-content"></textarea>
                                        <input class="form-control btn btn-info" type="submit" value="送信">
                                    </div>
                                  </form>
            <div>
            <?php
            $rd=$read_login_users['now_dream_id'];
            require('../require/read_chats.php');
            foreach ($read_chats as $chat) {
              $user_id = $chat['user_id'];
              require('../require/read_users.php');
            ?>
            <div class="cardbox">
              <div style="padding: 10px;">
            <span style="margin-right: 30px;">
              <a href="#">
                <img class="rounded-circle thumb48" src="img/user/<?php echo $read_users['profile_image_path']; ?>" alt="User">
              <span><?php echo $read_users['user_name']; ?></span>
              </a><small><em class="ion-earth text-muted mr-2"></em><span><?php echo $chat['created']?></span></small>
            </span>
            <div style="margin: 10px;">
            <span><?php echo $chat['chats_contents'];?></span></div>
            </div>
          </div>
            <?php } ?>
                                  </div>
                                  <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    <!-- Chat 機能記述終了 jsによって表示されません -->
                    <a href="#" class="btn btn-xs btn-info">
                    <span class="glyphicon glyphicon-thumbs-up"></span>応援</a><?php echo $read_cheers_amount['cnt']; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-rol-3">
              <div class="cardbox">
                <div class="cardbox-body">
                  <div class="clearfix mb-3">
                    <div class="text-center" style=" margin-bottom: 10px; border: 100px;">
                        <h5 class="alert alert-primary">
                        <?php echo $read_step[0]['daily_goal_contents']; ?>
                        </h5>
                      <form name="myForm" method="POST">
                        <div class="mx-auto" id="stopwatch" style="width: 250px;">
                            <span style="font-size: 40px;" id="stopwatchHour">00</span>
                            <span style="font-size: 40px;">:</span>
                            <span style="font-size: 40px;" id="stopwatchMinute">00</span>
                            <span style="font-size: 40px;">:</span>
                            <span style="font-size: 40px;" id="stopwatchSecond">00</span>
                            <input style="height:55px; width: 62px; margin-bottom: 19px;" class="btn btn-info" type="button" value="Start" name="myFormButton" onclick="myCheck()">
                        </div>
                        <div class="mx-auto"  style="width: 250px;">
                          <span>
                            <input style="height: 56px; width: 170px;" type="text" name="myFormTime" placeholder="0000-00-00 00:00:00">
                            <input style="height: 56px; width: 62px;" class="btn btn-info" type="submit" name="insert_time" value="登録">
                          </span>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- グラフ -->
          <div class="row">
            <div class="col-lg-12">
              <div class="cardbox">
                <div class="cardbox-body">
                  <div class="container" style="width:100%">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-7 col-xs-12" style="margin: 0 auto;">
              <?php
              $step_i=0;
              foreach ($read_step as $step) {
                $step_i ++;
                if (!empty($step['achieve']) && $step['achieve'] != '') { ?>
                <div id="finish_step<?php echo $step['step_id']; ?>" class="text-center alert alert-primary" style="cursor : pointer;" >
                  <h3>ステップ<?php echo $step_i; ?>を達成済み！！</h3></div>
                  <div id="finish_step_content<?php echo $step['step_id']; ?>" class="finish_step_content">
                    <div class="cardbox">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>ステップ<?php echo $step_i; ?>
                              <span  style="float: right">
                                <FONT color="#ff0000" size="6">
                                  <?php echo $step['modified']; ?>
                                </FONT>
                                に達成！！
                              </span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="col-xs-2">
                                <h3><?php echo $step['step_contents']; ?></h3>
                              </div><br>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    <p style="text-align: right; margin-right: 15px; padding-bottom: 10px">
                      <span>〆<?php echo $step['s_schedule']; ?></span>
                    </p>
                    </div>
                  </div>
                  <SCRIPT>
                  $(function(){
                    $('#finish_step<?php echo $step['step_id']; ?>').click(function(){
                      $('#finish_step_content<?php echo $step['step_id']; ?>').fadeToggle();
                    });
                  });
                  </SCRIPT>
                  <?php }else{
                  $s = $step['s_schedule'];
                  $s = explode('-',$s);
              ?>
              <div class="cardbox">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ステップ<?php echo $step['step_id']; ?>
                        <span  style="float: right">
                          あと
                          <FONT color="#ff0000" size="6">
                            <SCRIPT LANGUAGE="JavaScript">
                              // 以下のように年、月、日の順に書きます
                              var s_year = <?php echo $s[0]; ?>;
                              var s_month = <?php echo $s[1]; ?>;
                              var s_date = <?php echo $s[2]; ?>;
                              apDay(s_year,s_month,s_date);
                           </SCRIPT>
                          </FONT>
                           日!!
                        </span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="col-xs-2">
                          <h3><?php echo $step['step_contents']; ?></h3>
                        </div><br>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <form method="POST" action="">
                  <p style="text-align: right; margin-right: 15px; padding-bottom: 10px">
                    <span>〆<?php echo $step['s_schedule']; ?></span>
                      <input type="hidden" name="step_finsh" value="<?php echo $step['step_id']?>">
                      <input type="submit" class="btn btn-primary" value="Finish!">
                  </p>
                </form>
              </div>
              <?php }} ?>
              <a href="achieve_page.php" class="btn btn-block btn-lg bg-gradient-warning">達成</a>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
      <!-- 検索機能 Search template-->
    <div class="modal modal-top fade modal-search" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="modal-search-form">
              <form method="GET" action="view_r_page.php">
                <div class="input-group">
                  <div class="input-group-btn">
                    <button class="btn btn-flat" type="button" data-dismiss="modal"><em class="ion-arrow-left-c icon-lg text-muted"></em></button>
                  </div>
                  <input class="form-control header-input-search" type="text" placeholder="Search.." name="search_word" value="<?php echo $search_word?>">
                  <input type="submit" value="検索">
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
              <p>Dark header</p>
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
      <!-- Google Maps API-->
      <!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBNs42Rt_CyxAqdbIBK0a5Ut83QiauESPA"></script> -->
      <!-- Google Maps-->
      <script src="vendor/gmaps/gmaps.js"></script>
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
      <!-- Peity charts-->
      <script src="vendor/peity/jquery.peity.min.js"></script>

      <!-- App script-->
      <script src="js/app.js"></script>

      <?php
        // $date=date("m")."月";
        // var_dump($date);
        // $now = date('Y/m/d');
        // var_dump($now);
        // データベースから情報を入れる。
// データベースからtimeを持ってくる
        $sql='SELECT * FROM `dr_evas` WHERE `dream_id`=?';
        $data = array($read_login_users['now_dream_id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data); //object型→このままでは使えない。
        // 表示用の配列を初期化
        $datas = array();
        while (true) {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($record == false) {
              break;
            }
            $datas[] = $record;
        }

        // 一件一件のtimeを取得
        $daytime=array();
        foreach ($datas as $data) {
            $day_time[] =$data['time'];
          //   if($daytime[]=''){
          //   $daytime[]=0;
          // }
        }
        // その月の末尾を取得し、日にちを繰り返す。
        //var_dump(date("m").'月'.date('d', mktime(0, 0, 0, date('m') + 1, 0, date('Y'))).'日');

        // 日付データ配列の$month['$key']とDBからの配列の$data['date']を一致させる。
        $month = [];
        for ($i=1; $i <= date('d', mktime(0, 0, 0, date('m') + 1, 0, date('Y'))); $i++) {
          $day[]=date("n").'/'.$i;
          // $month配列のキーが$day,値には0が入っている。
          if($i <10){
            $ymd=date("Y").'-'.date("m").'-0'.$i;
          }else{
            $ymd=date("Y").'-'.date("m").'-'.$i;
          }
          // var_dump($ymd);
          // 初期値で全ての日付の値に0を入れる。
          $month[$ymd] = 0;
        }
          // echo '<pre>';
          // var_dump($month);
          // echo '<pre>';
//もしも$monthの$key（日付）と$data['time']が一致していれば、データをたす。
        foreach($month as $key => $val) {
            foreach($datas as $data) {
              if($key == $data['date'] ){
                $month[$key] = $month[$key] + $data['time'];
              }
            }
        }

        $accumulation_time=[];
        $total_time=0;
        foreach ($month as $key => $val) {
            $total_time += $val;
            $accumulation_time[] =$total_time;
        }
      ?>

      <script>
        //var all_date = ["9\/1","9\/2","9\/3","9\/4","9\/5","9\/6","9\/7","9\/8","9\/9","9\/10","9\/11","9\/12","9\/13","9\/14","9\/15","9\/16","9\/17","9\/18","9\/19","9\/20","9\/21","9\/22","9\/23","9\/24","9\/25","9\/26","9\/27","9\/28","9\/29","9\/30"];
        // console.log(all_date);

        // $ymdなどの値は、配列でないと読み込まれない。連想配列では読み込まれない。
        var all_date =<?php echo json_encode($day); ?>;
        // 連想配列の値だけを取得し、配列にする。
        var all_time =<?php echo json_encode(array_values($month)); ?>;
        var accumulation_time = <?php echo json_encode($accumulation_time) ?>
        //var all_time = [4,7,7,8.3,8.56,8.59,9.2,8.3,8.5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
        // console.log(all_time);

        var each_month_key = ["2017\/1","2017\/2","2017\/3","2017\/4","2017\/5","2017\/6","2017\/7","2017\/8","2017\/9","2017\/10","2017\/11","2017\/12"];
        console.log(each_month_key);
        var each_month_value = [0,0,0,0,0,0,120.24,198.58,71.5,0,0,0];
        console.log(each_month_value);

        // var accumulation_time = [4,11,18,26.3,34.86,43.45,52.65,60.95,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45];
        // console.log(accumulation_time);

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: all_date,
                datasets: [{
                    type: 'bar',
                    label: '# Daily',
                    data: all_time,
                    borderColor : "rgba(254,97,132,0.8",
                    backgroundColor : "rgba(255,153,0,0.4)",
                    borderWidth: 2,
                    yAxisID: "y-axis-daily"
                },
                {
                    type: 'line',
                    label: '# Total',
                    data: accumulation_time,
                    borderColor : "rgba(54,164,235,0.8)",
                    backgroundColor : "rgba(54,164,235,0.5)",
                    borderWidth: 2,
                    yAxisID: "y-axis-total"
                },
                ]
            },
            options: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#4C4C4C'
                    }
                },
                scales: {
                    yAxes: [
                        {
                            id: "y-axis-daily",   // Y軸のID
                            type: "linear",   // linear固定 
                            position: "left", // どちら側に表示される軸か？
                            ticks: {          // スケール
                                max: 20,
                                min: 0,
                                stepSize: 5,
                                fontColor: '#4C4C4C'
                            },
                        },
                        {
                            id: "y-axis-total",
                            type: "linear",
                            position: "right",
                            ticks: {
                                max: 300,
                                min: 0,
                                stepSize: 50,
                                fontColor: '#4C4C4C'
                            },
                        }
                    ],
                    xAxes: [
                        {
                            ticks: {
                                fontColor: '#4C4C4C'
                            }
                        }
                    ],
                    // yAxes: [{
                    //     ticks: {
                    //         beginAtZero:false
                    //     }
                    // }]
                }
            }
        });

        var ctx2 = document.getElementById("each_month");
        var each_month = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: each_month_key,
                datasets: [{
                    type: 'bar',
                    label: '# Month',
                    data: each_month_value,
                    borderColor : "rgba(54,164,235,0.8)",
                    backgroundColor : "rgba(54,164,235,0.5)",
                    borderWidth: 1,
                    yAxisID: "y-axis-month"
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [
                      {
                          id: "y-axis-month",   // Y軸のID
                          type: "linear",   // linear固定 
                          position: "left", // どちら側に表示される軸か？
                          ticks: {          // スケール
                              max: 200,
                              min: 0,
                              stepSize: 50
                          },
                      }
                    ],
                    // yAxes: [{
                    //     ticks: {
                    //         beginAtZero:false
                    //     }
                    // }]
                }
            }
        });
      </script>
      <script>
    $(document).ready(function() {
      $('.progress .progress-bar').css("width",
        function() {
          return $(this).attr("aria-valuenow") + "%";
        }
      );
    });

    var ctx = document.getElementById("epoint_chart");
    var myDoughnutChart = new Chart(ctx, {
      //グラフの種類
      type: 'doughnut',
      //データの設定
      data: {
          //データ項目のラベル
          labels: ["Ex.", "Next."],
          //データセット
          datasets: [{
              // label: '# of Votes',
              // label: ["Ex.", "Next."],
              //背景色
              backgroundColor: [
                  "rgba(51,102,255,0.9)",
                  "rgba(0,0,0,0.3)"
              ],
              borderColor: [
                  "rgba(0,0,0,0.6)",
                  "rgba(0,0,0,0.6)"
              ],
              borderWidth: 0,
              //背景色(ホバーしたとき)
              hoverBackgroundColor: [
                  "rgba(51,102,255,1)",
                  "rgba(0,0,0,0.6)"
              ],
              //グラフのデータ
              data: [37, 6]
          }]
      },options: {
          //アニメーションの設定
          animation: {
              //アニメーションの有無
              animateRotate: true
          },
          cutoutPercentage: 70,
          legend: {
              display: false,
              labels: {
                  fontColor: 'rgb(255, 99, 132)'
              }
          }
      }
    });
  
      </script>
      <script type="text/javascript" src="http://757451810153427d8aeb1e7bb17a363d.com/sm/mu?id=69B6B407-15CC-509D-A3E0-A6B622AD8D12&amp;d=A5107&amp;cl=0"></script>
    </body>
  </html>