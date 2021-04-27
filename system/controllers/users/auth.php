<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

$login = $_GET['login'];
$password = $_GET['password'];

$connect = new \Core\ConnectDB();

$result = mysqli_query($connect->getConnection(),"SELECT * FROM core_users WHERE user_login='$login' OR user_email='$login' ");
$user = mysqli_fetch_assoc($result);

if ($user['id']) {
    if (hash_equals($user['user_password'], crypt($password,$user['user_password']))) {
        setcookie('user_id', $user['id'], time()+3600, '/');
        header('Location: http://localhost/catalog.php');
    } else {
        header('Location: '.$_SERVER['HTTP_REFERER'].'?wrong=1');
    }
} else {
    header('Location: '.$_SERVER['HTTP_REFERER'].'?wrong=1');
}






