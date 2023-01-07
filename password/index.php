<?php
$pass = 'abcdefghijklmnopqrstuvwxyz0123456789!#$%&()=~*+?/-';
$passwd = substr(str_shuffle($pass), 0, 20);
$hash_passwd = password_hash($passwd, PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>簡易パスワード生成</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <!--brタグでやるのはだめだがめんどいからこのまま-->
    <br>
    <br>
    <p style="color: red;">passwordの暗号は使えるかはわかりません。</p>
    <p>パスワード生成</p>
    <p>a~z,0~9,!#$%&()=~*+?/-で20桁が自動生成されます。</p>
    <p>
    <?php
    echo "パスワード: ";
    echo $passwd;
    ?>
    </p>
    <p>
        passwordを暗号化した場合: 
        <?php
        echo $hash_passwd;
        ?>
    </p>
</body>
</html>
