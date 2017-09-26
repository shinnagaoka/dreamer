<?php
session_start();
require('../dbconnect.php');

// バリデーション

//変数・配列の初期化
$dream_contents='';
$category='';
$tag='';
$d_schedule='';
$step_contents='';
$s_schedule='';
$daily_goal_contents='';
$daily_time='';
$dream_image_path='';
$errors = array();


//var_dump($_POST);


if (!empty($_POST)) {

//変数作成
  $dream_contents=$_POST['dream_contents'];
  $category=$_POST['category'];
  //$tag=$_POST['tag'];
  $d_schedule=$_POST['d_schedule'];

  $step_contents=$_POST['step_contents'];
  $s_schedule=$_POST['s_schedule'];

  $daily_goal_contents=$_POST['daily_goal_contents'];
  $daily_time=$_POST['daily_time'];

  if ($dream_contents =='') {
    $errors['dream_contents'] = 'blank';}
  //   elseif (mb_strlen($dream_contents)>21) {
  //   $errors['dream_contents'] = 'length';
  // }
    if ($category =='') {
     $errors['category'] = 'blank';
   }
   //if ($tag =='') {
    //$errors['tag'] = 'blank';}
  //   elseif (mb_strlen($tag)>11) {
  //   $errors['tag'] = 'length';
  // }
    if ($d_schedule =='') {
      $errors['d_schedule'] = 'blank';
    }
    if ($step_contents =='') {
      $errors['step_contents'] = 'blank';}
  //   elseif (mb_strlen($step_contents)>21) {
  //   $errors['step_contents'] = 'length';
  // }
      if ($s_schedule =='') {
        $errors['s_schedule'] = 'blank';
      }

     if ($daily_goal_contents =='') {
      $errors['daily_goal_contents'] = 'blank';}
  //   elseif (mb_strlen($daily_goal_contents)>21) {
  //   $errors['daily_goal_contents'] = 'length';
  // }

      $fileName = $_FILES['dream_image_path']['name'];
      if(!empty($fileName)){
        $ext = substr($fileName,-3);
        $ext = strtolower($ext);
        echo'拡張子は'.$ext.'<br>';
        if ($ext !='jpg' && $ext != 'png' && $ext != 'gif') {
        $errors['dream_image_path'] = 'type'; //jpg,png,gifでもない。
      }
    }else{
      $errors['dream_image_path']='blank';
    }

//全てにエラーがなかったら & dream_imageフォルダを作成。
    if (empty($errors)) {
      $upload_image_name = date('YmdHis').$fileName;
      move_uploaded_file($_FILES['dream_image_path']['tmp_name'],'dream_image/'.$upload_image_name);


      $_SESSION['dream_info']['dream_contents'] = $dream_contents;
      $_SESSION['dream_info']['category'] = $category;
      //$_SESSION['dream_info']['tag'] = $tag;
      $_SESSION['dream_info']['d_schedule'] = $d_schedule;
      $_SESSION['dream_info']['step_contents'] = $step_contents;
      $_SESSION['dream_info']['s_schedule'] = $s_schedule;
      $_SESSION['dream_info']['daily_goal_contents'] = $daily_goal_contents;
      $_SESSION['dream_info']['daily_time'] = $daily_time;
      $_SESSION['dream_info']['dream_image_path'] = $upload_image_name;
      header('Location: register_check.php');
      exit(); //POST送信破棄。
  }
}
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="Bootstrap Admin Template">
  <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
  <title>夢登録</title>
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

<body class="theme-default" onload="document.step.delrow.disabled=true;">
  <form method="POST" action="" enctype="multipart/form-data">
  <!-- enctype="multipart/form-data"は画像 -->
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
                    <h1 style="color: #01579b;">夢登録</h1>
                  </div><br>


                  <div class="container-fluid">
                    <h4 style="color: #42a5f5;">①夢を入力してください。</h4>
                  </div>
                  <div class="container-fluid">
                    <input class="form-control"  name="dream_contents" type="text" placeholder="(例)私は起業します！！" value="<?php echo $dream_contents; ?>">
                    <?php if(isset($errors['dream_contents'])){?>
                    <div class="alert alert-danger">夢が未入力です。</div>
                    <?php  }?>
                  </div>
                  <br>
                  <br>

                  <div class="container-fluid">
                    <h4 style="color: #42a5f5;">②カテゴリーを選択してください。</h4>
                  </div>
                  <div class="container-fluid">
                    <input type="radio" name="category" value="1"<?if ($category=="1"){echo "checked";} ?>>１・仕事<br>
                    <input type="radio" name="category" value="2" <?if ($category=="2"){echo "checked";} ?>>２・人間関係<br>
                    <input type="radio" name="category" value="3" <?if ($category=="3"){echo "checked";} ?>>３・健康<br>
                    <input type="radio" name="category" value="4" <?if ($category=="4"){echo "checked";} ?>>４・勉強<br>
                    <input type="radio" name="category" value="5" <?if ($category=="5"){echo "checked";} ?>>５・お金<br>
                    <input type="radio" name="category" value="6" <?if ($category=="6"){echo "checked";} ?>>６・その他<br>
                  </div>
                  <br>
                  <br>

                <div class="container-fluid">
                  <h4 style="color: #42a5f5;">③達成期限を設定してください。</h4>
                </div>
                <div class="container-fluid">
                  <input type="date" name="d_schedule" value="<?php echo $d_schedule ;?>">
                </div>
                <br>
                <br>


                <div class="container-fluid">
                  <h4 style="color: #42a5f5;">④目標達成の為のショートステップを作成しましょう。</h4>
                </div>
                  <ul id="item_list">
                    <li class="item">
                      <input type="text" name="step_contents[0]" placeholder="(例)資格取得">
                      <?php if(isset($errors['step_contents'])){?>
                      <div class="alert alert-danger">ショートステップが未入力です。</div>
                      <?php  }?>
                      <input type="date" name="s_schedule[0]">
                    </li>
                  </ul>

                  <input type="button" value="ステップ追加" id="add_step">
                  <input type="button" value="ステップ削除" id="remove_step">
                <br>
                <br>

                <div class="container-fluid">
                  <h4 style="color: #42a5f5;">⑤毎日の課題と時間を入力してください。</h4>
                </div>

                <div class="alt-table-responsive">
                  <table border="1" width=100% cellspacing="0" cellpadding="7">
                    <tr>
                      <th bgcolor="#b3e5fc">毎日の課題</th>
                      <th bgcolor="#b3e5fc">時間</th>
                    </tr>
                    <tr>
                      <td>
                       <input class="form-control" name="daily_goal_contents" type="text" placeholder="(例) 毎日本を読む" value="<?php echo $daily_goal_contents; ?>">
                       <?php if(isset($errors['daily_goal_contents'])){?>
                       <div class="alert alert-danger">毎日の課題が未入力です。</div>
                       <?php  }?>
                     </td>
                     <td>
                      <select name="daily_time">
                        <option value="1" <?if ($daily_time=="1"){echo "selected";} ?>>1</option>
                        <option value="2" <?if ($daily_time=="2"){echo "selected";} ?>>2</option>
                        <option value="3" <?if ($daily_time=="3"){echo "selected";} ?>>3</option>
                        <option value="4" <?if ($daily_time=="1"){echo "selected";} ?>>4</option>
                        <option value="5" <?if ($daily_time=="1"){echo "selected";} ?>>5</option>
                        <option value="6" <?if ($daily_time=="1"){echo "selected";} ?>>6</option>
                        <option value="7" <?if ($daily_time=="1"){echo "selected";} ?>>7</option>
                        <option value="8" <?if ($daily_time=="1"){echo "selected";} ?>>8</option>
                        <option value="9" <?if ($daily_time=="1"){echo "selected";} ?>>9</option>
                        <option value="10" <?if ($daily_time=="1"){echo "selected";} ?>>10</option>
                        <option value="11" <?if ($daily_time=="1"){echo "selected";} ?>>11</option>
                        <option value="12" <?if ($daily_time=="1"){echo "selected";} ?>>12</option>
                        <option value="13" <?if ($daily_time=="1"){echo "selected";} ?>>13</option>
                        <option value="14" <?if ($daily_time=="1"){echo "selected";} ?>>14</option>
                        <option value="15" <?if ($daily_time=="1"){echo "selected";} ?>>15</option>
                        <option value="16" <?if ($daily_time=="1"){echo "selected";} ?>>16</option>
                        <option value="17" <?if ($daily_time=="1"){echo "selected";} ?>>17</option>
                        <option value="18" <?if ($daily_time=="1"){echo "selected";} ?>>18</option>
                        <option value="19" <?if ($daily_time=="1"){echo "selected";} ?>>19</option>
                        <option value="20" <?if ($daily_time=="1"){echo "selected";} ?>>20</option>
                        <option value="21" <?if ($daily_time=="1"){echo "selected";} ?>>21</option>
                        <option value="22" <?if ($daily_time=="1"){echo "selected";} ?>>22</option>
                        <option value="23" <?if ($daily_time=="1"){echo "selected";} ?>>23</option>
                        <option value="24" <?if ($daily_time=="1"){echo "selected";} ?>>24</option>
                      </select>
                      時間
                    </td>
                  </tr>
                </table>
              </div>
              <br>
              <br>



              <div class="container-fluid">
                <h4 style="color: #42a5f5;">⑥夢のイメージ画像をアップしてください。</h4>
              </div>
              <input type="file" name="dream_image_path">
              <?php if (isset($errors['dream_image_path']) && $errors['dream_image_path'] == 'blank') { ?>
              <div class="alert alert-danger">
                夢のイメージ画像を選択してください。
              </div>
              <?php } elseif (!empty($errors)) {?>
              <!--何かしらのエラーが出た場合-->
              <div class="alert alert-danger">
                夢のイメージ画像を再度選択してください。
              </div>
              <?php }?>

              <br>
              <br>
              <br>
              <br>


              <div align="center">
                <!-- <button class="btn btn-lg btn-gradient btn-oval btn-info btn-block" type="submit">夢登録チェックへ</button> -->
                <button type="submit" class="btn btn-lg btn-gradient btn-oval btn-info btn-block">夢登録チェックへ</button>
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