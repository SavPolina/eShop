<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

$orders = new \Core\Orders($_GET['neworder']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ оформлен</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=PT+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>
    
    <div class="wrapper-bg">
        <div class="wrapper">
            <? require_once($_SERVER['DOCUMENT_ROOT'].'/components/header/index.php') ?> 

            <h2 style="margin-top:60px;margin-bottom:60px;">Поздравляем! Ваш заказ успешно оформлен!</h2>
            <p class="italic-style">Заказ № <?=$orders->getfield('id')?></p>

            <div>
                <div class="basket-table flex-box">
                    <div class="basket-table-info flex-box">
                        <p>Фото</p>
                        <p>Наименование</p>
                    </div>
                    <div class="basket-table-info flex-box">
                        <p>Размер</p>
                        <p>Количество</p>
                        <p>Стоимость</p>
                    </div>
                </div>

                <?$order_good = json_decode($orders->getField('goods'));

                foreach($order_good as $id=>$mas){ 
                    foreach($mas as $size=>$count){ 
                        $good = new \Core\Good($id); ?>

                        <div>
                            <div class="basket-item flex-box">
                                <div class="flex-box"   >
                                    <div class="basket-item-photo">
                                        <img src="http://localhost/<?=$good->getField('photo');?>" alt="">
                                    </div>
                                    <div class="basket-item-info" >
                                        <p class="basket-item-name">
                                            <?=$good->getField('title');?> 
                                        </p>
                                        <p class="basket-item-articul">
                                            арт. <?=$good->getField('articul');?>
                                        </p>
                                    </div>
                                </div>
                                <div class="basket-item-choice flex-box">
                                    <div class="basket-item-size">
                                        <p id="basket-size"><?=$size?></p>
                                    </div>
                                    <div class="basket-item-quantity">
                                        <div class="flex-box quantity">
                                            <p class="quantity-count"><?=$count?></p>
                                        </div>
                                    </div>
                                    <div class="basket-item-price">
                                        <p class="basket-item-sum">
                                        <? $price = $good->getField('price');
                                        $sum = $price * $count;
                                        echo $sum;?> 
                                        </p> 
                                        <p> &nbsp; руб.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="basket-separator"></div>
                    <?}?>
                <?}?>
            </div>
            
                    
        
            <div style="margin: 60px 0;">
                <div  class="basket-form-done">
                    <p class="main-head">Заказ на сумму: <?=$orders->getfield('order_amount')?> руб.</p>
                    <p class="main-head">Способ доставки: <?=$orders->getfield('del_method')?></p>
                    <p class="main-head">Стоимость доставки: <?=$orders->getfield('order_del')?></p>
                    <p class="main-head">Общая сумма заказа: <?=$orders->getfield('order_total')?> руб.</p>
                </div>
            </div>
            <div class="ornament flex-box" style="margin: 60px 0;"  >
                <svg 
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="94px" height="18px">
                    <path fill-rule="evenodd"  fill="rgb(246, 130, 54)"
                    d="M77.836,18.006 L77.454,17.638 L77.094,17.987 L62.248,2.514 L47.319,18.006 L46.938,17.638 L46.577,17.987 L31.731,2.514 L16.802,18.006 L16.421,17.638 L16.061,17.987 L0.008,1.257 L1.292,0.013 L16.437,15.797 L31.666,-0.006 L31.747,0.073 L31.809,0.013 L46.954,15.797 L62.183,-0.006 L62.264,0.073 L62.326,0.013 L77.471,15.797 L92.699,-0.006 L93.992,1.241 L77.836,18.006 Z"/>
                </svg>
            </div>
            <? require_once($_SERVER['DOCUMENT_ROOT'].'/components/footer/index.php');?>

        </div>        
        
    </div> 
       
</body>
</html>