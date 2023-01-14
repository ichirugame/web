<?php
if(isset($_POST['memo'])){
    if(empty($_POST['Deadline'])){
        $time = time() + 94608000;
    }elseif(isset($_POST['Deadline'])){
        $time = time() + 300;
    }
    $memo_date = $_POST['memo'];
    $domain = $_SERVER['SERVER_NAME'];
    setcookie('memo', $memo_date, $time, $domain);
    header('Location: ./index.php');
    exit;
}else{
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>不正なリクエスト</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1 style="color: red;">不正なリクエストです。</h1>
    <p>リクエスト内容を確認してください。</p>
    <p><a href="../index.php">トップに戻る</a></p>
</body>
</html>
<?php
}
?>
