<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="Bootstrap Admin Template">
  <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
  <title>チャット</title>
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
<body class="theme-default">
  <div  class="layout-container" style="margin: 120px;">

   <!-- Main section-->
   <main class="main-container"> <!-- これで中央揃え-->
    <h1 style="color: #01579b;">チャット</h1><br>

    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3 col-md-4">

          <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333; border-radius: 30px; background-color: #b3e5fc;">
            <div class="mb-3"><img class="wd-sm rounded-circle img-thumbnail" src="img/user/04.jpg" alt="user"></div>
            <h4 style="color: #ffffff;">名前：</h4>
            <h5>花子</h5>
            <h4 style="color: #ffffff;">夢：</h4>
            <h5>資格を取得します。</h5>
          </div>

        </div>
      </div>

      ログイン<br>
      ログアウト<br>
      <div class="col-xl-6 col-md-8">
        <div>
          <div>
            <form class="mt-3" action="">
              <div class="form-group">
                <div class="input-group">

                  <div class="media m-0">
                    <div class="d-flex mr-3"><a href="#"><img class="rounded-circle thumb48" src="img/user/05.jpg" alt="User"></a></div>
                    <div class="media-body p-2">
                      <p class="m-0 text-bold">Ricky Wagner</p>
                    </div>
                  </div>

                  <input class="form-control fw" type="text"><span class="input-group-btn bl">



                  <input type="submit" value="メッセージ" class="btn btn-primary">
                </span>
              </div>
              <div class="text-right"></div>
            </div>
          </form>
          <br>
          <br>
        </div>
      </div>

      <div>
        <div class="media m-0">
          <div class="d-flex mr-3"><a href="#"><img class="rounded-circle thumb48" src="img/user/06.jpg" alt="User"></a></div>
          <div class="media-body p-2">
            <p class="m-0 text-bold">Stephen Palmer</p><small class="text-muted"><em class="ion-earth text-muted mr-2"></em><span>2 hours</span></small>
          </div>
        </div>
        <div class="p">ほげほげ</div>
      </div>

      <div>
        <div class="media m-0">
          <div class="d-flex mr-3"><a href="#"><img class="rounded-circle thumb48" src="img/user/05.jpg" alt="User"></a></div>
          <div class="media-body p-2">
            <p class="m-0 text-bold">Ricky Wagner</p><small class="text-muted"><em class="ion-earth text-muted mr-2"></em><span>10 hours</span></small>
          </div>
        </div>
        <div class="p">ほげほげ</div>
      </div>

      <div>
        <div>
          <div class="media m-0">
            <div class="d-flex mr-3"><a href="#"><img class="rounded-circle thumb48" src="img/user/06.jpg" alt="User"></a></div>
            <div class="media-body p-2">
              <p class="m-0 text-bold">Stephen Palmer</p><small class="text-muted"><em class="ion-earth text-muted mr-2"></em><span>Yesterday</span></small>
            </div>
          </div>
          <div class="p">
            <div class="mb-3">ほげほげ</div>
          </div>
        </div>
      </div>

      <!-- Page footer-->
      <br>
      <br>
      <br>
      <footer>
        <div class="d-flex justify-content-between fh">
          <a class="footer-icon footer-icon-lg" href="#"><em class="ion-home"></em><span>マイページ</span></a></div>
        </footer>
        <!-- Search template削除-->
        <!-- Settings template削除-->
      </div>
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
  </body>
  </html>