    <?php
    $rd = $read_login_users['now_dream_id'];
    require('../require/read_dream.php');
    ?>
    <aside class="sidebar-container">
      <div class="brand-header">
        <div class="float-left pt-4 text-muted sidebar-close"><em class="ion-arrow-left-c icon-lg"></em></div><a class="brand-header-logo" href="#">
          <!-- Logo Imageimg(src="img/logo.png", alt="logo") -->
          <span class="brand-header-logo-text"><img src="img/Dreamer.png"></span></a>
      </div>
      <div class="sidebar-content">
        <div class="sidebar-toolbar">
          <div class="sidebar-toolbar-background"><img src="dream_image/<?php echo $read_dream['dream_image_path'];?>" style="height: 160px;width: 240px"></div>
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
                  <li><a href="edit.php"><span class="float-right nav-label"></span><span>夢編集</span></a></li>

                  <li><a href="edit_step_add.php"><span class="float-right nav-label"></span><span>ステップ追加</span></a></li>
                  <li><a href="edit_step.php"><span class="float-right nav-label"></span><span>ステップ編集・削除</span></a></li>

                  <li><a href="edit_step.php"><span class="float-right nav-label"></span><span>ショートステップ編集</span></a></li>

              </ul>
              <div class="sidebar-nav-heading">閲覧</div>
            </li>
              <li><a href="view_c_page.php"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-paper"></em></span><span>カテゴリー別</span></a>
                <ul class="sidebar-subnav" id="tables">
                  <li><a href="view_c_page.php"><span class="float-right nav-label"></span><span>カテゴリー別</span></a></li>


                  <li><a href="view_c_page.php#1"><span class="float-right nav-label"></span><span>仕事</span></a></li>
                  <li><a href="view_c_page.php#2"><span class="float-right nav-label"></span><span>人間関係</span></a></li>
                  <li><a href="view_c_page.php#3"><span class="float-right nav-label"></span><span>健康</span></a></li>
                  <li><a href="view_c_page.php#4"><span class="float-right nav-label"></span><span>勉強</span></a></li>
                  <li><a href="view_c_page.php#5"><span class="float-right nav-label"></span><span>お金</span></a></li>
                  <li><a href="view_c_page.php#6"><span class="float-right nav-label"></span><span>その他</span></a></li>

                </ul>
              </li>

              <li><a href="view_c_n_page.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-heart"></em></span><span>応援している夢</span></a></li>
              <li><a href="view_h_page.php"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-rewind"></em></span><span>履歴</span></a></li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="sidebar-layout-obfuscator"></div>