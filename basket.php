<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=PT+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">

    <? 
    include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');
    ?>
    
</head>
<body>
    <div class="wrapper-bg">
        <div class="wrapper">
            <? require_once('components/header/index.php'); ?>
            
            <h2 class="basket-head">Ваша корзина</h2>
            
            
            <div class="basket">
                <? if (isset($_SESSION['basket']) && count($_SESSION['basket'])) {?>

                    <p class="italic-style small-text">Товары резервируются на ограниченное время</p>
                    <div class="basket-table flex-box">
                        <div class="basket-table-info flex-box">
                            <p>Фото</p>
                            <p>Наименование</p>
                        </div>
                        <div class="basket-table-info flex-box">
                            <p>Размер</p>
                            <p>Количество</p>
                            <p>Стоимость</p>
                            <p>Удалить</p>
                        </div>
                    </div>
                    <div class="basket-separator"></div>
                    <? $arr = [];?>
                    <? foreach($_SESSION['basket'] as $id=>$mas){ ?>
                        <? foreach($mas as $size=>$count){ ?>
                            <? $goods = new \Core\Good($id); ?>
                            <div id="basket-full">
                                <div class="basket-item flex-box">
                                    <a href="card.php?id=<?=$goods->getField('good_id')?>" class="flex-box">
                                        <div class="basket-item-photo">
                                            <img src="<?=$goods->getField('photo');?>" alt="">
                                        </div>
                                        <div class="basket-item-info" >
                                            <p class="basket-item-name">
                                                <?=$goods->getField('title');?> 
                                            </p>
                                            <p class="basket-item-articul">
                                                арт. <?=$goods->getField('articul');?>
                                            </p>
                                        </div>
                                    </a>
                                    <div class="basket-item-choice flex-box">
                                        <div class="basket-item-size"><p id="basket-size">
                                        <? echo $size; ?>
                                        </p></div>
                                        <div class="basket-item-quantity">
                                            <div class="flex-box quantity">
                                                <p class="quantity-count"><?=$count?></p>
                                                <div class="quantity-choice">
                                                    <input class="quantity-choice-change" type="button" value="+" onclick="plusBasket()">
                                                    <input class="quantity-choice-change" type="button" value="-" onclick="minusBasket()">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="basket-item-price">
                                            <p class="basket-item-sum">
                                            <? $price = $goods->getField('price');
                                            $sum = $price * $count;
                                            echo $sum;?> 
                                            </p> 
                                            <p> &nbsp; руб.</p>
                                        </div>
                                        <a data-id="<?=$id?>" data-size="<?=$size?>" data-sum="<?=$price?>" onclick="fromBasket()" class="basket-item-delete">
                                            <img src="/images/icons/cancel.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="basket-separator"></div>
                            <?$arr[] = $sum;?>
                        <?}?>
                    <?}?>
                    

                    <div class="basket-sum flex-box">
                        <div class="flex-box">
                            <p style="margin-right:10px;">Итого:&nbsp;</p> 
                            <p style="color:rgb(246, 130, 54); font-weight:bold;"class="basket-total"><?= $total = array_sum($arr);?></p>
                            <p style="color:rgb(246, 130, 54); font-weight:bold;" data-total="<?=$total?>">&nbsp; руб.</p>
                        </div>
                    </div>
                    
                    <div class=" btn-clear flex-box">
                        <a href="system/controllers/basket/clearBasket.php"><p>Очистить корзину</p></a>
                    </div>
                    <div class="ornament flex-box">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="94px" height="18px">
                            <path fill-rule="evenodd"  fill="rgb(246, 130, 54)"
                            d="M77.836,18.006 L77.454,17.638 L77.094,17.987 L62.248,2.514 L47.319,18.006 L46.938,17.638 L46.577,17.987 L31.731,2.514 L16.802,18.006 L16.421,17.638 L16.061,17.987 L0.008,1.257 L1.292,0.013 L16.437,15.797 L31.666,-0.006 L31.747,0.073 L31.809,0.013 L46.954,15.797 L62.183,-0.006 L62.264,0.073 L62.326,0.013 L77.471,15.797 L92.699,-0.006 L93.992,1.241 L77.836,18.006 Z"/>
                        </svg>
                    </div>
                    <?
                    $delivery = new \Core\Delivery(1);
                    $delPrice = $delivery->getField('del_cost');
                    ?>
                    
                    <form id="order-form" action="system/controllers/orders/create.php" method="get">
                        <div class="basket-form">
                            <h2>Адрес доставки</h2>
                            <p class="italic-style small-text">Все поля обязательны для заполнения</p>
                            <div class="basket-form-items flex-box">
                                <div>
                                    <p>Выберите вариант доставки</p>
                                    <select class="basket-input-big basket-input-select" name="del_method">

                                    <? $result = (new \Core\Delivery())->getElements();
                                    while($row = mysqli_fetch_assoc($result)){ 

                                        $delivery = new \Core\Delivery($row['id']);?>
    
                                        <option data-del="<?=$delivery->getField('del_cost')?>" value="<?=$delivery->getField('id')?>" ><?=$delivery->getField('del_method')?> - <?=$delivery->getField('del_cost')?> руб.</option>
                                    
                                    <?}?>
                                    </select>
                                    
                                </div>
                                <div class="flex-box form-flex">
                                    <div>
                                        <p>имя</p>
                                        <input class="basket-input-small" type="text" name="first_name" id="" required>
                                    </div>
                                    <div>
                                        <p>фамилия</p>
                                        <input class="basket-input-small" type="text" name="surname" id="" required>
                                    </div>
                                </div>
                                <div>
                                    <p>Адрес</p>
                                    <input class="basket-input-big" type="text" name="address" id="" required>
                                </div>
                                <div class="flex-box form-flex">
                                    <div>
                                        <p>город</p>
                                        <input class="basket-input-small" type="text" name="city_address" id="" required>
                                    </div>
                                    <div>
                                        <p>индекс</p>
                                        <input class="basket-input-small" type="text" name="ind_address" id="" required>
                                    </div>
                                </div>
                                <div class="flex-box form-flex">
                                    <div>
                                        <p>телефон</p>
                                        <input class="basket-input-small" type="tel" name="phone" id="" required>
                                    </div>
                                    <div>
                                        <p>E-mail</p>
                                        <input class="basket-input-small" type="email" name="email" id="" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ornament flex-box">
                            <svg 
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="94px" height="18px">
                                <path fill-rule="evenodd"  fill="rgb(246, 130, 54)"
                                d="M77.836,18.006 L77.454,17.638 L77.094,17.987 L62.248,2.514 L47.319,18.006 L46.938,17.638 L46.577,17.987 L31.731,2.514 L16.802,18.006 L16.421,17.638 L16.061,17.987 L0.008,1.257 L1.292,0.013 L16.437,15.797 L31.666,-0.006 L31.747,0.073 L31.809,0.013 L46.954,15.797 L62.183,-0.006 L62.264,0.073 L62.326,0.013 L77.471,15.797 L92.699,-0.006 L93.992,1.241 L77.836,18.006 Z"/>
                            </svg>
                        </div>
                        <div class="basket-form">
                            <h2>Варианты оплаты</h2>
                            <p class="italic-style small-text">Все поля обязательны для заполнения</p>
                            <div class="flex-box basket-form-payment">
                                <div>
                                    <div class="flex-box">
                                        <p>Стоимость:&nbsp;</p>
                                        <input class="basket-input-inv basket-input-total" type="text" name="order_amount" value="<?=$total?>" readonly>
                                        <p>руб.</p>
                                    </div>
                                    <div class="flex-box">
                                        <p>Доставка:&nbsp;</p>
                                        <p id="order-del"><?=$delPrice?></p>
                                        <p>&nbsp;руб.</p>
                                    </div>
                                    <div class="flex-box">
                                        <p>Итого:&nbsp;</p>
                                        <input class="basket-input-inv basket-input-total-del" type="text" name="order_total" value="<?=$total+$delPrice?>" readonly>
                                        <p>руб.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-box basket-form-payment">
                                <div class="basket-form-items">
                                    <p>Выберите способ оплаты</p>
                                    <select class="basket-input-big basket-input-select" name="paym_method" id="">
                                        <option value="безналичный расчет" selected>Оплата картой</option>
                                        <option value="наличными">Оплата наличными</option>
                                    </select>
                                    <!-- <input class="basket-input-big" type="text" name="paym_method" id=""> -->
                                </div>
                            </div>
                            <div class="flex-box basket-form-payment basket-form-button">
                                <div>
                                    <button class="button-auth">заказать</button>
                                </div>
                            </div>
                            
                        </div>
                        
                    </form>
                    
                <?} else {?>
                    <p class="italic-style empty-basket">Ваша корзина пуста<p>
                <?}?>
                
                
            </div>

            <? require_once('components/footer/index.php');?>
        </div>
    </div>
</body>
<script src="javascript/basket.js"></script>
</html>