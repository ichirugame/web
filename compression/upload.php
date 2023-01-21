<?php
session_start();
$token = isset($_POST["token"]) ? $_POST["token"] : "";
$session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";
unset($_SESSION["token"]);
if($token != "" && $token == $session_token){
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
    <h1 style="font-size: 35px;">ファイルをZIP圧縮します。</h1>
    <p style="font-size: 30px;">最大アップロードサイズは10MBです。</p>
    <p style="font-size: 30px;">アップロードできるのはテキストファイル、画像ファイルのみです。</p>
    <p style="font-size: 30px">パスワード付きZIPはアップロードされたファイル名は変更されます。</p>
    <div class="upload">
        <form action="compression.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="upload">
            <div>
                <input type="file" name="zip" accept="text/*,image/*">
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
}else{
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エラー</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<body>
    <div class="error">
        <p>正常なリクエストを得れませんでした。</p>
        <p>このページはリロードはできません。</p>
        <p><a href="../">トップに戻る</a></p>
    </div>
</body>
</html>
<?php
}
?>
