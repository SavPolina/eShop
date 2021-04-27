<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=PT+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>
    <div class="wrapper-bg">
        <div class="wrapper">
            <? require_once($_SERVER['DOCUMENT_ROOT'].'/components/header/index.php') ?>   
            <main class="flex-box form-page">

            <? if(isset($_GET['newuser'])) { ?>
                <h2>Поздравляем! Вы успешно зарегистрированы!</h2>
            <?}?>
                <form action="../system/controllers/users/auth.php" method="get">
                    <h3>Вход</h3>
                    <div class="form">
                        <div class="form-input"><input required type="text" name="login" placeholder="Логин или Email"></div>
                        <div class="form-input"><input required type="password" name="password" placeholder="Пароль"></div>

                            <? if (isset($_GET['wrong'])) {?>
                            <div class="form-error">    
                                Неверный логин или пароль
                            </div>
                            <?}?>

                        <div class="form-input"><button class="button-auth">войти</button></div>
                        <div class="form-input">или <a class="form-link" href="reg/index.php">зарегистрироваться</a></div>
                    </div>
                </form>
            </main>
            <?$connect = new \Core\ConnectDB();?>

            <? require_once($_SERVER['DOCUMENT_ROOT'].'/components/footer/index.php');?>
        </div>
    </div>
    
    
    
</body>
</html>