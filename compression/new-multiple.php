<?php
/*
スパゲッティーコード化していたので再度書き直した。
ZIPのみ対応しています。
tar.gzは入れません。
multiple.phpより機能は少ないです。
・ファイル検索
・tar.gzに圧縮
はありません.
*/
session_name('compression');
session_start();
session_regenerate_id(true);
include_once('../db.php');
if($sqlite){
    $pdo = new PDO('sqlite:' . $database_name);
}else{
    $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
}
$sql = "SELECT file_compression FROM service_setting WHERE id = 1;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$pdo = null;
$stmt = null;
$sql = null;
if(!$result['file_compression']){
    include_once('../error/ban.html');
    exit;
}
$result = null;
if(isset($_GET['upload'], $_FILES["file"])){
    //アップロード.
    unset($_SESSION['com']);
    $str = md5(uniqid(mt_rand(), true));
    $dir = __DIR__ . '/upload/' . $str . '/';
    mkdir($dir);
    for($i = 0; $i < count($_FILES["file"]["name"]); $i++ ){
        if(is_uploaded_file($_FILES["file"]["tmp_name"][$i])){
            move_uploaded_file($_FILES["file"]["tmp_name"][$i], $dir . $_FILES["file"]["name"][$i]);
        }
    }
    $_SESSION['directory'] = $str;
    header('Location: ./new-multiple.php?compression');
    exit;
}
if(isset($_GET['compression'], $_SESSION['directory'])){
    //ZIPに圧縮.
    $source = 'upload/' . $_SESSION['directory'];
    $str = md5(uniqid(mt_rand(), true));
    $zipfile = __DIR__ . '/download/' . $str . '.zip';
    $res = exec("zip -r $zipfile $source");
    $_SESSION['zipfile'] = $str;
    header('Location: ./new-multiple.php?completion');
    exit;
}
if(isset($_GET['download'], $_SESSION['zipfile'])){
    //ダウンロード.
    $file = './download/' . $_SESSION['zipfile'] . '.zip';
    header("Content-type: application/zip");
    header("Content-Disposition:attachment;filename = $file");
    header('Content-Length: '.filesize("$file"));
    echo file_get_contents($file);
}
if(isset($_GET['delete'], $_SESSION['zipfile'], $_SESSION['directory'])){
    //ファイル削除.
    $zipfile = $_SESSION['zipfile'];
    $source = $_SESSION['directory'];
    unlink(__DIR__.'/download/'.$zipfile.'.zip');
    array_map('unlink', glob(__DIR__ . '/upload/' . $source . '/*.*'));
    $rm = rmdir(__DIR__ . '/upload/' . $source);
    $_SESSION = array();
    session_destroy();
    setcookie('compression', null, -3600);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>複数ZIP圧縮</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<?php
if(isset($_GET['completion'])){
?>
<script>
    setTimeout("redirect()", 2000);
    function redirect(){
        location.href="?download";
    }
</script>
<?php
}
?>
<body>
    <?php
    if(isset($_SESSION['com'])){
    ?>
    <p>複数アップロードができます。</p>
    <p>アップロードされたファイルは暗号化されません。</p>
    <p>multiple.phpよりも機能は少ないですがユーザー入力部分が少ないです。</p>
    <p style="color: red;">セキュリティー対策はしていません。</p>
    <p style="color: red;">使用は自己責任です。</p>
    <p style="color: red;">責任は持ちません。</p>
    <form action="new-multiple.php?upload" method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="file[]" accept="text/*,image/*" required multiple>
        </div>
        <div class="line"></div>
        <input type="submit" value="アップロード" style="width: 250px; height: 50px;">
    </form>
    <?php
    }
    if(isset($_GET['completion'])){
    ?>
    <p>圧縮ができました。</p>
    <p>ダウンロードされない場合はダウンロードボタンを押してください。</p>
    <form action="new-multiple.php" method="get">
        <input type="hidden" name="download">
        <input type="submit" value="ダウンロード" style="width: 250px; height: 50px;">
    </form>
    <p>アップロードしたファイルをサーバーから削除する場合は下の削除ボタンを押してください。</p>
    <form action="new-multiple.php" method="get">
        <input type="hidden" name="delete">
        <input type="submit" value="削除" style="width: 250px; height: 50px;">
    </form>
    <?php
    }
    if(isset($rm)){
    ?>
    <p>削除できました。</p>
    <p>ご利用いただきありがとうございました。</p>
    <p><a href="../">トップに戻る</a></p>
    <?php
    }
    ?>
</body>
</html>
