<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

$arr_fields = [];
$arr_values = [];

foreach ($_GET as $key => $value) {
    if($key!='user_password') {
        $arr_fields[] = $key;
        $arr_values[] = "'".$value."'";
    }
}
$arr_fields[] = 'user_password';
$arr_values[] = "'".crypt($_GET['user_password'])."'";


$str_fields = implode(',' , $arr_fields);
$str_values = implode(',' , $arr_values);

$connect = new \Core\ConnectDB();

$result = mysqli_query($connect->getConnection(), "INSERT INTO core_users($str_fields) VALUES($str_values) ");

if($result) {
    header('Location: http://localhost/admin/?page=users');
} else {
    echo 'Something is wrong';
    var_dump("INSERT INTO core_users($str_fields) VALUES($str_values) ");
    
}