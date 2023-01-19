<?php
if(isset($_POST['memo'])){
    if(empty($_POST['Deadline'])){
        $time = time() + 94608000;
    }elseif(isset($_POST['Deadline'])){
        $time = time() + 300;
    }
    $memo_date = $_POST['memo'];
    $domain = $_SERVER['SERVER_NAME'];
    setcookie('memo', $memo_date, $time, $domain);
    header('Location: ./index.php');
    exit;
}else{
    include_once('../error/400.php');
}
?>
