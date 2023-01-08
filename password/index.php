<?php
$pass = 'abcdefghijklmnopqrstuvwxyz0123456789!#$%&()=~*+?.<>[]{}@"/-ABCDEFGHIJKLNMOPQRSTUVWXYZ';
$passwd = substr(str_shuffle($pass), 0, 20);
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
    <br>
    <p>パスワード生成</p>
    <p>大文字の英文、小文字の英文、数字、記号が自動生成されます</p>
    <p>
    <?php
    echo "パスワード: ";
    echo $passwd;
    ?>
    </p>
</body>
</html>
