<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'], $_POST['passwd'])){
    include_once('../db.php');
    if($sqlite){
        $pdo = new PDO('sqlite:' . $database_name);
    }else{
        $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
    }
    $password = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
    $sql = "UPDATE user SET passwd = :passwd WHERE id = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':passwd', $password);
    $stmt->bindValue(':id', $_SESSION['login']);
    $stmt->execute();
    $pdo = null;
    header('Location: ./passwd.php');
    exit;
}
?>
<?php
if(isset($_SESSION['login'])){
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <form action="" method="post">
        <p>パスワード</p>
        <input type="text" name="passwd">
        <br>
        <input type="submit">
    </form>
</body>
</html>
<?php
}
