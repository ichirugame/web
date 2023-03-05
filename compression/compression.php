<?php
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
if($result['file_compression']){
if(isset($_GET['zipfile'])){
if($_POST && is_uploaded_file($_FILES['zip']['tmp_name'])){
    //ファイル圧縮
    $source = $_FILES['zip']['tmp_name'];
    $filename = $_FILES['zip']['name'];
    $str = md5(uniqid(mt_rand(), true));
    $zipfile = __DIR__ . '/download/' . $str . '.zip';
    if(isset($_POST['passwd'])){
        $password = uniqid(mt_rand(), true);
        exec("zip -P $password $zipfile $source");
        $zip = true;
    }elseif(empty($_POST['passwd'])){
    $zip = new ZipArchive;
    $zip->open($zipfile, ZipArchive::CREATE);
    $zip->addFile($source, $filename);
    $zip->close();
    }
    if($zip){
        $zipf = $str . '.zip';
        $time = time() + 86400;
        $domain = $_SERVER['SERVER_NAME'];
        setcookie('zip', $zipf, $time, $domain);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>完了</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<script>
    setTimeout("redirect()", 2000);
    function redirect(){
        location.href="./compression.php?zipfile&download";
    }
</script>
<body>
    <p>ZIP圧縮が完了しました。</p>
    <p>サーバーからZIPを削除できるのは24時間以内です。</p>
    <?php
    if(isset($_POST['passwd'])){
        echo 'ZIPパスワードは', $password, '<br>', 'ZIPパスワードは忘れないでください。';
    }
    ?>
    <p>それ以降は24時間以降に削除されます。</p>
    <form action="./compression.php" method="GET">
        <input type="hidden" name="zipfile">
        <input type="hidden" name="delete">
        <input type="submit" value="サーバーからZIPを削除" style="width: 250px; height: 50px;">
    </form>
    <p>ダウンロードされませんか？</p>
    <p>されない場合は下のボタンをクリックしてください。</p>
    <form action="./compression.php" method="GET">
        <input type="hidden" name="zipfile">
        <input type="hidden" name="download">
        <input type="submit" value="ダウンロード" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
}
}
if(isset($_GET['download'])){
    if(isset($_COOKIE['zip'])){
        //ZIPダウンロード
        $zip_file = $_COOKIE['zip'];
        $zip = './download/' . $zip_file;
        header("Content-type: application/zip");
        header("Content-Disposition:attachment;filename = $zip");
        header('Content-Length: '.filesize("$zip"));
        echo file_get_contents($zip);
    }elseif(empty($_COOKIE['zip'])){
        echo 'セットされていません。';
    }
}
if(isset($_POST['zipname'])){
    //ZIP削除
    $zipname = $_POST['zipname'] . '.zip';
    $zipfile = __DIR__ . '/download/' . $zipname;
    if(file_exists($zipfile)){
        $delete = $zipname . 'を削除することに成功しました。';
        $Error = null;
        unlink($zipfile);
    }else{
        $delete = $zipname . 'を削除することに失敗しました。';
        $Error = 'そのようなファイルはありません。';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>完了</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <p>サーバーから<?php echo $delete; ?></p>
    <p>
        <?php
        echo $Error;
        ?>
    </p>
    <p>ご利用いただきありがとうございました。</p>
    <p><a href="../">トップに戻る</a></p>
</body>
</html>
<?php
}
//-----ZIP-----
}elseif(isset($_GET['targzfile'])){
    if($_POST && is_uploaded_file($_FILES['targz']['tmp_name'])){
        //圧縮
        $source = $_FILES['targz']['tmp_name'];
        $filename = $_FILES['targz']['name'];
        $str = md5(uniqid(mt_rand(), true));
        $targzfile = __DIR__ . '/download/' . $str . '.tar.gz';
        exec("tar -zcf $targzfile $source");
        $targzfi = $str . '.tar.gz';
        $time = time() + 86400;
        $domain = $_SERVER['SERVER_NAME'];
        setcookie('targz', $targzfi, $time, $domain);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>圧縮完了</title>
</head>
<script>
    setTimeout("redirect()", 2000);
    function redirect(){
        location.href="./compression.php?targzfile&download";
    }
</script>
<body>
    <p>targz圧縮が完了しました。</p>
    <p>サーバーからZIPを削除できるのは24時間以内です。</p>
    <p>それ以降は24時間以降に削除されます。</p>
    <form action="./compression.php" method="GET">
        <input type="hidden" name="delete">
        <input type="submit" value="サーバーからZIPを削除" style="width: 250px; height: 50px;">
    </form>
    <p>ダウンロードされませんか？</p>
    <p>されない場合は下のボタンをクリックしてください。</p>
    <form action="./compression.php" method="GET">
        <input type="hidden" name="targzfile">
        <input type="hidden" name="download">
        <input type="submit" value="ダウンロード" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
}
if(isset($_GET['download'])){
    if(isset($_COOKIE['targz'])){
        //圧縮ダウンロード
        $targzfile = './download/' . $_COOKIE['targz'];
        header("Content-type: application/gzip");
        header("Content-Disposition:attachment;filename = $targzfile");
        header('Content-Length: '.filesize("$targzfile"));
        echo file_get_contents($targzfile);
    }
}
//---tar.gz-----
}
if(isset($_GET['delete'])){
    if(isset($_COOKIE['zip'])){
        //圧縮削除
        $zipf = $_COOKIE['zip'];
        $zipfile = __DIR__ . '/download/' . $zipf;
        unlink($zipfile);
        setcookie('zip', null, time() - 30);
    }elseif(isset($_COOKIE['targz'])){
        $targz = __DIR__ . '/download/' . $_COOKIE['targz'];
        unlink($targz);
        setcookie('targz', null, time() - 30);
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除完了</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<body>
    <?php
    if(isset($_COOKIE['zip'])){
    ?>
    <p>サーバーからZIPファイルを削除しました。</p>
    <p><a href="../">トップに戻る</a></p>
    <?php
    }elseif(isset($_COOKIE['targz'])){
    ?>
    <p>サーバーからtargzファイルを削除しました。</p>
    <p><a href="../">トップに戻る</a></p>
    <?php
    }else{
    ?>
    <p>必要な情報を取得できませんでした。</p>
    <p>サーバーから圧縮ファイルを削除するには以下のフォームにファイル名を入れて送信してください。</p>
    <p>ファイル拡張子まで入れてください。</p>
    <form action="compression.php?forgot" method="post">
        <div>
            <input type="text" name="filename">
        </div>
        <input type="submit" value="ファイルを検索する" style="width: 250px; height: 50px;">
    </form>
    <?php
    }
    ?>
</body>
</html>
<?php
}
if(isset($_GET['forgot'])){
    if(preg_match('/_download_/', $_POST['filename'])){
        $filename = str_replace('_download_', null, $_POST['filename']);
    }else{
        $filename = $_POST['filename'];
    }
    $file = __DIR__ . '/download/' . $filename;
    $result = file_exists($file);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>結果</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<body>
    <?php
    if($result){
        unlink($file);
    ?>
    <p>指定されたファイルを発見したため削除しました。</p>
    <p>ご利用いただきありがとうございました。</p>
    <?php
    }else{
    ?>
    <p>指定されたファイルはありませんでした。</p>
    <p>ファイル名を間違えている可能性があります。</p>
    <?php
    }
    ?>
</body>
</html>
<?php
}
}else{
    include_once('../error/ban.html');
}
