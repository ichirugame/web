<?php
//ログイン処理
include_once('../db.php');
session_start();
$error = null;
if($sqlite){
    $pdo = new PDO('sqlite:' . $database_name);
}else{
    $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
}
if(empty($_SESSION['login'])){
    if(isset($_POST['user_id'], $_POST['password'])){
        $_id = $_POST['user_id'];
        $_passwd = $_POST['password'];
        $sql = "SELECT * FROM user WHERE user_id = :user_id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $_id);
        $stmt->execute();
        $result = $stmt->fetch();
        if(@password_verify($_passwd, $result['passwd'])){
            $id = $result['id'];
            $_SESSION['login'] = $id;
            header('Location: ./');
            exit;
        }else{
            http_response_code(401);
            $error = 'ログインに失敗しました。';
        }
    }
}
$pdo = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<style>
    body{
        background-color: black;
        color: white;
        text-align: center;
    }
    .error{
        color: red;
    }
    .line{
        margin: 230px;
    }
</style>
<body>
    <div class="line"></div>
    <div class="error">
        <?php echo $error;?>
    </div>
    <form method="post">
        <label>
            <input type="text" name="user_id">ユーザーID
        </label>
        <br>
        <label>
            <input type="password" name="password">パスワード
        </label>
        <br>
        <input type="submit">
    </form>
</body>
</html>
