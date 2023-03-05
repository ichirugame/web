<?php
session_start();
session_regenerate_id(true);
include_once('../db.php');
if($sqlite){
    $pdo = new PDO('sqlite:' . $database_name);
}else{
    $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
}
if(isset($_POST['ban'])){
    $sql = "INSERT INTO port_ban (domain) VALUES (:domain);";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':domain', $_POST['ban']);
    $stmt->execute();
    $pdo = null;
    header('Location: ./port-ban.php');
    exit;
}
?>
<?php
//html
if(isset($_SESSION['login'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポート開放BAN</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <form method="post">
        <p>ドメイン名、IPアドレス</p>
        <label>
            <input type="text" name="ban">
        </label>
        <br>
        <input type="submit">
    </form>
</body>
</html>
<?php
//html
}
?>
