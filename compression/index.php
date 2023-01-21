<?php
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
