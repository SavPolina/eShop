<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

//$result =  mysqli_query((new \Core\ConnectDB())->getConnection(), "SELECT * FROM `core_goods`");
$result = (new \Core\Good())->getElements();

?>

<section class="catalog-items flex-box">
    <!-- карточка -->
    <? while($row = mysqli_fetch_assoc($result)){ ?>
        <?php
            $goods = new \Core\Good($row['good_id']);
        ?>
        <div class="item">
            <div class="item-photo">

                <? if ($goods->getField('is_new') == 1) { ?>
                    <div class="new-item"><div>NEW</div></div>
                <?}?>

                <a href="card.php?id=<?=$goods->getField('good_id')?>">
                    <img src="<?=$goods->getField('photo');?>" alt="">
                </a>
            </div>
            <h3>
                <a href="card.php?id=<?=$goods->getField('good_id')?>">
                    <?=$goods->getField('title');?>  
                </a>  
            </h3>
            <p>
                <?=$goods->getField('price');?> руб.
            </p>
        </div>
    <?}?>
</section>

