<header class="header-container">
      <nav >
            <!--         <ul class="hidden-lg-up">
          <li><a class="sidebar-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
        </ul>
        <ul class="hidden-xs-down">
          <li><a class="covermode-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
        </ul> -->
        <h2 class="header-title"></h2>
        <ul class="float-right">
          <li><a id="header-search" href="#"><em class="ion-ios-search-strong"></em></a></li>
          <li><a id="header-settings" href="#"><em class="ion-paintbrush"></em></a></li>
          <li><a href="view_c_page.php"><em class="ion-ios-paper"></em> dreams</a>
          </li>
          <li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><img class="header-user-image" src="img/user/<?php echo $read_login_users['profile_image_path']; ?>" alt="header-user-image"><!-- <sup class="badge bg-danger">3</sup> --></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-scale">
              <h6 class="dropdown-header">ユーザーメニュー</h6><a class="dropdown-item" href="dashboard.php"><!-- <span class="float-right badge badge-primary">4</span> --><em class="ion-android-person icon-lg text-primary"></em>マイページ</a>
              <div class="dropdown-divider" role="presentation"></div><a class="dropdown-item" href="signup_edit.php"><em class="ion-ios-gear-outline icon-lg text-primary"></em>アカウント編集</a>
              <a class="dropdown-item" href="#"><em class="ion-ios-gear-outline icon-lg text-primary"></em>夢編集</a>
              <a class="dropdown-item" href="#"><em class="ion-ios-gear-outline icon-lg text-primary"></em>ショートステップ編集</a>
              <div class="dropdown-divider" role="presentation"></div><a class="dropdown-item" href="logout.php"><em class="ion-log-out icon-lg text-primary"></em>ログアウト</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>