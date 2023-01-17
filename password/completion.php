<?php
$pass = null;
if(isset($_POST['none'])){
    $pass = 'abcdefghijklmnopqrstuvwxyz0123456789!#$%&()=~*+?.<>[]{}@"/-_ABCDEFGHIJKLNMOPQRSTUVWXYZ';
}elseif(isset($_POST['nosym'])){
    $pass ='abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLNMOPQRSTUVWXYZ';
}elseif(isset($_POST['number'])){
    $pass = '123456789';
}elseif(isset($_POST['letter'])){
    $pass = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ';
}
$passwd = substr(str_shuffle($pass), 0, 20);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>結果</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<style>
    .line{
        margin: 220px;
    }
</style>
<body>
    <div class="line"></div>
    <p>パスワード生成結果</p>
    <p>
        <?php
        echo $passwd;
        ?>
    </p>
    <p>再生成するには<a href="./">前</a>に戻るかリロードしてください。</p>
</body>
</html>
