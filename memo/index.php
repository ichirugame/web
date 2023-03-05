<?php
include_once('../db.php');
if($sqlite){
    $pdo = new PDO('sqlite:' . $database_name);
}else{
    $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
}
$sql = "SELECT memo FROM service_setting WHERE id = 1;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$pdo = null;
if($result['memo']){
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
echo htmlspecialchars($_SESSION['memo'], ENT_QUOTES);
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
<?php
}else{
    include_once('../error/ban.html');
}
