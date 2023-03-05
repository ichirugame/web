<?php
include_once('../db.php');
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])){
    //処理
    if($sqlite){
        $pdo = new PDO('sqlite:' . $database_name);
    }else{
        $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
    }
    if(isset($_POST['file_compression'])){
        //ファイル圧縮機能
        if($_POST['file_compression'] === '有効'){
            $set = '1';
        }elseif($_POST['file_compression'] === '無効'){
            $set = '0';
        }
        $sql = "UPDATE service_setting SET file_compression = $set WHERE id = 1;";
        $pdo->query($sql);
        $pdo = null;
        header('Location: ./service.php');
        exit;
    }
    if(isset($_POST['port'])){
        //ポート開放機能
        if($_POST['port'] === '有効'){
            $set = '1';
        }elseif($_POST['port'] === '無効'){
            $set = '0';
        }
        $sql = "UPDATE service_setting SET port = $set WHERE id = 1;";
        $pdo->query($sql);
        $pdo = null;
        header('Location: ./service.php');
        exit;
    }
    if(isset($_POST['memo'])){
        //メモ機能
        if($_POST['memo'] === '有効'){
            $set = '1';
        }elseif($_POST['memo'] === '無効'){
            $set = '0';
        }
        $sql = "UPDATE service_setting SET memo = $set WHERE id = 1;";
        $pdo->query($sql);
        $pdo = null;
        header('Location: ./service.php');
        exit;
    }
    $pdo = null;
}
?>
<?php
//クライアント
if(isset($_SESSION['login'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サービス設定</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <form method="post">
        <p>ファイル圧縮</p>
        <select name="file_compression" style="width: 200px;">
            <option>有効</option>
            <option>無効</option>
        </select>
        <input type="submit">
    </form>
    <form method="post">
        <p>メモ</p>
        <select name="memo" style="width: 200px;">
            <option>有効</option>
            <option>無効</option>
        </select>
        <input type="submit">
    </form>
    <form method="post">
        <p>ポート開放</p>
        <select name="port" style="width: 200px;">
            <option>有効</option>
            <option>無効</option>
        </select>
        <input type="submit">
    </form>
    <p><a href="./">戻る</a></p>
</body>
</html>
<?php
}
$pdo = null;
