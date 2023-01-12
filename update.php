<?php
$config_update = false;
if(isset($_POST['update'])){
    if(isset($config_update)){
       shell_exec("sh ./update.sh");
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アップデート</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <h1>アップデート</h1>
    <form action="./update.php" method="POST">
        <?php
        if($config_update){
        ?>
        <input type="hidden" name="update">
        <input type="submit" value="アップデートを実行" style="font-size: 20px; width: 350px;">
        <?php
        }else{
        ?>
        <p>アップデートは許可されていません。</p>
        <?php
        }
        ?>
    </form>
</body>
</html>
