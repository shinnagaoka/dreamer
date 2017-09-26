<?php
session_start();
require('../dbconnect.php');

$_SESSION['login_user']['user_id'];
require('../require/read_users_session.php');

//変数・配列の初期化
$dream_contents='';
$category='';
$tag='';
$d_schedule='';
$dream_image_path='';
$errors = array();

//お客さんが前に入れていた情報取得したい ↓
  //dr_dreamsの内容
$sql = 'SELECT * FROM `dr_dreams` WHERE `dream_id`=?';
$data = array($read_users['now_dream_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$info=$stmt->fetch(PDO::FETCH_ASSOC);

// echo "夢<pre>";
// var_dump($info);
// echo "</pre>";

  //dr_tagsの内容
$sql = 'SELECT * FROM `dr_tags` WHERE `dream_id`=?';
$data = array($read_users['now_dream_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$tag=$stmt->fetch(PDO::FETCH_ASSOC);

// echo "タグ<pre>";
// var_dump($tag);
// echo "</pre>";

//dr_stepsの内容
$sql='SELECT * FROM `dr_steps` WHERE `dream_id`=?';
$data=array($read_users['now_dream_id']);
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
  <title>夢編集</title>
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
                  <h1 style="color: #01579b;">夢編集</h1>
                </div><br>

                <div class="container-fluid">
                  <h2 style="color: #01579b;">● 前の情報 ●</h2>
                </div>

                <div class="container-fluid">
                 <h5 style="color: #42a5f5"> ①夢</h5>
                 <?php echo $info['dream_contents']; ?>
               </div>
               <div class="container-fluid">
                <h5 style="color: #42a5f5">②カテゴリー</h5>
                <?php echo $info['category']; ?>
              </div>
              <div class="container-fluid">
               <h5 style="color: #42a5f5"> ③タグ</h5>
               <?php echo $tag['tag_contents'];?>
             </div>
             <div class="container-fluid">
              <h5 style="color: #42a5f5">④夢達成 期限</h5>
              <?php echo $info['d_schedule'];?>
            </div>

            <div class="container-fluid">
              <h5 style="color: #42a5f5">⑤夢のイメージ画像</h5>
              <?php echo $info['dream_image_path']; ?><br><br>
              <img src="dream_image/<?php echo $info['dream_image_path']; ?>" width="150">
            </div>

            <?php foreach($steps as $ste){?>
            <?php }?>
            <br>
            <br>
            <br>


            <div class="container-fluid">
              <h2 style="color: #01579b;">● 変更 ●</h2>
            </div>
            <form method="post" action="edit_done.php" enctype="multipart/form-data">
              <div class="container-fluid">
                <h4 style="color: #42a5f5;">①夢を入力してください。</h4>
              </div>
              <div class="container-fluid">
                <input  name="dream_contents" type="text" value="<?php echo $info['dream_contents']; ?>">
              </div>
              <br>
              <br>
              <div class="container-fluid">
                <h4 style="color: #42a5f5;">②カテゴリーを選択してください。</h4>
              </div>
              <div class="container-fluid">
                <input type="radio" name="category" value="1"<?if ($info['category']=="1"){echo "checked";} ?>>
                １・仕事<br>
                <input type="radio" name="category" value="2" <?if ($info['category']=="2"){echo "checked";} ?>>２・人間関係<br>
                <input type="radio" name="category" value="3" <?if ($info['category']=="3"){echo "checked";} ?>>３・健康<br>
                <input type="radio" name="category" value="4" <?if ($info['category']=="4"){echo "checked";} ?>>４・勉強<br>
                <input type="radio" name="category" value="5" <?if ($info['category']=="5"){echo "checked";} ?>>５・お金<br>
                <input type="radio" name="category" value="6" <?if ($info['category']=="6"){echo "checked";} ?>>６・その他<br>
              </div>
              <br>
              <br>
              <div class="container-fluid">
               <h4 style="color: #42a5f5;">③タグを入力してください。</h4>
             </div>
             <div class="container-fluid">
              <input type="text" name="tag" value="<?php echo $tag['tag_contents'];?>">
            </div>
            <br>
            <br>
            <div class="container-fluid">
              <h4 style="color: #42a5f5;">④達成期限を設定してください。</h4>
            </div>
            <div class="container-fluid">
              <input type="date" name="d_schedule" value="<?php echo $info['d_schedule'];?>">
            </div>
            <br>
            <br>

            <br>
            <br>
            <div class="container-fluid">
              <h4 style="color: #42a5f5;">⑤夢のイメージ画像をアップしてください。</h4>
            </div>
            <input type='file' name='dream_image_path'><br><br>
            <?php echo $info['dream_image_path']; ?><br><br>
            <img src="dream_image/<?php echo $info['dream_image_path']; ?>" width="150">
            <br><br><br><br>
            <div class="container-fluid">
              <h4 style="color: #42a5f5;">⑥毎日の課題と時間を入力してください。</h4>
            </div>

            <div class="alt-table-responsive">
              <table border="1" width=100% cellspacing="0" cellpadding="7">
                <tr>
                  <th bgcolor="#b3e5fc">毎日の課題</th>
                  <th bgcolor="#b3e5fc">時間</th>
                </tr>
                <tr>
                  <td>
                   <input class="form-control" name="daily_goal_contents" type="text" value="<?php echo $ste['daily_goal_contents'];?>">
                 </td>
                 <td>
                  <select name="daily_time">
                    <option value="1" <?if ($ste['daily_time']=='1'){echo "selected";} ?>>1</option>
                    <option value="2" <?if ($ste['daily_time']=='2'){echo "selected";} ?>>2</option>
                    <option value="3" <?if ($ste['daily_time']=='3'){echo "selected";} ?>>3</option>
                    <option value="4" <?if ($ste['daily_time']=='4'){echo "selected";} ?>>4</option>
                    <option value="5" <?if ($ste['daily_time']=='5'){echo "selected";} ?>>5</option>
                    <option value="6" <?if ($ste['daily_time']=='6'){echo "selected";} ?>>6</option>
                    <option value="7" <?if ($ste['daily_time']=='7'){echo "selected";} ?>>7</option>
                    <option value="8" <?if ($ste['daily_time']=='8'){echo "selected";} ?>>8</option>
                    <option value="9" <?if ($ste['daily_time']=='9'){echo "selected";} ?>>9</option>
                    <option value="10" <?if ($ste['daily_time']=='10'){echo "selected";} ?>>10</option>
                    <option value="11" <?if ($ste['daily_time']=='11'){echo "selected";} ?>>11</option>
                    <option value="12" <?if ($ste['daily_time']=='12'){echo "selected";} ?>>12</option>
                    <option value="13" <?if ($ste['daily_time']=='13'){echo "selected";} ?>>13</option>
                    <option value="14" <?if ($ste['daily_time']=='14'){echo "selected";} ?>>14</option>
                    <option value="15" <?if ($ste['daily_time']=='15'){echo "selected";} ?>>15</option>
                    <option value="16" <?if ($ste['daily_time']=='16'){echo "selected";} ?>>16</option>
                    <option value="17" <?if ($ste['daily_time']=='17'){echo "selected";} ?>>17</option>
                    <option value="18" <?if ($ste['daily_time']=='18'){echo "selected";} ?>>18</option>
                    <option value="19" <?if ($ste['daily_time']=='19'){echo "selected";} ?>>19</option>
                    <option value="20" <?if ($ste['daily_time']=='20'){echo "selected";} ?>>20</option>
                    <option value="21" <?if ($ste['daily_time']=='21'){echo "selected";} ?>>21</option>
                    <option value="22" <?if ($ste['daily_time']=='22'){echo "selected";} ?>>22</option>
                    <option value="23" <?if ($ste['daily_time']=='23'){echo "selected";} ?>>23</option>
                    <option value="24" <?if ($ste['daily_time']=='24'){echo "selected";} ?>>24</option>
                  </select>
                  時間
                </td>
              </tr>
            </table>
          </div>
          <input type="submit" value="編集終了">
        </form>
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
    </body>
    </html>





