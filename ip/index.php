<?php
$IP = $_SERVER['REMOTE_ADDR'];
$IPH = gethostbyaddr($IP);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPアドレス</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <p>自分のIPアドレス:
        <?php
        echo $IP;
        ?>
    </p>
    <p>
        自分のホストアドレス:
        <?php
        echo $IPH;
        ?>
    </p>
</body>
</html>