<?php
ini_set('session.cookie_lifetime', 94608000);
session_name('memo');
session_start();
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
    input[type=checkbox]{
        transform: scale(1.8);
        margin: 0 6px 0 0;
    }
</style>
<body>
    <h1>メモの内容をセッションに保存します。</h1>
    <p>通常は約3年です。</p>
    <p style="color: red;">重要なことは書かないでください！</p>
    <form action="./completion.php" method="POST">
<div>
<textarea name="memo" style="width:500px; height:100px;">
<?php
if(isset($_SESSION['memo'])){
echo $_SESSION['memo'];
}
?>
</textarea>
</div>
        <?php
        if(empty($_SESSION['memo'])){
        ?>
        <input type="submit" value="保存" style="font-size: 20px; width: 150px;">
        <?php
        }elseif(isset($_SESSION['memo'])){
        ?>
        <input type="submit" value="上書き保存" style="font-size: 20px; width: 150px;">
        <?php
        }
        ?>
    </form>
    <p>メモを削除するには<a href="./delete.php">ここから</a>削除可能です</p>
</body>
</html>
