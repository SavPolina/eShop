<?php

session_start();

if (isset($_SESSION['basket_count'])) 
    $count = $_SESSION['basket_count'];
else 
    $count = 0;

if(isset($_SESSION['basket'])) {
    $basket = $_SESSION['basket'];
} else {
    $basket = [];
}

if(($id = $_GET['id']) && ($size = $_GET['size'])) {
    if(isset($basket[$id][$size])) {
        if($basket[$id][$size]>1) {
            $basket[$id][$size]--;
        }else{
            unset($basket[$id][$size]);
            if(isset($basket[$id]) && $basket[$id] == []) unset($basket[$id]);     
        }
        $count--;
    }
    
    
    $_SESSION['basket'] = $basket;
    $_SESSION['basket_count'] = $count;
    
    echo $_SESSION['basket_count'];
}