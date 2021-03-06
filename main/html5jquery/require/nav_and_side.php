<!--  <?php require('../require/nav_and_side.html'); ?>   -->


    <!-- top navbar-->
    <header class="header-container">
      <nav>
        <ul class="hidden-lg-up">
          <li><a class="sidebar-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
        </ul>
        <ul class="hidden-xs-down">
          <li><a class="covermode-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
        </ul>
        <h2 class="header-title"></h2>
        <ul class="float-right">
          <li><a id="header-search" href="#"><em class="ion-ios-search-strong"></em></a></li>
          <li><a id="header-settings" href="#"><em class="ion-more"></em></a></li>
          <li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><em class="ion-ios-keypad"></em></a>
          </li>
          <li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><img class="header-user-image" src="img/user/masaki.jpg" alt="header-user-image"><!-- <sup class="badge bg-danger">3</sup> --></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-scale">
              <h6 class="dropdown-header">ユーザーメニュー</h6><a class="dropdown-item" href="#"><!-- <span class="float-right badge badge-primary">4</span> --><em class="ion-ios-email-outline icon-lg text-primary"></em>マイページ</a><a class="dropdown-item" href="#"><em class="ion-ios-gear-outline icon-lg text-primary"></em>編集</a>
              <div class="dropdown-divider" role="presentation"></div><a class="dropdown-item" href="user.login.html"><em class="ion-log-out icon-lg text-primary"></em>ログアウト</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <!-- sidebar-->
    <aside class="sidebar-container">
      <div class="brand-header">
        <div class="float-left pt-4 text-muted sidebar-close"><em class="ion-arrow-left-c icon-lg"></em></div><a class="brand-header-logo" href="#">
                <!-- Logo Imageimg(src="img/logo.png", alt="logo")
              --><span class="brand-header-logo-text">Dreamer</span></a>
            </div>
            <div class="sidebar-content">
              <div class="sidebar-toolbar">
                <div class="sidebar-toolbar-background"></div>
                <div class="sidebar-toolbar-content text-center"><a href="#"><img class="rounded-circle thumb64" src="img/user/masaki.jpg" alt="Profile"></a>
                  <div class="mt-3">
                    <div class="lead">田寺まさき</div>
                    <div class="text-thin">北海道</div>
                  </div>
                </div>
              </div>
              <nav class="sidebar-nav">
                <ul>
                  <li>
                    <div class="sidebar-nav-heading">マイページ</div>
                  </li>
                  <li><a href="dashboard.html"><span class="float-right nav-label"></span><span class="nav-icon">
                    <em class="ion-ios-speedometer-outline"></em></span><span>進行中の夢</span></a>
                  </li>
                  <li><a href="#"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-settings"></em></span><span>達成された夢</span></a>
                    <ul class="sidebar-subnav" id="elements">
                      <li><a href="buttons.html"><span class="float-right nav-label"></span><span>No.1</span></a></li>
                      <li><a href="bootstrapui.html"><span class="float-right nav-label"></span><span>No.2</span></a></li>
                    </ul>
                  </li>
                  <li><a href="dashboard.html"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-gear-outline"></em></span><span>編集</span></a>
                  </li>
                  <li>
                    <div class="sidebar-nav-heading">閲覧</div>
                  </li>
                  <li><a href="#"><span class="float-right nav-caret"><em class="ion-ios-arrow-right"></em></span><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-list-outline"></em></span><span>カテゴリー別</span></a>
                  <ul class="sidebar-subnav" id="tables">
                      <li><a href="category.php #work"><span class="float-right nav-label"></span><span>職業</span></a></li>
                      <li><a href="category.php #relate"><span class="float-right nav-label"></span><span>人間関係</span></a></li>
                      <li><a href="category.php #helth"><span class="float-right nav-label"></span><span>健康</span></a></li>
                      <li><a href="category.php #study"><span class="float-right nav-label"></span><span>勉強</span></a></li>
                      <li><a href="category.php #money"><span class="float-right nav-label"></span><span>お金</span></a></li>
                      <li><a href="category.php #other"><span class="float-right nav-label"></span><span>その他</span></a></li>
                    </ul>
                  </li>
                  <li><a href="dashboard.html"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-settings"></em></span><span>応援している夢</span></a></li>
                  <li><a href="dashboard.html"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-speedometer-outline"></em></span><span>履歴</span></a></li>
                </ul>
              </nav>
            </div>
          </aside>
          <div class="sidebar-layout-obfuscator"></div>