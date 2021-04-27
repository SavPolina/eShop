<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

$id = (int)$_POST['id'];

$arr_fields = [];
$arr_values = [];

foreach ($_POST as $key => $value) {
    if ($key != 'id' && $key != 'size') {
    $arr_fields[] = $key;
    $arr_values[] = "'".$value."'";
    }
}

if ($_FILES['photo']['name']) {
    //фото
    $file_name_info = explode('.', $_FILES['photo']['name']);
    $file_pure_name = $file_name_info[0];
    $file_ext = $file_name_info[1];
    $hash = md5($file_pure_name . time());
    $file_new_name = $file_pure_name . '_' . $hash .'.' . $file_ext;

    $file_full_path = 'images/catalog/'.$file_new_name;

    move_uploaded_file($_FILES['photo']['tmp_name'], '../../../' . $file_full_path);

    $arr_fields[] = 'photo';
    $arr_values[] = "'". $file_full_path ."'";

    $str_update = '';
}



for ($i=0; $i<count($arr_fields); $i++) {
    $str_update .= $arr_fields[$i] . '=' . $arr_values[$i] . ',';
}
$str_update = trim($str_update, ',');

$connect = new \Core\ConnectDB();

$result = mysqli_query($connect->getConnection(), "UPDATE core_goods SET $str_update WHERE id=$id ");

$result_2 = true;
$sizes = ['XS', 'S', 'M', 'L', 'XL', '36', '37', '38', '39', '40'];
if(isset($_POST['size'])) {
    $query ='';
    foreach($sizes as $val) {
        if(in_array($val, $_POST['size'])) {
            $query.=", `$val`= 1";
        } else {
            $query.=", `$val`= 0";
        }
    }
    $query = trim($query, ",");
    $result_2 = mysqli_query($connect->getConnection(), "UPDATE `sizes` SET $query WHERE `good_id`=$id ");
}

if($result && $result_2) {
    header('Location: ' .$_SERVER['HTTP_REFERER']);
} else {
    echo 'Something is wrong';
}