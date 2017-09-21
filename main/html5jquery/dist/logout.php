<?php
// ログアウトの仕組み
// セッション情報を完全に破棄する
// なぜなら、timeline.phpはセッションにidが存在するかどうかでログインしているかどうかを判定しているため
session_start();

$_SESSION = array();

 setcookie('login_user_id', '', time() + 42000
    );
    setcookie('email', '', time() + 42000
    );
    setcookie('password', '', time() + 42000
    );
    setcookie('auto_login', '', time() + 42000
    );
session_destroy();



header('Location: signin.php');
exit();

?>