<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

$id = (int)$_GET['id'];

$arr_fields = [];
$arr_values = [];

foreach ($_GET as $key => $value) {
    if ($key != 'id') {
        $arr_fields[] = $key;
        $arr_values[] = "'".$value."'";
    }
}

for ($i=0; $i<count($arr_fields); $i++) {
    $str_update .= $arr_fields[$i] . '=' . $arr_values[$i] . ',';
}
$str_update = trim($str_update, ',');

$connect = new \Core\ConnectDB();

$result = mysqli_query($connect->getConnection(), "UPDATE core_users SET $str_update WHERE id=$id ");

if($result) {
    header('Location: ' .$_SERVER['HTTP_REFERER']);
} else {
    echo 'Something is wrong';
}