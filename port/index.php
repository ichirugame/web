<?php
include_once('../db.php');
if($sqlite){
    $pdo = new PDO('sqlite:' . $database_name);
}else{
    $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
}
$sql = "SELECT port FROM service_setting WHERE id = 1;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$pdo = null;
if($result['port']){
ini_set('default_socket_timeout',10);
$text = null;
if(isset($_POST['domain'], $_POST['port'])){
    $domain = $_POST['domain'];
    $port = $_POST['port'];
    $sql = "SELECT * FROM port_ban;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $ban = $stmt->fetch();
    if(in_array($domain, $ban)){
        header('Location: ./?error');
        exit;
    }
    function port($domain, $port){
        $fs = @fsockopen($domain, $port);
        if(!$fs){
            return false;
        }else{
            return true;
        }
    }
    $result = port($domain, $port);
    if($result){
        $text = '<div class="ok">' . '指定されたポートは解放されています。' . '</div>';
    }else{
        $text = '<div class="error">' . '指定されたポートは解放されていません。' . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポート解放確認</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<style>
    .ok{
        color: green;
    }
    .error{
        color: red;
    }
    .line{
        margin: 80px;
    }
</style>
<body>
    <div class="line"></div>
    <form method="POST">
        <input type="text" name="domain" placeholder="ドメイン名" required>
        <div class="line_2"></div>
        <input type="number" name="port" placeholder="ポート番号" required>
        <div class="line_2"></div>
        <input type="submit" style="font-size: 20px; width: 75px" value="実行">
    </form>
    <br>
    <?php
    echo $text;
    ?>
    <?php
    if(isset($_GET['error'])){
        echo '<div class="error">', '指定された文字列は使用できません。', '</div>';
    }
    ?>
</body>
</html>
<?php
}else{
    include_once('../error/ban.html');
}
