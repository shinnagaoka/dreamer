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
  <button id="addClass">Open Chat</button>
  <div  class="layout-container" style="margin: 120px;">
   <!-- Main section-->
   <main class="main-container" id="main-container">
   <!-- これで中央揃え-->
    <div class="container-fluid">
      <div class="cardbox">
      <div class="row">
        <div class="col-xl-2 col-md-2">
          <div class="d-flex mr-3"><a href="#"><img class="rounded-circle thumb48" src="img/user/06.jpg" alt="User"></a></div>
          <div class="media-body p-2">
            <p class="m-0 text-bold">Stephen Palmer</p><small class="text-muted"><em class="ion-earth text-muted mr-2"></em><span>2 hours</span></small>
          </div>
        </div>
        <div class="col-xl-10 col-md-10">
          <div class="p">ほげほげ</div>
        </div>
      </div>
        </div>
      <form class="POST" action="">
        <div class="form-group">
          <div class="input-group">
            <input class="" type="text">
            <span class="input-group-btn bl">
              <input type="submit" value="メッセージ" class="btn btn-primary">
            </span>
          </div>
          <div class="text-right"></div>
        </div>
      </form>
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