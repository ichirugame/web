<?php
ini_set('session.cookie_lifetime', 94608000);
session_name('memo');
session_start();
if(isset($_POST['memo'])){
    $_SESSION['memo'] = $_POST['memo'];
    header('Location: ./index.php');
    exit;
}else{
    include_once('../error/400.php');
}
?>
