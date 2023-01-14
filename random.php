<?php
$value = filter_input(INPUT_GET, 'value');
$pass = filter_input(INPUT_GET, 'random');
$random = substr(str_shuffle($pass), 0, $value);
if(isset($_POST['reset'])){
    $random = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自動生成</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<style>
    .value{
    font-size: 20px;
    }
</style>
<body>
    <p>指定した文字がランダムに生成されます。</p>
    <p>文字数の指定を30にしても30もランダム生成されるか、わかりません。</p>
    <form action="./random.php" method="GET">
        <p>生成させたい文字</p>
        <input type="text" name="random" style="width: 250px;">
        <br>
        <div class="value">
            <p>文字数の指定</p>
        </div>
        <select name="value" style="width: 100px;">
            <option>20</option>
            <option>21</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
        </select>
        <br>
        <input type="submit" value="送信" style="width: 100px;">
    </form>
    <form action="./random.php" method="POST">
        <input type="submit" type="reset" name="reset" value="リセットする">
    </form>
    <p>自動生成結果</p>
    <p>
        <?php
        echo $random;
        ?>
    </p>
</body>
</html>
