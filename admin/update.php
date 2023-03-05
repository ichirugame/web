<?php
session_start();
session_regenerate_id(true);
$sh = null;
if(isset($_SESSION['login'])){
    if(isset($_POST['update'])){
        $sh = shell_exec("sh ../update.sh");
        sleep(10);
        header('Location: ./update.php?conp');
        exit;
    }
    if(!isset($_GET['conp'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アップデート</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>アップデート</h1>
    <form action="./update.php" method="POST">
        <input type="hidden" name="update">
        <input type="submit" value="アップデートを実行" style="font-size: 20px; width: 350px;">
    </form>
</body>
</html>
<?php
    }
}
if(isset($_SESSION['login'], $_GET['conp'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>完了</title>
</head>
<body>
    <p>アップデートは完了しました。</p>
    <p><a href="./">トップに戻る</a></p>
</body>
</html>
<?php
}
