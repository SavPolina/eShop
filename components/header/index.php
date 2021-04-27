<? session_start(); ?>
<!-- 
<link href="https://fonts.googleapis.com/css2?family=Manrope&family=PT+Sans&family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/normalize.css">
<link rel="stylesheet" href="/css/style.css"> -->

<header>
    <div class="wrapper">
        <div class="pos-fixed">
            <div class="head flex-box">
                <div class="flex-box menu-full">
                    <a class="logo" href="/index.php"></a>
                    <nav class="header-menu">
                        <a class="header-menu-item <? if(isset($_GET['category_id']) && $_GET['category_id'] == 1){ ?> is-active <?}?>" href="/catalog.php?category_id=1" >Женщинам</a>
                        <a class="header-menu-item <? if(isset($_GET['category_id']) && $_GET['category_id'] == 2){ ?> is-active <?}?>" href="/catalog.php?category_id=2" >Мужчинам</a>
                        <a class="header-menu-item <? if(isset($_GET['category_id']) && $_GET['category_id'] == 3){ ?> is-active <?}?>" href="/catalog.php?category_id=3" >Детям</a>
                        <a class="header-menu-item <? if(isset($_GET['is_new']) && $_GET['is_new'] == 1){ ?> is-active <?}?>" href="/catalog.php?is_new=1">Новинки</a>
                        <a href="#" class="header-menu-item">О нас</a>
                    </nav>
                </div>
                <div class="flex-box menu-full">
                    <div class="header-account flex-box">
                        <img src="/images/icons/account.png" alt="">
                        <p>
                            <? if (isset($_COOKIE['user_id'])) { ?>

                                <?php
                                $user = new \Core\User($_COOKIE['user_id']);
                                $userName = $user->getField('user_login');
                                ?>

                                Привет, <?= $userName ?> (<a style="color: rgb(255, 162, 0)" href="system/controllers/users/logout.php">выйти</a>)
                            <?} else { ?>
                                <a href="/auth/index.php"> Вход </a>
                            <?}?>
                        </p>

                        <? if(isset($_COOKIE['user_id']) && $user->getField('user_group') ==2) {?>
                            <a style="font-weight:900;" href="http://localhost/admin/">Админ</a>
                        <?} else {
                        }?>
                    </div>
                    <div class="header-account flex-box">
                        <img src="/images/icons/bascet.png" alt="">
                        <a href="/basket.php">Корзина(<span id="basket-count"><?=isset($_SESSION['basket_count'])?$_SESSION['basket_count']:'0'?></span>)</a>
                    </div>
                </div>
                
                <div class="adaptive-menu">
                    <a class="logo" href="/index.php"></a>
                    <div class="burger"></div>
                </div>
                <div class="adaptive-menu">

                    <div class="burger-menu">
                        <div class="flex-box">
                            <a class="logo" href="/index.php"></a>
                            <div class="burger-close"></div>
                        </div>
                        <nav class="header-menu-adaptive">
                            <a class="header-menu-item <? if(isset($_GET['category_id']) && $_GET['category_id'] == 1){ ?> is-active <?}?>" href="/catalog.php?category_id=1" >Женщинам</a>
                            <a class="header-menu-item <? if(isset($_GET['category_id']) && $_GET['category_id'] == 2){ ?> is-active <?}?>" href="/catalog.php?category_id=2" >Мужчинам</a>
                            <a class="header-menu-item <? if(isset($_GET['category_id']) && $_GET['category_id'] == 3){ ?> is-active <?}?>" href="/catalog.php?category_id=3" >Детям</a>
                            <a class="header-menu-item <? if(isset($_GET['is_new']) && $_GET['is_new'] == 1){ ?> is-active <?}?>" href="/catalog.php?is_new=1">Новинки</a>
                            <a href="#" class="header-menu-item">О нас</a>
                        </nav>
                        <div class="footer-blocks-social">
                            <a class="footer-blocks-social-item" href="#">
                                <img src="/images/icons/twitter.svg" alt="">
                            </a>
                            <a class="footer-blocks-social-item" href="#">
                                <img src="/images/icons/facebook.svg" alt="">
                            </a>
                            <a class="footer-blocks-social-item" href="#">
                                <img src="/images/icons/instagram.svg" alt="">
                            </a>
                        </div>
                    </div>
                    
                </div>
                <div class="adaptive-menu">
                    <div class="header-account flex-box">
                        <a href="auth/index.php">
                            <img src="/images/icons/account.png" alt="">
                        </a>
                        <p>
                            <? if (isset($_COOKIE['user_id'])) { ?>

                                <?php
                                $user = new \Core\User($_COOKIE['user_id']);
                                $userName = $user->getField('user_login');
                                ?>

                                <?= $userName ?> (<a style="color: rgb(255, 162, 0)" href="system/controllers/users/logout.php">выйти</a>)
                            <?} else { ?>
                                <a href="auth/index.php"> Вход </a>
                            <?}?>
                        </p>
                    </div>
                    <div class="header-account flex-box">
                        <a href="/basket.php">
                            <img src="/images/icons/bascet.png" alt="">
                            <a href="/basket.php">(<span id="basket-count-adaptive"><?=isset($_SESSION['basket_count'])?$_SESSION['basket_count']:'0'?></span>)</a>
                    
                        </a>
                    </div>
                </div>
                
            </div>
            <div class="header-line"></div>
        </div>
    </div>
</header>