<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
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
        <? require_once('components/header/index.php') ?>
            <? 
                $arr = [
                    1 => "от 500 до 1999",
                    2 => "от 2000 до 4999",
                    3 => "от 5000 до 9999",
                    4 => "от 10000",
                ];
            ?>
            <? 
                if(isset($_GET['category_id'])) {
                    $category = new \Core\Category($_GET['category_id']);
                    $cat_name = $category->getField('title');
                } else {
                    $cat_name = 'Все товары';
                }

                if(isset($_GET['type'])) {
                    $type = new \Core\Type($_GET['type']);
                    $type_name = $type->getField('title');
                } else {
                    $type_name = 'Все товары';
                }
                if(isset($_GET['price'])) {
                    $price_name = $arr[$_GET['price']];
                } else {
                    $price_name = '';
                }
            ?>

            <nav class="crumb flex-box">
                <a href="/index.php">Главная</a>
                <p>/</p>
                <a href="#"><?= $cat_name ?></a>
            </nav>

            <h2><?= $cat_name ?></h2>
            <p class="italic-style"><?= $type_name ?></p>
            <p class="italic-style" style="font-size:1em;"><?= $price_name ?></p>

            <?
                $str_get = trim(trim($_SERVER['REQUEST_URI'], "/catalog.php"), "?");
                
                $mas = [];

                foreach($_GET as $key => $value) {
                    if(isset($_GET['page']) && $key=='page') {
                        $str_get = str_replace("$key=$value","",$str_get);
                    }
                    $mas[$key] = trim(str_replace("$key=$value", "", $str_get), "?&");
                }
                //  var_dump($_GET);
            ?>

            <div class="filters flex-box">
                <div class="filters-item flex-box" >
                    <p>Категория</p>    
                    <img class="filters-arrow" src="/images/icons/filter-arrow.svg" alt="">
                    <div class="filters-item-style">
                        <div>
                            <a href="?type=1<?=isset($_GET['type']) ? '&'.$mas['type'] : '&'.$str_get?>">Верхняя одежда</a>
                            <a href="?type=2<?=isset($_GET['type']) ? '&'.$mas['type'] : '&'.$str_get?>">Обувь</a>
                            <a href="?type=3<?=isset($_GET['type']) ? '&'.$mas['type'] : '&'.$str_get?>">Джинсы</a>
                            <a href="?type=4<?=isset($_GET['type']) ? '&'.$mas['type'] : '&'.$str_get?>">Кофты</a>
                            <a href="?type=5<?=isset($_GET['type']) ? '&'.$mas['type'] : '&'.$str_get?>">Спортивная одежда</a>
                            <?if(isset($_GET['type'])){?>
                                <a style="color: rgb(246, 130, 54); margin-top:20px;" href="?<?=$mas['type']?>">Сбросить</a>
                            <?}?>
                        </div>
                    </div>
                </div>
                
                <div class="filters-item flex-box" >
                    <p>Размер <?=isset($_GET['size']) ? '('.$_GET['size'].')' : ''?></p>
                    <img class="filters-arrow" src="/images/icons/filter-arrow.svg" alt="">
                    <div class="filters-item-style filters-item-sizes">
                          
                        <div>
                         
                            <a href="?size=xs<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">XS</a>
                            <a href="?size=s<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">S</a>
                            <a href="?size=m<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">M</a>
                            <a href="?size=l<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">L</a>
                            <a href="?size=xl<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">XL</a>
                            
                            <?if(isset($_GET['size'])){?>
                                <a style="color: rgb(246, 130, 54); margin-top:20px;" href="?<?=$mas['size']?>">Сбросить</a>
                            <?}?>

                        </div>
                        <div>
                            <a href="?size=36<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">36</a>
                            <a href="?size=37<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">37</a>
                            <a href="?size=38<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">38</a>
                            <a href="?size=39<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">39</a>
                            <a href="?size=40<?=isset($_GET['size']) ? '&'.$mas['size'] : '&'.$str_get?>">40</a>
                        </div>
                    </div>
                </div>
                <div class="filters-item flex-box">
                    
                    <p>Стоимость</p>
                    <img class="filters-arrow" src="/images/icons/filter-arrow.svg" alt="">
                    <div class="filters-item-style">
                        <div>
                        
                        <?foreach($arr as $key => $val) {?>
                            <a href="?price=<?=$key?><?=isset($_GET['price']) ? '&'.$mas['price'] : '&'.$str_get?>"><?=$val?></a>
                        <?}?>                            
                            
                            <?if(isset($_GET['price'])){?>
                                <a style="color: rgb(246, 130, 54); margin-top:20px;" href="?<?=$mas['price']?>">Сбросить</a>
                            <?}?>

                        </div>
                    </div>
                </div>
            </div>

            <?php
                    $connect = new \Core\ConnectDB();
                    
                    //_str для пагинации
                    $cat_str = '';
                    $type_str = '';
                    $new_str = '';
                    $filter = '';
                    $size_str = '';
                    $price_str = '';
                    $filter_price = '';
                    
                    if(isset($_GET['category_id']) && $cat_id = $_GET['category_id']) {
                        $filter .= " AND category_id = $cat_id";
                        $cat_str = "&category_id=$cat_id";
                    }

                    if(isset($_GET['type']) && $type_id = $_GET['type']) {
                        $filter .= " AND `type_id` = $type_id";
                        $type_str = "&type=$type_id";
                    }

                    if(isset($_GET['is_new']) && $is_new = $_GET['is_new']) {
                        $filter .= " AND `is_new` = $is_new";
                        $new_str = "&is_new=$is_new";
                    }

                    if(isset($_GET['size']) && $size_id = $_GET['size']) {
                        $filter .= " AND `$size_id` = '1'";
                        $size_str = "&size=$size_id";
                    }

                    //Prices

                    if(isset($_GET['price']) && $_GET['price'] == 1) {
                        $filter_price = " AND price BETWEEN 500 AND 1999";
                        $price_str = "&price=1";
                    }
                    if(isset($_GET['price']) && $_GET['price'] == 2) {
                        $filter_price = " AND price BETWEEN 2000 AND 4999";
                        $price_str = "&price=2";
                    }
                    if(isset($_GET['price']) && $_GET['price'] == 3) {
                        $filter_price = " AND price BETWEEN 5000 AND 9999";
                        $price_str = "&price=3";
                    }
                    if(isset($_GET['price']) && $_GET['price'] == 4) {
                        $filter_price = " AND price >= 10000";
                        $price_str = "&price=4";
                    }
                    //the end

                    $result =  mysqli_query($connect->getConnection(), "SELECT COUNT(`core_goods`.`id`) as num FROM `core_goods`LEFT JOIN `sizes` ON `core_goods`.`id` = `sizes`.`good_id` WHERE `core_goods`.`id`>0 $filter $filter_price");
                    $info = mysqli_fetch_assoc($result);
                    $amount = $info['num'];
                    $per_page = 8;
                    $pages_amount = ceil($amount/$per_page);
                    
                    if($pages_amount==0) {
                        $noHave = 'К сожалению, таких товаров пока нет :(';
                    } else {
                        $noHave = null;
                    }

                    $page=1;
                    if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                    }
                ?>

            <p class="no-have"> <?= $noHave ?> </p>
            <div id="catalog"></div>

            <div class="pagination flex-box">
                
                <? for($i=1; $i<=$pages_amount; $i++) {?>
                    <div class="pagination-item <? if($i == $page) {?> active-page <?}?>">
                        <a href="?page=<?=$i?><?=$cat_str?><?=$type_str?><?=$new_str?><?=$size_str?><?=$price_str?>">
                            <?= $i ?>
                        </a>
                    </div>
                <?}?>
            </div>
            <? require_once('components/footer/index.php');?>
        </div>
    </div>
</body>
<script src="javascript/catalog.js"></script>
</html>