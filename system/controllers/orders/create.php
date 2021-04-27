<?php

session_start();

//var_dump($_GET);
//var_dump($_SESSION['basket']);

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');


$arr_fields = [];
$arr_values = [];

foreach ($_GET as $key => $value) {

    if($key != 'del_method') {
        $arr_fields[] = $key;
        $arr_values[] = "'".$value."'";
    }
}

$delivery = (new \Core\Delivery())->getDataById($_GET['del_method']);  

$arr_fields[] = 'order_del';
$arr_values[] = $delivery['del_cost'];

$arr_fields[] = 'del_method';
$arr_values[] = "'".$delivery['del_method']."'";


$arr_fields[] = 'goods';
$arr_values[] = "'".json_encode($_SESSION['basket'])."'";

$arr_fields[] = 'publ_time';
$arr_values[] = time();


$str_fields = implode(',' , $arr_fields);
$str_values = implode(',' , $arr_values);
var_dump($str_fields);

$connect = new \Core\ConnectDB();

$result = mysqli_query($connect->getConnection(), "INSERT INTO core_orders($str_fields) VALUES($str_values) ");
$last_id = mysqli_insert_id($connect->getConnection());

if($result) {
    
    session_start();

    $_SESSION['basket'] = [];
    $_SESSION['basket_count'] = 0;

    header('Location: http://localhost/orders/done.php'.'?neworder='.$last_id);

} else {
    echo 'Something is wrong';
    
}