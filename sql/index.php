<?php
if(isset($_POST['sql'])){
    $db = $_POST['sql'];
}
if(isset($_POST['reset'])){
    $_POST['reset'];
    $db = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sql文</title>
    <link rel="stylesheet" type="text/css" href="../css/sql.css">
</head>
<body>
    <p>sql文?</p>
    <form action="./index.php" method="POST">
    <textarea name="sql" style="width:500px; height:100px;"></textarea>
        <br>
        <input class="btn--orange btn--cubic btn--shadow" type="submit" value="送信">
    </form>
    <form action="./index.php" method="POST">
        <input class="reset--yellow reset--cubic" type="submit" type="reset" name="reset" value="リセットする">
    </form>
    <p>結果</p>
    <?php
    if($db){
    ?>
    <p>phpに直書き可能かもしれません</p>
    <p>
        $query = "
        <?php
        echo $db;
        ?>
        ";
    </p>
    <p>$mysqli = new mysqli(localhost, user_name, password, db_name);</p>
    <p>$mysqli->query($query);</p>
    <?php
    }
    ?>
</body>
</html>
