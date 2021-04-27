<?php

session_start();

$_SESSION['basket'] = [];
$_SESSION['basket_count'] = 0;

header('Location: '.$_SERVER['HTTP_REFERER']);