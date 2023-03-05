<?php
session_start();
session_regenerate_id(true);
if(empty($_SESSION['login'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理ページ</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <p>管理ページです。</p>
    <p>管理者の場合は<a href="./login.php">ログイン</a>してください。</p>
    <p>一般の方は<a href="../">トップ</a>にお戻りください。</p>
</body>
</html>
<?php
}else{
    include_once('../db.php');
    if($sqlite){
        $pdo = new PDO('sqlite:' . $database_name);
    }else{
        $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <p><a href="./logout.php">ログアウト</a></p>
    <p><a href="./passwd.php">パスワード変更</a></p>
    <p><a href="./update.php">アップデート</a></p>
    <p><a href="./service.php">サービス</a></p>
    <p><a href="./port-ban.php">ポート開放BAN</a></p>
</body>
</html>
<?php
}
$pdo = null;
