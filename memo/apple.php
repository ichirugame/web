<?php
if(preg_match("/iPhone|iPod|mac*/", $_SERVER['HTTP_USER_AGENT'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>できません</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>メモの機能は使えません。</h1>
    <p>メモ機能はapple製品をサポートしていません。</p>
    <p><a href="../index.php">トップに戻る</a></p>
</body>
</html>
<?php
}else{
    header('Location: ./index.php');
    exit;
}
?>
