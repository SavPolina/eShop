<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <? 
    include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');
    ?>

    <?php 
        $goods = new \Core\Good($_GET['id']);
    ?>

    <title><?=$goods->getField('title');?></title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=PT+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">

    
    
</head>
<body>
    <div class="wrapper-bg">
        <div class="wrapper">
            <? require_once('components/header/index.php') ?>   

            <? 
                $category = new \Core\Category($goods->getField('category_id'));
                $cat_name = $category->getField('title');

                $type = new \Core\Type($goods->getField('type_id'));
                $type_name = $type->getField('title');
            ?>

            <nav class="crumb flex-box">
                <a href="/index.php">Главная</a>
                <p>/</p>
                <a href="catalog.php?category_id=<?=$goods->getField('category_id')?>">
                    <?= $cat_name ?>
                </a>
                <p>/</p>
                <a href="catalog.php?category_id=<?=$goods->getField('category_id')?>&type=<?=$goods->getField('type_id')?>">
                    <?= $type_name ?>
                </a>
                <p>/</p>
                <a href="#"><?= $goods->getField('title') ?></a>
            </nav>

            <div class="card">
                <div class="card-photo">
                    <img src="<?=$goods->getField('photo');?>" alt="">
                </div>
                <form method="GET" action="">
                    <div class="card-info">
                        <h2> <?=$goods->getField('title');?> </h2>
                        <p class="card-info-articul"> Артикул: <?=$goods->getField('articul');?> </p>
                        <p class="card-info-price"> <?=$goods->getField('price');?> руб. </p>
                        <p class="card-info-description"> <?=$goods->getField('description');?> </p>
                        <div>
                            <p class="text-size">Размер</p>
                            <div class="size flex-box">
                            <?if($goods->getField('type_id') != 2) {?>
                                <label>
                                    <input type="radio" name="size" value="XS">
                                    <div <? if($goods->getField('XS') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>XS</span></div>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="S">
                                    <div <? if($goods->getField('S') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>S</span></div>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="M">
                                    <div <? if($goods->getField('M') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>M</span></div>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="L">
                                    <div <? if($goods->getField('L') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>L</span></div>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="XL">
                                    <div <? if($goods->getField('XL') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>XL</span></div>
                                </label>
                                <?} else {?>
                                <label>
                                    <input type="radio" name="size" value="36">
                                    <div <? if($goods->getField('36') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>36</span></div>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="37">
                                    <div <? if($goods->getField('37') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>37</span></div>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="38">
                                    <div <? if($goods->getField('38') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>38</span></div>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="39">
                                    <div <? if($goods->getField('39') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>39</span></div>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="40">
                                    <div <? if($goods->getField('40') != 1) {?> class="out-of-stock flex-box" title="Нет в наличии" <?} else {?> class="size-info flex-box"<?}?>><span>40</span></div>
                                </label>
                                <?}?>
                            </div>
                        </div>
                    </div>
                    <div id='basket-btn' onclick=toBasket() class="button-card">
                        <div id='basket-button' class="button-auth">Добавить в корзину</div>
                    </div>
                </form>

            </div>
            <? require_once('components/footer/index.php');?>
        </div>
    </div>
</body>
<script>
document.querySelector('.size-info').closest('label').querySelector('[type="radio"]').checked = true;
</script>
<script src="javascript/card.js"></script>
</html>