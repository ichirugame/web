<?php
if($_POST && is_uploaded_file($_FILES['zip']['tmp_name'])){
    $source = $_FILES['zip']['tmp_name'];
    $filename = $_FILES['zip']['name'];
    $str = md5(uniqid(mt_rand(), true));
    $zipfile = __DIR__ . '/download/' . $str . '.zip';
    if(isset($_POST['passwd'])){
        $password = uniqid(mt_rand(), true);
        exec("zip -P $password $zipfile $source");
        $zip = true;
    }elseif(empty($_POST['passwd'])){
    $zip = new ZipArchive;
    $zip->open($zipfile, ZipArchive::CREATE);
    $zip->addFile($source, $filename);
    $zip->close();
    }
    if($zip){
        $zipf = $str . '.zip';
        $time = time() + 86400;
        $domain = $_SERVER['SERVER_NAME'];
        setcookie('zip', $zipf, $time, $domain);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>完了</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<script>
    setTimeout("redirect()", 2000);
    function redirect(){
        location.href="./compression.php?download";
    }
</script>
<body>
    <p>ZIP圧縮が完了しました。</p>
    <p>サーバーからZIPを削除できるのは24時間以内です。</p>
    <?php
    if(isset($_POST['passwd'])){
        echo 'ZIPパスワードは', $password, '<br>', 'ZIPパスワードは忘れないでください。';
    }
    ?>
    <p>それ以降は24時間以降に削除されます。</p>
    <form action="./compression.php" method="GET">
        <input type="hidden" name="delete">
        <input type="submit" value="サーバーからZIPを削除" style="width: 250px; height: 50px;">
    </form>
    <p>ダウンロードされませんか？</p>
    <p>されない場合は下のボタンをクリックしてください。</p>
    <form action="./compression.php" method="GET">
        <input type="hidden" name="download">
        <input type="submit" value="ダウンロード" style="width: 250px; height: 50px;">
    </form>
</body>
</html>
<?php
}
}
if(isset($_GET['download'])){
    if(isset($_COOKIE['zip'])){
        $zip_file = $_COOKIE['zip'];
        $zip = './download/' . $zip_file;
        header("Content-type: application/zip");
        header("Content-Disposition:attachment;filename = $zip");
        header('Content-Length: '.filesize("$zip"));
        echo file_get_contents($zip);
    }elseif(empty($_COOKIE['zip'])){
        echo '不明';
    }
}
if(isset($_GET['delete'])){
    if(isset($_COOKIE['zip'])){
        $zipf = $_COOKIE['zip'];
        $zipfile = __DIR__ . '/download/' . $zipf;
        unlink($zipfile);
        setcookie('zip', null, time() - 30);
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除完了</title>
    <link rel="stylesheet" type="text/css" href="../css/zip/style.css">
</head>
<body>
    <?php
    if(isset($_COOKIE['zip'])){
    ?>
    <p>サーバーからZIPファイルを削除しました。</p>
    <p><a href="../">トップに戻る</a></p>
    <?php
    }elseif(empty($_COOKIE['zip'])){
    ?>
    <p>削除するための必要な情報がありません</p>
    <p>サーバーからZIPファイルを削除するためにダウンロードされたZIP名を入力してください。</p>
    <p>ファイル拡張子までは書かないでください</p>
    <form action="./compression.php" method="GET">
        <div>
            <input type="text" name="zipname" style="width: 40%; height: 40px;">
        </div>
        <input type="submit" value="ZIPファイルを削除" style="width: 250px; height: 50px;">
    </form>
    <?php
    }
    ?>
</body>
</html>
<?php
}
if(isset($_GET['zipname'])){
    $zipname = $_GET['zipname'] . '.zip';
    $zipfile = __DIR__ . '/download/' . $zipname;
    if(file_exists($zipfile)){
        $delete = $zipname . 'を削除することに成功しました。';
        $Error = null;
        unlink($zipfile);
    }else{
        $delete = $zipname . 'を削除することに失敗しました。';
        $Error = 'そのようなファイルはありません。';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>完了</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <p>サーバーから<?php echo $delete; ?></p>
    <p>
        <?php
        echo $Error;
        ?>
    </p>
    <p>ご利用いただきありがとうございました。</p>
    <p><a href="../">トップに戻る</a></p>
</body>
</html>
<?php
}
?>
