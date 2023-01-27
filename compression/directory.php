<?php
ini_set('session.cookie_lifetime', 86400);
session_name('compression');
session_start();
if(isset($_GET['index'])){
    if(isset($_SESSION['com'])){
        unset($_SESSION['com']);
        $rnd = mt_rand();
        $_SESSION['zip'] = $rnd;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>複数アップロード</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<body>
    <p>複数アップロードができます。</p>
    <p>アップロードされたファイルは暗号化されません。</p>
    <p style="color: red;">セキュリティー対策はしていません。</p>
    <p style="color: red;">使用は自己責任です。</p>
    <p style="color: red;">責任は持ちません。</p>
    <p>ZIP圧縮したい方は<a href="./directory.php?zip">こちら</a></p>
    <form action="directory.php?upload" method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="file[]" accept="text/*,image/*" required multiple>
        </div>
        <div class="line"></div>
        <input type="submit" value="アップロード" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
}
}
if(isset($_GET['upload'])){
    if(isset($_FILES["file"])){
        $str = md5(uniqid(mt_rand(), true));
        $dir = __DIR__ . '/upload/' . $str . '/';
        mkdir($dir);
        for($i = 0; $i < count($_FILES["file"]["name"]); $i++ ){
            if(is_uploaded_file($_FILES["file"]["tmp_name"][$i])){
                move_uploaded_file($_FILES["file"]["tmp_name"][$i], $dir . $_FILES["file"]["name"][$i]);
            }
        }
        $_SESSION['directory'] = $str;
        header('Location: ./directory.php?compression&targz');
        exit;
    }
}
if(isset($_GET['compression'])){
    if(isset($_GET['targz'])){
        $source = __DIR__ . '/upload/' . $_SESSION['directory'];
        $str = md5(uniqid(mt_rand(), true));
        $targzfile = __DIR__ . '/download/' . $str . '.tar.gz';
        exec("tar -zcf $targzfile $source");
        $targzfi = $str . '.tar.gz';
        $session = $_SESSION['targz'] = $targzfi;
        if(isset($session)){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>圧縮完了</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<script>
    setTimeout("redirect()", 2000);
    function redirect(){
        location.href="./directory.php?download&targz";
    }
</script>
<body>
    <p>圧縮ができました。</p>
    <p>数秒後にダウンロードされます。</p>
    <p>アップロードしたファイルをサーバーから削除する場合は下の削除ボタンを押してください。</p>
    <form action="directory.php" method="get">
        <input type="hidden" name="delete">
        <input type="hidden" name="targz">
        <input type="submit" value="サーバーから削除" style="width: 250px; height: 50px;">
    </form>
    <p>ダウンロードされない場合はダウンロードボタンを押してください。</p>
    <form action="directory.php" method="get">
        <input type="hidden" name="download">
        <input type="hidden" name="targz">
        <input type="submit" value="ダウンロード" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
}
}
}
if(isset($_GET['download'], $_GET['targz'], $_SESSION['targz'])){
    $file = './download/' . $_SESSION['targz'];
    header("Content-type: application/gzip");
    header("Content-Disposition:attachment;filename = $file");
    header('Content-Length: '.filesize("$file"));
    echo file_get_contents($file);
}
if(isset($_GET['delete'])){
    if(isset($_GET['targz'])){
        if(isset($_SESSION['targz'], $_SESSION['directory'])){
            $targzfile = $_SESSION['targz'];
            $source = $_SESSION['directory'];
            unlink(__DIR__ . '/download/' . $targzfile);
            array_map('unlink', glob(__DIR__ . '/upload/' . $source . '/*.*'));
            rmdir(__DIR__ . '/upload/' . $source);
            $_SESSION = array();
            session_destroy();
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
<body>
    <p>サーバーからファイルを削除できました。</p>
    <p>ご利用いただきありがとうございました。</p>
</body>
</html>
<?php
}else{
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>情報なし</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<body>
    <h1>ファイル情報がありません。</h1>
    <p><a href="./directory.php?delete&recovery">サーバーからファイルを見つける</a></p>
</body>
</html>
<?php
}
}
if(isset($_GET['recovery'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ファイル検索</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<body>
    <p>ファイルを削除するための情報がありません。</p>
    <p>通常、ファイル情報はセッションに保存されますがなぜか今回はセッションに情報がありませんでした。</p>
    <p>サーバーからアップロードしたファイルは削除できませんが圧縮ファイルは削除できます。</p>
    <p>サーバーから圧縮ファイルを削除する場合は以下の情報をフォームに入力してください。</p>
    <p>ファイル拡張子まで入力してください。</p>
    <form action="directory.php" method="GET">
        <input type="hidden" name="delete">
        <input type="hidden" name="recovery">
        <input type="hidden" name="result">
        <div>
            <label>
                <input type="text" name="filename">ファイル名
            </label>
        </div>
        <input type="submit" value="ファイル検索" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
if(isset($_GET['result'], $_GET['filename'])){
    if(preg_match('/_download_/', $_GET['filename'])){
        $filename = str_replace('_download_', null, $_GET['filename']);
    }else{
        $filename = $_GET['filename'];
    }
    $file = __DIR__ . '/download/' . $filename;
    $result = file_exists($file);
    if($result){
        $unlink = unlink($file);
    }else{
        $unlink = false;
    }
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
    <h1>結果</h1>
    <?php
    if($unlink){
    ?>
    <p>指定されたファイルを見つけることができたためサーバーあった圧縮ファイルを削除することに成功しました。</p>
    <p>アップロードされたファイルは削除されていませんが毎日0時に削除されます。</p>
    <?php
    }else{
    ?>
    <p>指定されたファイルは見つかりませんでした。</p>
    <p>ファイル名を再度ご確認してください。</p>
    <p>毎日0時に削除されるためその時に指定されたファイルも削除されます。</p>
    <?php
    }
    ?>
</body>
</html>
<?php
}
}
}
//---------targz---------
if(isset($_GET['zip'])){
    if(isset($_SESSION['zip'])){
        unset($_SESSION['zip']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>複数アップロード</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<style>
    .red{
        color: red;
    }
</style>
<body>
    <p>ZIPファイルに圧縮します。</p>
    <p>
    <form action="directory.php?upload=&zip=" method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="zipfile[]" accept="text/*,image/*" required multiple>
        </div>
        <div class="line"></div>
        <input type="submit" value="アップロード" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
}
if(isset($_GET['upload'], $_FILES['zipfile'])){
    $str = md5(uniqid(mt_rand(), true));
    $dir = __DIR__ . '/upload/' . $str . '/';
    mkdir($dir);
    for($i = 0; $i < count($_FILES["zipfile"]["name"]); $i++ ){
        if(is_uploaded_file($_FILES["zipfile"]["tmp_name"][$i])){
            move_uploaded_file($_FILES["zipfile"]["tmp_name"][$i], $dir . $_FILES["zipfile"]["name"][$i]);
        }
    }
    $_SESSION['director'] = $str;
    header('Location: ./directory.php?zip&compression');
    exit;
}
if(isset($_GET['compression'], $_SESSION['director'])){
    $source = 'upload/' . $_SESSION['director'];
    $str = md5(uniqid(mt_rand(), true));
    $zipfile = __DIR__ . '/download/' . $str . '.zip';
    $res = exec("zip -r $zipfile $source");
    if(isset($res)){
        $_SESSION['zipfile'] = $str;
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
        location.href="./directory.php?download&zip";
    }
</script>
<body>
    <p>圧縮ができました。</p>
    <p>数秒後にダウンロードされます。</p>
    <p>アップロードしたファイルをサーバーから削除する場合は下の削除ボタンを押してください。</p>
    <form action="directory.php" method="get">
        <input type="hidden" name="zip">
        <input type="hidden" name="delete">
        <input type="submit" value="サーバーから削除" style="width: 250px; height: 50px;">
    </form>
    <p>ダウンロードされない場合はダウンロードボタンを押してください。</p>
    <form action="directory.php" method="get">
        <input type="hidden" name="download">
        <input type="hidden" name="zip">
        <input type="submit" value="ダウンロード" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
}
}
if(isset($_GET['download'], $_SESSION['zipfile'])){
    $zfile = './download/' . $_SESSION['zipfile'] . '.zip';
    header("Content-type: application/zip");
    header("Content-Disposition:attachment;filename = $zfile");
    header('Content-Length: '.filesize("$zfile"));
    echo file_get_contents($zfile);
}
if(isset($_GET['delete'], $_SESSION['zipfile'], $_SESSION['director'])){
    $zipfile = $_SESSION['zipfile'];
    $source = $_SESSION['director'];
    unlink(__DIR__ . '/download/' . $zipfile);
    array_map('unlink', glob(__DIR__ . '/upload/' . $source . '/*.*'));
    $rm = rmdir(__DIR__ . '/upload/' . $source);
    $_SESSION = array();
    session_destroy();
    if(isset($rm)){
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
<body>
    <p>サーバーからファイルを削除することに成功しました。</p>
</body>
</html>
<?php
}
}
}
?>
