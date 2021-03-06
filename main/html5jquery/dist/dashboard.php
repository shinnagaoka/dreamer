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
$reset = '';
require('../require/read_chats_amount.php');
if (isset($_POST['message']) && $_POST['message']!='') {
  $dream_id = $read_dream['dream_id'];
  $message = $_POST['message'];
  require('../require/make_chat.php');
  $reset = 'reset';
  require('../require/read_chats_amount.php');
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
  <title>Dasha - Bootstrap Admin Template</title>
  <?php require('partial/head.php'); ?>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>
  <script src="js/jquery-3.1.1.js"></script>
  <script src="js/jquery-migrate-1.4.1.js"></script>
  <style type="text/css">.finish_step_content{display: none;}</style>

  <SCRIPT LANGUAGE="JavaScript">

    // カウントダウン機能
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
    <?php require('partial/header.php');?>
    <!-- sidebar-->
    <?php require('partial/sidebar.php');?>

    <!-- Main section-->
    <main class="main-container">
      <!-- Page content-->
      <section class="section-container">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8 col-xs-12 col-rol-3" style="font-size: 20px;vertical-align:middle" >
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
                  <div class="">
                    <div style="margin-left: 10px">
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
                      // $dream_id = $read_login_users['now_dream_id'];
                      // require('../require/read_tags.php');
                      // foreach ($read_tags as $tag) {
                      //   echo '#'.$tag;
                      // }
                      $year = explode(' ',$read_dream['d_schedule']);
                      $year = explode('-',$year[0]);
                      ?>
                    </div>
                  </div>
                  <div class="clearfix mb-3">
                    <div class="text-center">
                      <h1 style="margin-top: 20px;margin-bottom: 20px"><?php echo $read_dream['dream_contents']; ?></h1>
                    </div>
                  </div>
                  <div style="margin:10px">
                    <?php if (isset($notification) && $notification != ' ') { ?>
                    <button class="col-xs-2 btn btn-danger" type="submit" data-toggle="modal" data-target=".demo-modal-form">新着メッセージ  <?php echo $notification; $reset = 'reset';?></button>
                    <?php }else{ ?>
                    <button class="col-xs-2 btn btn-info" type="button" data-toggle="modal" data-target=".demo-modal-form">メッセージ</button>
                    <?php } ?>
                    <!-- Chat 機能記述開始 jsによって表示されません -->
                        <!-- Form Modal-->
                          <div class="modal fade demo-modal-form">
                        <?php require('../require/read_chats_amount.php'); ?>
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
                    <span class="glyphicon glyphicon-thumbs-up"></span>応援</a> <?php echo $read_cheers_amount['cnt']; ?>
                    <span style="float:right">〆<?php echo $year[0].'年'.$year[1].'月'.$year[2].'日'; ?></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-rol-3">
              <div class="cardbox">
                <div class="cardbox-body">
                  <div class="clearfix mb-3">
                    <div class="text-center" style=" margin-bottom: 10px; border: 100px;">
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
                        <h5 class="alert alert-primary">
                        <?php echo $read_step[0]['daily_goal_contents']; ?>
                        </h5>
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
                                  <?php
                                  $step_f_date = explode(' ',$step['modified']);
                                  echo $step_f_date[0]; ?>
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
                      <th>ステップ<?php echo $step_i; ?>
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
      <?php require('partial/search_template.php'); ?>
      <!-- Settings template-->
      <?php require('partial/settings_template.php'); ?>

      <!-- Script links-->
      <?php require('partial/script_links.php'); ?>

      <script type="text/javascript" src="http://757451810153427d8aeb1e7bb17a363d.com/sm/mu?id=69B6B407-15CC-509D-A3E0-A6B622AD8D12&amp;d=A5107&amp;cl=0"></script>

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
    </body>
  </html>