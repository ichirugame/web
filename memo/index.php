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
    input[type=checkbox]{
        transform: scale(1.8);
        margin: 0 6px 0 0;
    }
</style>
<body>
    <h1>メモの内容をクッキーに保存します。</h1>
    <p>通常は約3年です。</p>
    <p style="color: red;">重要なことは書かないでください！</p>
    <form action="./completion.php" method="POST">
        <textarea name="memo" style="width:500px; height:100px;"></textarea>
        <br>
        <label>
            <input type="checkbox" name="Deadline">約5分でcookieの削除
        </label>
        <br>
        <?php
        if(empty($_COOKIE['memo'])){
        ?>
        <input type="submit" value="保存" style="font-size: 20px; width: 150px;">
        <?php
        }elseif(isset($_COOKIE['memo'])){
        ?>
        <input type="submit" value="上書き保存" style="font-size: 20px; width: 150px;">
        <?php
        }
        ?>
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
