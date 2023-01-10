<?php
if(isset($_POST['memo'])){
    $memo_date = $_POST['memo'];
    $time = time() + 94608000;
    $domain = $_SERVER['SERVER_NAME'];
    setcookie('memo', $memo_date, $time, $domain);
    header('Location: ./index.php');
    exit;
}else{
    header('Location: ./index.php');
    exit;
}
?>
