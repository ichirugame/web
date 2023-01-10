<?php
$user = $_SERVER['HTTP_USER_AGENT'];
if(preg_match("/iPhone|iPod|mac*/", $user)){
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
    <p>アクセスありがとうございます。</p>
    <p>apple製品はメモの機能をサポートしていません。</p>
</body>
</html>
<?php
}else{
    header('Location: ./index.php');
    exit;
}
?>
