<?php
$number = filter_input(INPUT_GET, 'number');
$number_2 = filter_input(INPUT_GET, 'number_2');
$value = filter_input(INPUT_GET, 'value');
$res = null;
if($value === '+'){
    $res = (int)$number + (int)$number_2;
}elseif($value === '-'){
    $res = (int)$number - (int)$number_2;
}elseif($value === '×'){
    $res = (int)$number * (int)$number_2;
}elseif($value === '÷'){
    $res = (int)$number / (int)$number_2;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<style>
.line{
    margin: 200px;
}
</style>
<body>
    <div class="line"></div>
    <form action="index.php" method="get">
        <div>
            <input type="number" name="number">
        </div>
        <div>
            <select name="value" style="width: 100px;">
            <option>+</option>
            <option>-</option>
            <option>×</option>
            <option>÷</option>
            </select>
        </div>
        <div>
            <input type="number" name="number_2">
        </div>
        <input type="submit" value="送信" style="width: 250px; height: 50px;">
    </form>
    <?php
    if(isset($res)){
    ?>
    <p>結果</p>
    <p>
        <?php
        echo $res;
        ?>
    </p>
    <?php
    }
    ?>
</body>
</html>
