<?php
$passwd = filter_input(INPUT_POST, 'passwd');
if($passwd){
$bash = password_hash($passwd, PASSWORD_DEFAULT);
}else{
    $bash = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>暗号化</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <p>パスワードを暗号化します。</p>
    <form action="./index.php" method="POST">
        <input type="text" name="passwd">
        <input type="submit" value="送信">
</form>
<p>結果</p>
<p>入力された内容: 
    <?php
    echo $passwd;
    ?>
</p>
<p>暗号化: 
<?php
echo $bash;
?>
</p>
</body>
</html>
