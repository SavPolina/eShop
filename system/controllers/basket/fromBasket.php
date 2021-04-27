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
    if(isset($basket[$id][$size])) $count-=$basket[$id][$size];
    unset($basket[$id][$size]);
    if(isset($basket[$id]) && $basket[$id] == []) unset($basket[$id]);
    

    // if (in_array($id,$basket)) {
    //     for($i=0;$i<count($basket);$i++) {
    //         if ($basket[$i]==$id) {
    //             unset($basket[$i]);
    //             break;
    //         }
    //     }
    //     sort($basket);
    // }
    
    $_SESSION['basket'] = $basket;  
    $_SESSION['basket_count'] = $count;
    echo $_SESSION['basket_count'];
    
}