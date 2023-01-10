<?php
$memo_date = filter_input(INPUT_POST, 'memo');
if(isset($memo_date)){
    $time = time() + 94608000;
    $domain = $_SERVER['SERVER_NAME'];
    setcookie('memo', $memo_date, $time, $domain);
    header('Location: ./index.php');
}else{
    echo "エラーが発生しました。";
}
?>
