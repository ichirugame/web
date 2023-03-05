<?php
include_once('../db.php');
if($sqlite){
    $pdo = new PDO('sqlite:' . $database_name);
}else{
    $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
}
$sql = "SELECT file_compression FROM service_setting WHERE id = 1;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$pdo = null;
if($result['file_compression']){
session_name('compression');
session_start();
$token = uniqid(mt_rand(), true);
$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注意</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/index.css">
</head>
<body>
    <div class="caution">
        <h1>注意</h1>
        <p>よくお読みください。</p>
        <h2>利用はおすすめしません。</h2>
    </div>
    <p>zipはファイルをアップロードしてzipに圧縮します。</p>
    <p>アップロードされたファイルはzipがダウンロードされたとき、毎日0時で削除されます。</p>
    <div class="caution">
        <p>重要なファイルはアップロードしないでください。</p>
        <p>アップロードは自己責任です。</p>
        <p>不正アクセス等でファイルが流失しても当方では責任は負いかねます。</p>
    </div>
    <p>ソースコードを<a href="https://github.com/ichirugame/web">github</a>で公開しているため、どのような処理をしているか確認できます。</p>
    <p>この先は移動することはおすすめしませんが移動したい方はチェックボックスにチェックを入れて移動ボタンを押してください。</p>
    <form action = "upload.php" method="POST">
        <label>
            <input type="checkbox" name="token" value="<?php echo $token;?>">理解しました
        </label>
        <br>
        <input type="submit" value="移動" class="button">
    </form>
</body>
</html>
<?php
}else{
    include_once('../error/ban.html');
}
