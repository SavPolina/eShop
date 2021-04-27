<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/system/classes/autoload.php');

    $user = new \Core\User($_COOKIE['user_id']);
    if($user->getField('user_group') !=2) {
        header('Location: http://localhost/catalog.php');
    }

?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Панель администратора">

    <title>Панель администратора</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>
      tbody tr th {
        font-weight: normal;
      }
      .navbar-nav {
        width: 14%;
      }
      .nav-item {
        display: flex;
        padding: 10px;
        justify-content: space-between;
        align-items: center;
      }
      .nav-item span {
          font-size: 18px;
      }
      .form-control {
        width: 70%;
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  
  

  <body>

<script defer>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4481610-59', 'auto');
  ga('send', 'pageview');

</script>

<!-- Yandex.Metrika counter --> 
<script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(39705265, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/39705265" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8588635311388465",
    enable_page_level_ads: true
  });
</script>


<nav class="navbar navbar-dark  flex-md-nowrap shadow" style="background-color: rgba(48, 48, 48)">
  <img src="/images/icons/logo.jpg" alt="">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/admin/">E-Shop</a>
  <input class="form-control form-control-dark " type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap ">
    <? if (isset($_COOKIE['user_id'])) { ?>

        <?php
        $user = new \Core\User($_COOKIE['user_id']);
        $userName = $user->getField('user_login');
        ?>

        <span style="color: rgb(256, 256, 256)">
            <?= $userName ?> 
        </span>   
        <a class="nav-link"  href="../system/controllers/users/logout.php">выйти</a>
        
    <?}?>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar" >
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="?page=orders">
              <span data-feather="file"></span>
              Заказы
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=items">
              <span data-feather="shopping-cart"></span>
              Товары
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=users">
              <span data-feather="users"></span>
              Клиенты
            </a>
          </li>
          
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      </div>
    <?if (isset($_GET['new'])) {?>
        <form action="../system/controllers/goods/create.php" method="post" enctype="multipart/form-data"> 
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Наименование" >                
            </div>
            <div class="form-group">
            <label for="exampleFormControlSelect1">Добавить фотографию</label>
                <input type="file" name="photo" class="form-control" >                
            </div>
            <div class="form-group">                
                <input type="text" name="articul" class="form-control" placeholder="Артикул" >
            </div>
            <div class="form-group">                
                <input type="number" name="price" class="form-control" placeholder="Цена (руб.)">
            </div>
            <div class="form-group">
                <textarea name="description" class="form-control" rows="3" placeholder="Описание"></textarea>
            </div>
            <p>Размер</p>
            <div class="form-group form-check">
                <?
                $sizes = ['XS', 'S', 'M', 'L', 'XL', '36', '37', '38', '39', '40'];

                foreach($sizes as $val) {?>

                <div class="form-group">
                    <input type="checkbox" name="size[]" value="<?=$val?>">
                    <label for="exampleFormControlSelect1"><?=$val?></label>
                </div>

                <?}?>
            </div>
            
            <div class="form-group">
                <label for="exampleFormControlSelect1">Категория</label>
                <select name="category_id" class="form-control" >
                    <option value="1">Женщинам</option>
                    <option value="2">Мужчинам</option>
                    <option value="3">Детям</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Тип товара</label>
                <select name="type_id" class="form-control" >
                    <option value="1">Верхняя одежда</option>
                    <option value="2">Обувь</option>
                    <option value="3">Джинсы</option>
                    <option value="4">Кофты</option>
                    <option value="5">Спортивная одежда</option>
                </select>
            </div>
            <div class="form-group form-check">
                <input value="1" name="is_new" type="checkbox" class="form-check-input" >
                <label class="form-check-label" for="exampleCheck1">Новинка</label>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    <?} elseif(isset($_GET['change'])) {?>
        
        <?if($_GET['change'] == 'item') {?>

            <? $good = new \Core\Good($_GET['id']);?>

            <form action="../system/controllers/goods/update.php" method="post" enctype="multipart/form-data"> 
                <input type="hidden" name="id" value="<?=$good->getfield('good_id')?>">

                <div class="form-group">
                    <input value="<?=$good->getfield('title')?>" type="text" name="title" class="form-control" placeholder="Наименование" >                
                </div>
                <img style="width: 100px;" src="http://localhost/<?=$good->getfield('photo')?>"/>
                <div class="form-group">
                <label for="exampleFormControlSelect1">Изменить фотографию</label>
                    <input type="file" name="photo" class="form-control" >                
                </div>
                <div class="form-group">                
                    <input value="<?=$good->getfield('articul')?>" type="text" name="articul" class="form-control" placeholder="Артикул" >
                </div>
                <div class="form-group">                
                    <input value="<?=$good->getfield('price')?>" type="number" name="price" class="form-control" placeholder="Цена (руб.)">
                </div>
                <div class="form-group">
                    <textarea name="description" class="form-control" rows="3" placeholder="Описание"><?=$good->getfield('description')?></textarea>
                </div>

                <? $category = new \Core\Category($good->getfield('category_id')) ?>
                <? $arr_category = [
                    '1'=>'Женщинам',
                    '2'=>'Мужчинам',
                    '3'=>'Детям',
                ] ?>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Категория</label>
                    <select name="category_id" class="form-control" >
                        <option value="<?=$category->getField('id')?>"><?=$category->getField('title')?></option>
                        
                        <? foreach ($arr_category as $key=>$value){?>
                            <? if ($key != $category->getField('id')) {?>
                                <option value="<?=$key?>"><?=$value?></option>
                            <?}?>
                        <?}?>
                    </select>
                </div>
                <? $type = new \Core\Type($good->getfield('type_id')) ?>
                <? $arr_type = [
                    '1'=>'Верхняя одежда',
                    '2'=>'Обувь',
                    '3'=>'Джинсы',
                    '4'=>'Кофты',
                    '5'=>'Спортивная одежда',
                ] ?>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Тип товара</label>
                    <select name="type_id" class="form-control" >
                        <option value="<?=$type->getField('id')?>"><?=$type->getField('title')?></option>

                        <? foreach ($arr_type as $key=>$value){?>
                            <? if ($key != $type->getField('id')) {?>
                                <option value="<?=$key?>"><?=$value?></option>
                            <?}?>
                        <?}?>
                        
                    </select>
                </div>
                <div class="form-group form-check">
                    <?
                    $connect = new \Core\ConnectDB();
                    $query = mysqli_query($connect->getConnection(), "SELECT * FROM `sizes` WHERE `good_id` = {$_GET['id']}");
                    $res = mysqli_fetch_assoc($query);
                    ?>
                    <? foreach($res as $key=>$value) {?>
                        <?if($key!='id' && $key!='good_id' && $key!='good_name' && $key!='Unisize'){?>
                            <?if($value==1){?>
                                <?=$key?>:<input type="checkbox" checked name="size[]" value="<?=$key?>"> <br>
                            <?} else {?>
                                <?=$key?>:<input type="checkbox" name="size[]" value="<?=$key?>"> <br>
                            <?}?>
                        <?}?>
                    <?}?>
                </div>
                <div class="form-group form-check">
                    <input type="hidden" value="0" name="is_new">
                    <input value="1" name="is_new" type="checkbox" class="form-check-input" <? if ($good->getField('is_new')){?> checked <?}?> >
                    <label class="form-check-label" for="exampleCheck1">Новинка</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        <?} elseif($_GET['change'] == 'user') {?>
            <? $user = new \Core\User($_GET['id']);?>

            <form action="../system/controllers/users/update.php" method="get"> 
                <input type="hidden" name="id" value="<?=$user->getfield('id')?>">

                <div class="form-group">
                    <input value="<?=$user->getfield('user_login')?>" type="text" name="user_login" class="form-control" placeholder="Логин" >                
                </div>
                <div class="form-group">
                    <input value="<?=$user->getfield('user_email')?>" type="text" name="user_email" class="form-control" placeholder="E-mail" >                
                </div>
            
                <? $usergroup = new \Core\UserGroup($user->getfield('user_group')) ?>
                <? $arr_group = [
                    '1'=>'Пользователь',
                    '2'=>'Менеджер'
                ] ?>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Группа</label>
                    <select name="user_group" class="form-control" >
                        <option value="<?=$usergroup->getField('id')?>"><?=$usergroup->getField('title')?></option>
                        
                        <? foreach ($arr_group as $key=>$value){?>
                            <? if ($key != $usergroup->getField('id')) {?>
                                <option value="<?=$key?>"><?=$value?></option>
                            <?}?>
                        <?}?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>

        <?}?>

    <?} elseif(isset($_GET['more'])) {?>
        <?$order_id = $_GET['id'];
          $order = new \Core\Orders($order_id);?>
        <h2>Заказ № <?=$order->getField('id')?></h2>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>E-mail</th>
                    <th>Телефон</th>
                    <th>Метод оплаты</th>
                    <th>Сумма заказа</th>
                    <th>Время заказа</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><?=$order->getField('first_name')?></th>
                    <th><?=$order->getField('surname')?></th>
                    <th><a href="mailto:<?=$order->getField('email')?>"><?=$order->getField('email')?></a></th>
                    <th><a href="tel:<?=$order->getField('phone')?>"><?=$order->getField('phone')?></a></th>
                    <th><?=$order->getField('paym_method')?></th>
                    <th><?=$order->getField('order_total')?> руб.</th>
                    <th><?=date('d-m-Y в H:i',$order->getField('publ_time'))?></th>
                </tr>
            </tbody>
        </table>
        <h4>Способ доставки: <?=$order->getField('del_method')?></h4>

        <?if($order->getField('del_method') != 'Самовывоз') {?>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Город</th>
                        <th>Адрес</th>
                        <th>Индекс</th>
                        <th>Стоимость доставки</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?=$order->getField('city_address')?></th>
                        <th><?=$order->getField('address')?></th>
                        <th><?=$order->getField('ind_address')?></th>
                        <th><?=$order->getField('order_del')?> руб.</th>
                    </tr>
                </tbody>
            </table>

        <?} else {
           
        }?>
        <h4>Товары</h4>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Артикул</th>
                    <th>Стоимость</th>
                    <th>Размер</th>
                    <th>Количество</th>
                    <th>Всего</th>
                </tr>
            </thead>
            <tbody>
            <?$order_good = json_decode($order->getField('goods'));
            foreach($order_good as $id=>$mas){
                foreach($mas as $size=>$count){
                    $good = new \Core\Good($id);?>
                    <tr>
                        <th><?=$good->getField('id')?></th>
                        <th><img style="width: 100px;" src="http://localhost/<?=$good->getfield('photo')?>"/></th>
                        <th><?=$good->getField('title')?></th>
                        <th><?=$good->getField('articul')?></th>
                        <th><?=$good->getField('price')?></th>
                        <th><?=$size?></th>
                        <th><?=$count?></th>
                        <th><?=$good->getField('price')*$count?></th>
                    </tr>
                <?}
            }?>
            </tbody>       
        </table>
        <div><h5>Всего товаров на сумму: <?=$order->getField('order_amount')?> руб.</h5></div>
        <form style="margin-bottom:100px;" action="../system/controllers/orders/done.php" method="get">
            <input type="hidden" name="id" value="<?=$order->getField('id')?>">
            <input type="hidden" name="order_status" value="2">
            <input type="hidden" name="last_update" value="<?=time()?>">
            <div style="margin-top:30px;" class="flex-box">
            <?$order_info = new \Core\Orders($_GET['id']);?>
                
                <button <? if($order_info->getField('last_update') != 0){?> disabled <?}?>type="submit" class="btn btn-primary">Обработан</button>
                <a style="margin-left:90px;" href="http://localhost/admin/?page=orders">Назад</a>
            </div>
            
        </form>
                
    <?} elseif(isset($_GET['newuser'])) {?>
        <form action="../system/controllers/users/create.php" method="get" enctype="multipart/form-data"> 
            <div class="form-group">
                <input type="text" name="user_login" class="form-control" placeholder="Логин" required >                
            </div>
            <div class="form-group">                
                <input type="email" name="user_email" class="form-control" placeholder="E-mail" required >
            </div>
            <div class="form-group">                
                <input type="password" name="user_password" class="form-control" placeholder="Пароль" required>
            </div>
            <div style="margin-bottom:20px;">
                <select name="user_group" class="form-control">
                    <option value="1">Пользователь</option>
                    <option value="2">Менеджер</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>   
    <?} else { ?> 
    <?}?>
    
    <? if(isset($_GET['page']) && $_GET['page'] == 'items') {?>
        <div style="display:flex; justify-content:space-between; padding:10px;">
            <h2>Товары</h2>
            <div>
                <a href="?new=item" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">+ создать</a>
            </div>
        
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>id</th>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Артикул</th>
                    <th>Категория</th>
                    <th>Тип товара</th>
                    <th>Новинка</th>
                    <!-- <th>Описание</th> -->
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $connect = new \Core\ConnectDB();
                        $result = mysqli_query($connect->getConnection(), " SELECT * FROM core_goods ");
                        while($info = mysqli_fetch_assoc($result)) {
                            $category = new \Core\Category($info['category_id']);
                            $type = new \Core\Type($info['type_id']);
                    ?>
                        <tr>
                            <th><?=$info['id']?></th>
                            <th><img style="width: 40px;" src="http://localhost/<?=$info['photo']?>"/></th>
                            <th> 
                                <a href="?change=item&id=<?=$info['id']?>" target="blank"> <?=$info['title']?></a> 
                            </th>
                            <th><?=$info['price']?></th>
                            <th><?=$info['articul']?></th>
                            <th><?=$category->getField('title')?></th>
                            <th><?=$type->getField('title')?></th>
                            <th><?=$info['is_new'] != 0 ? 'новинка': ''?></th>
                            <!-- <th><?=$info['description']?></th> -->
                            
                        </tr>
                    <?}?>
                </tbody>
            </table>
        </div> 
    <?} elseif (isset($_GET['page']) && $_GET['page'] == 'orders') {?>
        <h2>Заказы</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>id</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>E-mail</th>
                    <th>Телефон</th>
                    <th>Сумма заказа</th>
                    <th>Подробнее</th>
                    <th>Статус</th>
                    <th>Время заказа</th>
                    <th>Время обработки</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $connect = new \Core\ConnectDB();
                        $result = mysqli_query($connect->getConnection(), " SELECT * FROM core_orders ");
                        while($info = mysqli_fetch_assoc($result)) {
                            $status = new \Core\Status($info['order_status']);
                    ?>
                        <tr>
                            <th><?=$info['id']?></th>
                            <th><?=$info['first_name']?></th>
                            <th><?=$info['surname']?></th>
                            <th><?=$info['email']?></th>
                            <th><?=$info['phone']?></th>
                            <th><?=$info['order_total']?></th>
                            <th> 
                                <a href="?more=item&id=<?=$info['id']?>" target="blank"> Подробнее</a> 
                            </th>
                            
                            <th style="color:<?=$status->getField('color')?>; background: <?=$status->getField('background')?>"><?=$status->getField('title')?></th>
                            <th><?=date('d-m-Y в H:i',$info['publ_time'])?></th>
                            <?ini_set('date.timezone', 'Europe/Moscow');?>
                            <th><?=$info['last_update'] != 0 ? date('d-m-Y в H:i',$info['last_update']) : 'не просмотрен'?></th>
                        </tr>
                        <?}?>
                </tbody>    
            </table>
        </div> 
        
    <?} elseif (isset($_GET['page']) && $_GET['page'] == 'users') {?>
        <div style="display:flex; justify-content:space-between; padding:10px;">
                <h2>Пользователи</h2>
                <div>
                    <a href="?newuser" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">+ создать</a>
                </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>id</th>
                    <th>Логин</th>
                    <th>E-mail</th>
                    <th>Группа</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $connect = new \Core\ConnectDB();
                        $result = mysqli_query($connect->getConnection(), " SELECT * FROM core_users ");
                        while($info = mysqli_fetch_assoc($result)) {
                            $group = new \Core\UserGroup($info['user_group']);
                    ?>
                        <tr>
                            <th><?=$info['id']?></th>
                            <th>
                                <a href="?change=user&id=<?=$info['id']?>"><?=$info['user_login']?>
                                </a>
                            </th>
                            <th>
                                <a href="mailto:<?=$info['user_email']?>">
                                    <?=$info['user_email']?>
                                </a>
                            </th>
                            <th><?=$group->getField('title')?></th>
                                                    
                        </tr>
                    <?}?>
                </tbody>
            </table>
        </div> 
    <?}else{?>
    <?}?>
      
    </main>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script></body>

</body>
</html>