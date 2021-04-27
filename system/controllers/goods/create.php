<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

$arr_fields = [];
$arr_values = [];

foreach ($_POST as $key => $value) {

    if($key != 'size') {
        $arr_fields[] = $key;
        $arr_values[] = "'".$value."'";
    }
}



//photo
if(file_exists($_FILES['photo']['name'])) {
    $file_name_info = explode('.', $_FILES['photo']['name']);
    $file_pure_name = $file_name_info[0];
    $file_ext = $file_name_info[1];
    $hash = md5($file_pure_name . time());
    $file_new_name = $file_pure_name . '_' . $hash .'.' . $file_ext;

    $file_full_path = 'images/catalog/'.$file_new_name;
} else {
    $file_full_path = 'images/catalog/noPhoto.jpg';
}

move_uploaded_file($_FILES['photo']['tmp_name'], '../../../' . $file_full_path);

$arr_fields[] = 'photo';
$arr_values[] = "'". $file_full_path ."'";
// end photo

$str_fields = implode(',' , $arr_fields);
$str_values = implode(',' , $arr_values);

$connect = new \Core\ConnectDB();

$result = mysqli_query($connect->getConnection(), "INSERT INTO `core_goods`($str_fields) VALUES($str_values) ");
$last_id = mysqli_insert_id($connect->getConnection());

$result_2 = true;
$sizes = ['XS', 'S', 'M', 'L', 'XL', '36', '37', '38', '39', '40'];
if(isset($_POST['size'])) {
    $query ='';
    $size_val = '';
    foreach($sizes as $val) {
        if(in_array($val, $_POST['size'])) {
            $query.=", '1'";
        } else {
            $query.=", '0'";
        }
        $size_val.= ", `$val`";
    }
    $query = trim($query, ",");
    $size_val = trim($size_val, ",");

    $good_name ="'". $_POST['title']."'";

    $str_tit = "`good_id`,`good_name`,".$size_val;
    $str_res = $last_id.",".$good_name.",".$query;

    $result_2 = mysqli_query($connect->getConnection(), "INSERT INTO `sizes` ($str_tit) VALUES ($str_res) ");
}


if($result && $result_2) {
    header('Location: http://localhost/admin/?page=items');
    var_dump($result_2);
    var_dump($_POST['size']);
    var_dump($last_id); 
} else {
    echo 'Something is wrong';
    
    var_dump("INSERT INTO `core_goods`($str_fields) VALUES($str_values) "); 
    var_dump("INSERT INTO `sizes` ($str_tit) VALUES ($str_res) "); 
}