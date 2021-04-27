
<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

//$result =  mysqli_query((new \Core\ConnectDB())->getConnection(), "SELECT * FROM `core_articles`");
$result = (new \Core\Article())->getElements(); 

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет-магазин одежды</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=PT+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
    
</head>
<body>
    <div class="wrapper-bg">
        <div class="wrapper">
            <? require_once('components/header/index.php') ?>
            <main>
                <div class="main-head">
                    <h1>НОВЫЕ ПОСТУПЛЕНИЯ ВЕСНЫ</h1>
                    <p class="italic-style">Мы подготовили для Вас лучшие новинки сезона</p>
                    <a class="button" href="/catalog.php?is_new=1">ПОСМОТРЕТЬ НОВИНКИ</a>
                </div>
                <section class="blocks">
                    <? while($row = mysqli_fetch_assoc($result)){ ?>
                        <?php
                            $article = new \Core\Article($row['id']);
                        ?>
                        <div class="blocks-article" style="background-image: url('<?=$article->getField('photo')?>')">
                            <div class="blocks-article-items">
                                <img class="blocks-article-items-icon" src="<?=$article->getField('icon')?>" alt="">
                                <h3>
                                    <?=$article->getField('title')?>    
                                </h3>
                                <h4>
                                    <?=$article->getField('subtitle')?>
                                </h4>
                                <p>
                                    <?=$article->getField('description')?>
                                </p>
                            </div>
                        </div>
                    <?}?>
                </section>
                <div class="main-form">
                    <h2>будь всегда в курсе выгодных предложений</h2>
                    <p class="italic-style">подписывайся и следи за новинками и выгодными предложениями.</p>
                    <form class="main-form flex-box" action="">
                        <input type="email" placeholder="e-mail">
                        <input type="submit" value="подписаться">
                    </form>
                </div>
            </main>
            <? require_once('components/footer/index.php');?>
        </div>
    </div>

    
    
</body>
</html>