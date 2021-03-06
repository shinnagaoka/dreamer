<?php
session_start();
require('../dbconnect.php');

$_SESSION['login_user']['user_id'];
require('../require/read_users_session.php');

$step_contents='';
$s_schedule='';
$daily_goal_contents='';
$daily_time='';
$errors = array();

//dr_stepsの内容
$sql='SELECT * FROM `dr_steps` WHERE `dream_id`=?';
$data=array($read_login_users['now_dream_id']);
$stmt=$dbh->prepare($sql);
$stmt->execute($data);
$steps=array();
while (true) {
  $step = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($step == false) {
    break;
  }
  $steps[] =$step;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="Bootstrap Admin Template">
  <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
  <title>ショートステップ追加</title>
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
</head>

<body class="theme-default" onload="document.hogehoge.delrow.disabled=true;">
  <div class="layout-container">
    <!-- top navbar削除-->
    <!-- side bar削除-->
    <!-- Main section-->
    <!-- Page content-->
    <div class="cardbox">
      <div class="cardbox-body">
        <div style="margin-top : 60px">
          <div style="margin-right : 300px">
            <div style="margin-bottom : 300px">
              <div style="margin-left : 300px">

                <div class="container-fluid">
                  <h1 style="color: #01579b;">ショートステップ追加</h1>
                <div class="container-fluid">
                  <h2 style="color: #01579b;">● 前の情報 ●</h2>
                </div>

                <?php foreach($steps as $ste){?>
                <div class="container-fluid">
                  <h5 style="color: #42a5f5;">ショートステップ</h5>
                  <?php foreach ((array)$ste['step_contents'] as $step_contents) {
                    echo $step_contents.'<br>';
                  } ?>
                  <?php foreach ((array)$ste['s_schedule'] as $s_schedule) {
                    echo $s_schedule;
                  }?>
                </div>
                <?php } ?>
                <br>
                <br>
                <br>
                <div class="container-fluid">
                  <h2 style="color: #01579b;">● 追加 ●</h2>
                </div>
                <form method="post" action="edit_step_add_done.php">

                  <div class="container-fluid">
                    <h4 style="color: #42a5f5;">ショートステップが追加できます。</h4>
                  </div>

                  <ul id="item_list">
                      <li class="item">
                        <input type="text" name="step_contents[0]">
                        <input type="date" name="s_schedule[0]">
                        </li>
                    </ul>

                    <input type="button" value="ステップ追加" id="add_step">
                    <input type="button" value="ステップ削除" id="remove_step">
                    <br>
                    <br>
                    <!-- 毎日の課題、時間のデータをhiddenで送る -->

                          <input name="daily_goal_contents" type="hidden" value="<?php echo $ste['daily_goal_contents'];?>">
                          <input  name="daily_time" type="hidden" value="<?php echo $ste['daily_time'];?>" >
                    <br>
                    <br>
                    <div align="center">
                    <button type="submit" class="btn btn-lg btn-gradient btn-oval btn-info btn-block">編集終了</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
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
    <!-- App script-->
    <script src="js/app.js"></script>
    <script>
      //追加ボタン
      $('input#add_step').click(function(){
        var c = $('li.item').length;
        console.log(c);


        $('ul#item_list').append('<li class="item"><input type="text" name="step_contents['+c+']"><input type="date" name="s_schedule['+c+']"></li>');
      });
      //削除ボタン
        //消す時は下から消す。
        $('input#remove_step').click(function(){
          var c = $('li.item').length;
          console.log(c);
          $('li.item').eq(c-1).remove();

        });
    </script>
  </body>
  </html>

