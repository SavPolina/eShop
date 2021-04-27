
<?$connect = new \Core\ConnectDB();?>

<footer class="flex-box wrapper">
    <div class="footer-blocks">
        <p>КОЛЛЕКЦИИ</p>
        <nav class="footer-blocks-links">
            <?php
            $categories =  mysqli_query($connect->getConnection(), "SELECT * FROM categories ");
            while($category = mysqli_fetch_assoc($categories)) {
                $count = mysqli_query($connect->getConnection(), "SELECT COUNT(*) as num FROM core_goods WHERE category_id=".$category['id']);
                $info = mysqli_fetch_assoc($count);
            ?>
                <a href="/catalog.php?category_id=<?=$category['id']?>"><?=$category['title']?> (<?=$info['num']?>)</a>
            <?}?>
            <?php
            $count = mysqli_query($connect->getConnection(), "SELECT COUNT(*) as num FROM core_goods WHERE is_new=1");
            $info = mysqli_fetch_assoc($count);
            ?>
            <a href="/catalog.php?is_new=1">Новинки (<?=$info['num']?>)</a>
        </nav>
    </div>
    <div class="footer-separator"></div>
    <div class="footer-blocks">
        <p>МАГАЗИН</p>
        <nav class="footer-blocks-links">
            <a href="">О нас</a>
            <a href="">Доставка</a>
            <a href="">Работай с нами</a>
            <a href="">Контакты</a>
        </nav>
    </div>
    <div class="footer-separator"></div>
    <div class="footer-blocks footer-soc">
        <p>МЫ В СОЦИАЛЬНЫХ СЕТЯХ</p>
        <div class="footer-blocks-info">
            <div>
                <p>Сайт разработан в inordic.ru</p>
                <p>2018 © Все права защищены</p>
            </div>
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

</footer>
<script src="javascript/script.js"></script>