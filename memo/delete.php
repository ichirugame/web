<?php
if(isset($_COOKIE['memo'])){
    setcookie("memo", null, time() - 30);
    echo "削除できました。";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>完了</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/5s-redirect.js"></script>
</head>
<body>
    <p>cookieは正常に削除できました。</p>
    <p>これ以上の操作は不要です。</p>
    <p>5秒過ぎると最初の画面に戻ります。</p>
    <p><a href="./index.php">こちらからでも戻れます。</a></p>
</body>
</html>
</script>
<?php
}elseif(empty($_COOKIE['memo'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cookieなし</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/5s-redirect.js"></script>
</head>
<body>
    <p>cookieは削除されています。</p>
    <p>これ以上の操作は不要です。</p>
    <p>5秒過ぎると最初の画面に戻ります。</p>
    <p><a href="./index.php">こちらからでも戻れます。</a></p>
</body>
</html>
<?php
}else{
    header('Location: ./index.php');
    exit;
}
?>
