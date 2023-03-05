<?php
include_once('../db.php');
if($sqlite){
    $pdo = new PDO('sqlite:' . $database_name);
}else{
    $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . ';' , $user, $passwd);
}
$sql = "SELECT memo FROM service_setting WHERE id = 1;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$pdo = null;
if($result['memo']){
session_name('memo');
session_start();
if(isset($_POST['memo'])){
    $_SESSION['memo'] = $_POST['memo'];
    header('Location: ./index.php');
    exit;
}else{
    include_once('../error/400.php');
}
}else{
    include_once('../error/ban.html');
}
