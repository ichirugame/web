<?php
session_name('compression');
session_start();
$token = isset($_POST["token"]) ? $_POST["token"] : "";
$session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";
unset($_SESSION["token"]);
if($token != "" && $token == $session_token){
    $date = mt_rand();
    $_SESSION['com'] = $date;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>指定</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<style>
    .line{
        margin: 30px;
    }
</style>
<body>
    <div style="margin: 130px;"></div>
    <h1>ZIP、tar.gzのどちらかを指定してください。</h1>
    <div style="margin: 30px;"></div>
    <form action="upload.php?zip" method="POST" enctype="multipart/form-data">
        <input type="submit" value="ZIPに圧縮にする" style="width: 250px; height: 50px;">
    </form>
    <div class="line"></div>
    <form action="upload.php?targz" method="POST" enctype="multipart/form-data">
        <input type="submit" value="tar.gzに圧縮にする" style="width: 250px; height: 50px;">
    </form>
    <div class="line"></div>
    <form action="directory.php" method="GET">
        <input type="hidden" name="index">
        <input type="submit" value="複数アップロード" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
}
//----------------------------------------------------------------
if(isset($_GET['zip'])){
    if(isset($_SESSION['com'])){
        unset($_SESSION["com"]);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIP圧縮</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<style>
    .lin{
        margin: 30px;
    }
</style>
<body>
    <h1>ZIP圧縮</h1>
    <h1 style="font-size: 30px;">ファイルをZIP圧縮します。</h1>
    <p style="font-size: 25px;">最大アップロードサイズは10MBです。</p>
    <p style="font-size: 25px;">アップロードできるのはテキストファイル、画像ファイルのみです。</p>
    <p style="font-size: 25px">パスワード付きZIPはアップロードされたファイル名は変更されます。</p>
    <div class="upload">
        <form action="compression.php?zipfile" method="post" enctype="multipart/form-data">
            <input type="hidden" name="upload">
            <div>
                <input type="file" name="zip" accept="text/*,image/*" required>
            </div>
            <div class="lin"></div>
            <div>
                <label>
                    <input type="checkbox" name="passwd">パスワード付きZIPにする
                </label>
            </div>
            <div class="line"></div>
            <input type="submit" value="アップロード" style="width: 250px; height: 50px;">
        </form>
    </div>
</body>
</html>
<?php
}
}elseif(isset($_GET['targz'])){
    if(isset($_SESSION['com'])){
        unset($_SESSION["com"]);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tar.gz圧縮</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<body>
    <h1>ファイルをtar.gzに圧縮します。</h1>
    <p style="font-size: 25px;">最大アップロードサイズは10MBです。</p>
    <p style="font-size: 25px;">アップロードできるのはテキストファイル、画像ファイルのみです。</p>
    <div class="upload">
        <form action="compression.php?targzfile" method="post" enctype="multipart/form-data">
            <input type="hidden" name="upload">
            <div>
                <input type="file" name="targz" accept="text/*,image/*" required>
            </div>
            <div class="line"></div>
            <input type="submit" value="アップロード" style="width: 250px; height: 50px;">
        </form>
    </div>
</body>
</html>
<?php
}
}
?>
