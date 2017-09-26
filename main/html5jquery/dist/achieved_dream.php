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
$search_word='';
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
    <?php require('partial/header.php');?>
    <!-- sidebar-->
    <?php require('partial/sidebar.php');?>

    <!-- Main section-->
    <main class="main-container">
      <!-- Page content-->
      <?php
        $user_id=$_GET['user'];
        require('../require/read_users.php');
      ?>
      <section class="section-container">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-rol-12 text-center">
              <h1><?php echo $read_users['user_name']?>の達成した夢一覧</h1>
            </div>
          </div>
          <br>
            <div class="row">
          <?php
        require('../require/read_dream_by_user.php');
          foreach ($read_dream as $dream) {
            $rd = $dream['dream_id'];
            require('../require/read_cheers_amount.php');
            if ($read_login_users['now_dream_id']==$dream['dream_id']) {
              //飛ばす
              $cnt=count($read_dream);
              if ($cnt==1) {
                echo "まだ夢を達成していません。";
              }
            }
            else{ ?>
                <div class="col-lg-4 col-md-4"  style="margin-top: 20px;">
                  <div class="card">
                    <a href="other_mypage.php?dream=<?php echo $dream['dream_id'];?>">
                    <img class="card-img-top img-fluid" src="dream_image/<?php echo $dream['dream_image_path']; ?>" alt="Card image cap" style="height: 100%; width: 100%;">
                    <div class="card-block">
                      <h2 class="card-title"><?php echo $dream['dream_contents']; ?></h2>
                      <?php echo $dream['created']; ?><br>
                      応援された数：<?php echo $read_cheers_amount['cnt']; ?><br>
                    </div>
                  </a>
                  </div>
                </div>
           <?php } } ?>
              </div>
<!-- Main Function Part End  ============================================ -->
      <!-- 検索機能 Search template-->
      <?php require('partial/search_template.php'); ?>

      <!-- Settings template-->
      <?php require('partial/settings_template.php'); ?>

      <!-- Script links-->
      <?php require('partial/script_links.php'); ?>
    </body>
  </html>