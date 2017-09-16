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
$rd = $_GET['dream'];
require('../require/read_dream.php');
$user_id = $read_dream['user_id'];
require('../require/read_users.php');
$this_dream_id = $read_users['now_dream_id'];
require('../require/read_cheers_amount.php');
if ($_GET['dream']==$read_login_users['now_dream_id']) {
  header('Location: dashboard.php');
  exit();
}
if (isset($_POST['message']) && $_POST['message']!='') {
  $dream_id = $read_dream['dream_id'];
  $message = $_POST['message'];
  require('../require/make_chat.php');
  header('Location: other_mypage.php?dream='.$dream_id);
  exit();
}
if (isset($_POST['cheer']) && $_POST['cheer']=='true') {
  $user_id = $_SESSION['login_user']['user_id'];
  $dream_id = $_GET['dream'];
  require('../require/make_cheers.php');
  header('Location: other_mypage.php?dream='.$dream_id);
  exit();
}
if (isset($_POST['cheer']) && $_POST['cheer']=='false') {
  $dream_id = $_GET['dream'];
  var_dump($dream_id);
  require('../require/delete_cheers.php');
  header('Location: other_mypage.php?dream='.$dream_id);
  exit();
}
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
    <!--
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
    document.myForm.myFormTime.value = myH+":"+myM+":"+myS;
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
      <nav>
        <ul class="hidden-lg-up">
          <li><a class="sidebar-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
        </ul>
        <ul class="hidden-xs-down">
          <li><a class="covermode-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
        </ul>
        <h2 class="header-title"></h2>
        <ul class="float-right">
          <li><a id="header-search" href="#"><em class="ion-ios-search-strong"></em></a></li>
          <li><a id="header-settings" href="#"><em class="ion-more"></em></a></li>
          <li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><em class="ion-ios-keypad"></em></a>
          </li>
          <li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><img class="header-user-image" src="img/user/<?php echo $read_login_users['profile_image_path']; ?>" alt="header-user-image"><!-- <sup class="badge bg-danger">3</sup> --></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-scale">
              <h6 class="dropdown-header">ユーザーメニュー</h6><a class="dropdown-item" href="dashboard.php"><!-- <span class="float-right badge badge-primary">4</span> --><em class="ion-ios-email-outline icon-lg text-primary"></em>マイページ</a><a class="dropdown-item" href="#"><em class="ion-ios-gear-outline icon-lg text-primary"></em>編集</a>
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
          <span class="brand-header-logo-text">Dreamer</span></a>
      </div>
      <div class="sidebar-content">
        <div class="sidebar-toolbar">
          <div class="sidebar-toolbar-background"></div>
          <div class="sidebar-toolbar-content text-center"><a href="#"><img class="rounded-circle thumb64" src="img/user/<?php echo $read_users['profile_image_path']; ?>" alt="Profile"></a>
            <div class="mt-3">
              <div class="lead"><?php echo $read_users['user_name']; ?></div>
                <div class="text-thin"></div>
             </div>
          </div>
        </div>
        <nav class="sidebar-nav">
          <ul>
            <li>
              <div class="sidebar-nav-heading">マイページ</div>
            </li>
              <li><a href="other_mypage.php?dream=<?php echo $this_dream_id;?>"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-speedometer-outline"></em></span><span>進行中の夢</span></a></li>
              <li><a href="#"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-settings"></em></span><span>達成された夢</span></a>
                <ul class="sidebar-subnav" id="elements">
                  <li><a href="buttons.html"><span class="float-right nav-label"></span><span>No.1</span></a></li>
                  <li><a href="bootstrapui.html"><span class="float-right nav-label"></span><span>No.2</span></a></li>
                </ul>
              </li>
            <li>
              <div class="sidebar-nav-heading">閲覧</div>
            </li>
              <li><a href="view_c_page.php"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-list-outline"></em></span><span>カテゴリー別</span></a>
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

              <li><a href="view_c_n_page.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-settings"></em></span><span>応援している夢</span></a></li>
              <li><a href="view_h_page.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-speedometer-outline"></em></span><span>履歴</span></a></li>
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
                  <SCRIPT LANGUAGE="JavaScript">
                    apDay(2019,2,13);
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
                      仕事 #エンジニア #英語
                      <span style="float:right">〆2019年2月13日</span>
                    </div>
                  </div>
                  <div style="margin:10px">
                    <form method="POST" action="">
                    <button class="col-xs-2 btn btn-info" type="button" data-toggle="modal" data-target=".demo-modal-form">メッセージ</button>
                      <?php
                      $rd = $_GET['dream'];
                      require('../require/read_cheers_check.php');
                      if ($read_cheers_check['cnt']==0) { ?>
                        <input type="hidden" name="cheer" value="true">
                        <input type="submit" class="btn btn-xs btn-info" value="応援">
                      <?php }else{ ?>
                        <input type="hidden" name="cheer" value="false">
                        <input type="submit" class="btn btn-xs btn-primary" value="応援取り消し">
                      <?php } ?>応援数:
                    <?php echo $read_cheers_amount['cnt']; ?>
                    </form>
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
            $rd = $_GET['dream'];
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
                    <canvas id="canvas"></canvas>
                  </div>
                  <script>
                    window.onload = function() {
                      ctx = document.getElementById("canvas").getContext("2d");
                      window.myBar = new Chart(ctx, {
                        type: 'bar',
                        data: barChartData,
                        options: complexChartOption
                      });
                    };
                  </script>

                  <script>
                    var barChartData = {
                      labels: ['9/1','9/2','9/3','9/4','9/5','9/6','9/7','9/8',
                      '9/9','9/10','9/11','9/12','9/13','9/14',
                      '9/15','9/16','9/17','9/18','9/19','9/20','9/21','9/22',
                      '9/23','9/24','9/25','9/26','9/27','9/28','9/29','9/30'
                      ],
                      datasets: [
                        {
                          type: 'bar',
                          label: 'Daily',
                          data: ['4','2','6','8','1','0','4',
                          '6','3','1','5','2','5','4',
                          '0','3','7','3','6','4','9',
                          '3','5','5','7','4','7','8','2','10'
                          ],
                          borderColor : "rgba(254,97,132,0.8)",
                          pointBackgroundColor    : "rgba(254,97,132,0.8)",
                          backgroundColor: "rgba(255,153,0,0.4)",
                          fill: false,
                              yAxisID: "y-axis-1",// 追加
                            },
                            {
                              type: 'line',
                              label: 'Total',
                              data: ['4','6','12','20','21','21','25',
                              '31','34','35','40','42','47','51',
                              '51','54','61','64','70','74','83',
                              '86','91','96','103','107','114','122','144','154'
                              ],
                              borderColor : "rgba(54,164,235,0.8)",
                              backgroundColor : "rgba(54,164,235,0.5)",
                              yAxisID: "y-axis-2",
                            },
                            ],
                          };
                  </script>
                  <script>
                          var complexChartOption = {
                            responsive: true,
                            scales: {
                              yAxes: [{
                                id: "y-axis-1",
                                type: "linear", 
                                position: "left",
                                ticks: {
                                  max: 20,
                                  min: 0,
                                  stepSize: 5
                                },
                              }, {
                                id: "y-axis-2",
                                type: "linear", 
                                position: "right",
                                ticks: {
                                  max: 300,
                                  min: 0,
                                  stepSize: 50
                                },
                                gridLines: {
                                  drawOnChartArea: false, 
                                },
                              }],
                            }
                          };
                  </script>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-7 col-xs-12" style="margin: 0 auto;">
              <div class="cardbox">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ステップ1
                        <span  style="float: right">
                          あと
                          <FONT color="#ff0000" size="6">
                            <SCRIPT LANGUAGE="JavaScript">
                              <!--// 以下のように年、月、日の順に書きます
                             apDay(2017,12,18);//-->
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
                          <h3>留学する</h3>
                        </div><br>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <p style="text-align: right; margin-right: 15px; padding-bottom: 10px">
                  <span>〆2017年12月18日</span>
                  <a class="btn btn-primary" id="swal-demo3" href="#">Finish!</a>
                </p>
              </div>
              <div class="cardbox">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ステップ2
                        <span style="float: right">
                            あと
                            <FONT color="#ff0000" size="6">
                              <SCRIPT LANGUAGE="JavaScript">
                                <!--// 以下のように年、月、日の順に書きます
                                apDay(2018,3,18);//-->
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
                           <h3>シリコンバレーで働く</h3>
                        </div><br>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <p style="text-align: right; margin-right: 15px; padding-bottom: 10px">
                  <span>〆2018年3月18日</span>
                  <a class="btn btn-primary" id="swal-demo3" href="#">Finish!</a>
                </p>
              </div>
              <a href="achieve_page.php" class="btn btn-block btn-lg bg-gradient-warning">達成</a>
            </div>
          </div>
        </div>
      </section>
    </main>
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
              <p>Dark sidebar</p>
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
    </body>
  </html>