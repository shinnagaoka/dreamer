<?php
session_start();
require('dbconnect.php');

// バリデーション

//変数・配列の初期化
$dream_contents='';
$category='';
$tag='';
$d_schedule='';
$step_contents='';
$s_schedule='';
$way='';
$daily_goal_contents='';
$daily_time='';
$dream_image_path='';
$errors = array();


//var_dump($_POST);


if (!empty($_POST)) {
  //echo 'POST送信'.'<br>';

//変数作成
  $dream_contents=$_POST['dream_contents'];
  $category=$_POST['category'];
  $tag=$_POST['tag'];
  $d_schedule=$_POST['d_schedule'];
  $step_contents=$_POST['step_contents'];
  $s_schedule=$_POST['s_schedule'];
  $way=$_POST['way'];
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
   if ($tag =='') {
    $errors['tag'] = 'blank';}
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
      if ($way =='') {
       $errors['way'] = 'blank';
     }
     if ($daily_goal_contents =='') {
      $errors['daily_goal_contents'] = 'blank';}
  //   elseif (mb_strlen($daily_goal_contents)>21) {
  //   $errors['daily_goal_contents'] = 'length';
  // }

      $fileName = $_FILES['dream_image_path']['name'];
      echo'選択ファイル名'.$fileName.'<br>';
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
      echo'夢画像名'.$upload_image_name.'<br>';
      move_uploaded_file($_FILES['dream_image_path']['tmp_name'],'dream_image/'.$upload_image_name);


      $_SESSION['dream_info']['dream_contents'] = $dream_contents;
      $_SESSION['dream_info']['category'] = $category;
      $_SESSION['dream_info']['tag'] = $tag;
      $_SESSION['dream_info']['d_schedule'] = $d_schedule;
      $_SESSION['dream_info']['step_contents'] = $step_contents;
      $_SESSION['dream_info']['s_schedule'] = $s_schedule;
      $_SESSION['dream_info']['way'] = $way;
      $_SESSION['dream_info']['daily_goal_contents'] = $daily_goal_contents;
      $_SESSION['dream_info']['daily_time'] = $daily_time;
      $_SESSION['dream_info']['dream_image_path'] = $upload_image_name;
      header('Location: register_check.php');
    exit(); //POST送信破棄。
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

  <!-- ⑤小ステップ追加削除JavaScript -->
  <style>
    #txt{font-size: 10pt; width:200}
    #ymd{font-size: 10pt; width:60}
    td    {font-size: 10pt;}
    #num {width: 100px};
  </style>
  <script language="JavaScript">
    <!--
    var i = 1;
    var maxrows = 10;
    function hage() {
      i++;
        // Tbody への参照を取得します
        var mybody=document.getElementById("histTablebody");
        // セルを生成します
                // -------

                // タグ名が TR である要素を生成します
                mycurrent_row=document.createElement("TR");
                mycurrent_row.setAttribute("id","histrow"+i);
                // タグ名が TD である要素を生成します
                mycurrent_cell=document.createElement("TD");
                mycurrent_cell.setAttribute("id","num");

                // -------
                // テキストノードを生成します。
                currenttext=document.createTextNode(i);
                // 生成したテキストノードを TD セルへと付加します
                mycurrent_cell.appendChild(currenttext);
                // その TD セルを TR 行へと付加します
                mycurrent_row.appendChild(mycurrent_cell);
                // -------
                // タグ名が TD である要素を生成します
                mycurrent_cell=document.createElement("TD");
                // テキストノードを生成します。
                currenttext=document.createTextNode("小ステップ");
                // 生成したテキストノードを TD セルへと付加します
                mycurrent_cell.appendChild(currenttext);
                // その TD セルを TR 行へと付加します
                mycurrent_row.appendChild(mycurrent_cell);

                // -------
                // タグ名が TD である要素を生成します
                mycurrent_cell=document.createElement("TD");
                // フォームノードを生成します
                mycurrent_form=document.createElement("INPUT");
                mycurrent_form.setAttribute("type","TEXT");
                mycurrent_form.setAttribute("name","step_contents" + i);
                mycurrent_form.setAttribute("value","");
                mycurrent_form.setAttribute("id", "txt");
                // 生成したフォームノードを TD セルへと付加します
                mycurrent_cell.appendChild(mycurrent_form);
                // その TD セルを TR 行へと付加します
                mycurrent_row.appendChild(mycurrent_cell);
                // その TR 行を TBODY へと付加します
                // mybody.appendChild(mycurrent_row);

                // -------
                // タグ名が TD である要素を生成します
                mycurrent_cell=document.createElement("TD");
                // テキストノードを生成します。
                currenttext=document.createTextNode("期限");
                // 生成したテキストノードを TD セルへと付加します
                mycurrent_cell.appendChild(currenttext);
            // その TD セルを TR 行へと付加します
            mycurrent_row.appendChild(mycurrent_cell);
                // -------
                // タグ名が TD である要素を生成します
                mycurrent_cell=document.createElement("TD");
                // フォームノードを生成します
                mycurrent_form=document.createElement("SELECT");
                mycurrent_form.setAttribute("type","TEXT");
                mycurrent_form.setAttribute("name","year_step" + i);
                mycurrent_form.setAttribute("value","<?php echo $year_step; ?>");
                mycurrent_form.setAttribute("id", "ymd");
                // 生成したフォームノードを TD セルへと付加します
                mycurrent_cell.appendChild(mycurrent_form);
                // テキストノードを生成します。
                currenttext=document.createTextNode("年");
                // 生成したテキストノードを TD セルへと付加します
                mycurrent_cell.appendChild(currenttext);
                // フォームノードを生成します
                mycurrent_form=document.createElement("SELECT");
                mycurrent_form.setAttribute("type","TEXT");
                mycurrent_form.setAttribute("name","month_achieve" + i);
                mycurrent_form.setAttribute("value","<?php echo $month_step; ?>");
                mycurrent_form.setAttribute("id", "ymd");
                // 生成したフォームノードを TD セルへと付加します
                mycurrent_cell.appendChild(mycurrent_form);
                // テキストノードを生成します。
                currenttext=document.createTextNode("月");
                // 生成したテキストノードを TD セルへと付加します
                mycurrent_cell.appendChild(currenttext);
                // その TD セルを TR 行へと付加します
                mycurrent_row.appendChild(mycurrent_cell);


                mycurrent_form=document.createElement("SELECT");
                mycurrent_form.setAttribute("type","TEXT");
                mycurrent_form.setAttribute("name","day_achieve" + i);
                mycurrent_form.setAttribute("value","<?php echo $day_step; ?>");
                mycurrent_form.setAttribute("id", "ymd");
                // 生成したフォームノードを TD セルへと付加します
                mycurrent_cell.appendChild(mycurrent_form);
                // テキストノードを生成します。
                currenttext=document.createTextNode("日");
                // 生成したテキストノードを TD セルへと付加します
                mycurrent_cell.appendChild(currenttext);
                // その TD セルを TR 行へと付加します
                mycurrent_row.appendChild(mycurrent_cell);
                // その TR 行を TBODY へと付加します
                mybody.appendChild(mycurrent_row);
             // 削除ボタンを有効にする
             document.hogehoge.delrow.disabled=false;
        // テーブルの数（行の数）がmaxrows以上の場合は
        // 追加ボタンを無効にする
        if(i>=maxrows){
          document.hogehoge.addrow.disabled=true;
        }
      }
      var hige =    function() {
        var mytable=document.getElementById("histTablebody");
        var removeTable=document.getElementById("histrow"+i);
        mytable.removeChild(removeTable);
        i--;
        // テーブルの数（行の数）が0の場合は
        // 削除ボタンを無効にする
        if(i==1){
          document.hogehoge.delrow.disabled=true;
        }
        // 追加ボタンを有効にする
        document.hogehoge.addrow.disabled=false;
      }
      var result =    function() {
        alert('あなたの履歴は'+i+'件です。');
      }
//-->
</script>

</head>

<body class="theme-default" onload="document.hogehoge.delrow.disabled=true;">
  <form method="POST" action="" enctype="multipart/form-data">
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
                    <input type="radio" name="category" value="1" checked>１・仕事<br>
                    <input type="radio" name="category" value="2">２・人間関係<br>
                    <input type="radio" name="category" value="3">３・健康<br>
                    <input type="radio" name="category" value="4">４・勉強<br>
                    <input type="radio" name="category" value="5">５・お金<br>
                    <input type="radio" name="category" value="6">６・その他<br>
                  </div>
                  <br>
                  <br>



                  <div class="container-fluid">
                   <h4 style="color: #42a5f5;">③タグを入力してください。</h4>
                 </div>
                 <div class="container-fluid">
                  <input class="form-control" type="text" name="tag" placeholder="(例) 起業" value="<?php echo $tag; ?>">
                  <?php if(isset($errors['tag'])){?>
                  <div class="alert alert-danger">タグが未入力です。</div>
                  <?php  }?>
                </div>
                <br>
                <br>




                <div class="container-fluid">
                  <h4 style="color: #42a5f5;">④達成期限を設定してください。</h4>
                </div>
                <div class="container-fluid">
                  <input type="date" name="d_schedule">
                </div>
                <br>
                <br>


                <div class="container-fluid">
                 <h4 style="color: #42a5f5;">⑤目標達成の為の小ステップを作成しましょう。</h4>
               </div>
               <form name="hogehoge">
                <div id="hist">
                  <table border="1">
                    <tbody  id="histTablebody">
                      <tr id="histrow1">
                        <td id="num">1</td>
                        <td bgcolor="#b3e5fc" >小ステップ</td>
                        <td>
                          <input type="text" name="step_contents" placeholder="(例) 資格取得する" id="txt" value="<?php echo $step_contents; ?>">
                          <?php if(isset($errors['step_contents'])){?>
                          <div class="alert alert-danger">小ステップが未入力です。</div>
                          <?php  }?>
                        </td>
                        <td bgcolor="#b3e5fc">期限</td>
                        <td>
                          <input type="date" name="s_schedule">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <table>
                  <tr>
                    <td>
                      <input type="button" id=addrow value="ステップを追加"
                      onClick="hage();">
                    </td>
                    <td>
                      <input type="button" id=delrow value="ステップを削除"
                      onClick="hige();" disabled="true">
                    </td>
                    <td>
                      <input type="button" value="登録" onClick="result()">
                    </td>
                  </tr>
                </table>
              </form>
              <br>
              <br>



              <div class="container-fluid">
                <h4 style="color: #42a5f5;">⑥AかB、毎日の自己評価方法を選んでください。</h4>
              </div>
              <div class="container-fluid">
                <input type="radio" name="way" value="time_system"<?php echo ($way == "A・時間制"); ?> checked>A・時間制<br>
                <input type="radio" name="way" value="yes_no_system"<?php echo ($way == "B・達成したか否か「YES」「NO」二択"); ?>>B・達成したか否か「YES」「NO」二択<br>
              </div>
              <br>
              <br>



              <div class="alt-table-responsive">
                <table border="1" width=100% cellspacing="0" cellpadding="7">
                  <tr>
                    <th bgcolor="#b3e5fc">毎日の課題</th>
                    <th bgcolor="#b3e5fc">時間（Aを選択した時のみ）</th>
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
                      <option value="00">00</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                    </select>
                    時間
                  </td>
                </tr>
              </table>
            </div>
            <br>
            <br>



            <div class="container-fluid">
              <h4 style="color: #42a5f5;">⑦夢のイメージ画像をアップしてください。</h4>
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


            <div class="container-fluid">
              <button class="btn btn-lg btn-gradient btn-oval btn-info btn-block" type="submit">夢登録チェックへ</button>
            </div>
          </div>
        </div>
      </div>
    </form>






    <!-- フッター削除 -->

    <!-- Search template-->
    <div class="modal modal-top fade modal-search" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="modal-search-form">
              <form action="#">
                <div class="input-group">
                  <div class="input-group-btn">
                    <button class="btn btn-flat" type="button" data-dismiss="modal"><em class="ion-arrow-left-c icon-lg text-muted"></em></button>
                  </div>
                  <input class="form-control header-input-search" type="text" placeholder="Search..">
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
          </div>
        </div>
      </div>
    </div>
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
<!-- App script-->
<script src="js/app.js"></script>
</div>
</div>
</body>
</html>