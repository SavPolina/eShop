<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

$login = $_GET['login'];
$email = $_GET['email'];
$password = crypt($_GET['password']);

$connect = new \Core\ConnectDB();

$result = mysqli_query($connect->getConnection(),"SELECT COUNT(id) as num FROM core_users WHERE user_login='$login' OR user_email='$email' ");
$info = mysqli_fetch_assoc($result);
$amount = $info['num'];

if($amount > 0) {
    header('Location: '.$_SERVER['HTTP_REFERER'].'?wrong=1');
} else {
    mysqli_query($connect->getConnection(), "INSERT INTO core_users(user_login,user_email,user_password) VALUES('$login','$email','$password')");
    header('Location: http://localhost/auth/index.php'.'?newuser=1');
}




