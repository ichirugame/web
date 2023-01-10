<?php
$user = $_SERVER['HTTP_USER_AGENT'];
if(preg_match("/iPhone|iPod|mac*/", $user)){
    header('Location: ./apple.php');
    exit;
}else{
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メモ</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<style>
    .size{
        font-size: 25px;
    }
</style>
<body>
    <h1>メモの内容をクッキーに保存します。</h1>
    <p>クッキーの有効期限は約3年です。</p>
    <form action="./completion.php" method="POST">
        <textarea name="memo" style="width:500px; height:100px;"></textarea>
        <br>
        <input type="submit" value="送信" style="font-size: 20px; width: 150px;">
    </form>
    <p>クッキーに保存されているメモの内容</p>
    <div class="size">
        <p>段落は半角になります。</p>
    </div>
    <?php
    if(empty($_COOKIE['memo'])){
        echo "保存されていません";
    }elseif(isset($_COOKIE['memo'])){
        echo $_COOKIE['memo']."<br>\n";
    }else{
        echo "不明なエラー";
    }
    ?>
    <p>メモを削除するには<a href="./delete.php">ここから</a>削除可能です</p>
</body>
</html>
<?php
}
?>
