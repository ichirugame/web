<?php
session_start();
if($_SESSION['login']){
    unset($_SESSION['login']);
    header('Location: ./');
    exit;
}else{
    http_response_code(400);
    header('Location: ./');
    exit;
}
