<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/eshop.css">
</head>
<body>
    <aside>
        <div class="filter">
            <p>По категории</p>
            <ul class="filter__categories">
            <?php
                //подключить файл CListByCategory
                require_once('../app/dataio/CListsBy.php');
                //вызвать getListCategory($goods) - формируем массив категорий
                CListsBy::getListCategory($goods);
                //подключить шаблон вывода списка по категориям
                $path_to_template = "../app/views/lists/list_by_category.php"; //определили куда выводить
                include($path_to_template); // выводим
            ?>
            </ul>
            <p>По стоимости</p>
            <?php
            CListsBy::getListCost($goods); //считаем кол-во товара до 10000тр и от 10000тр
            ?>
            <ul class="filter__cost">
                <li>
                    <a href="/index.php?q=filter&datafilter=cost&filtertype=less&filtervalue=10000" data-price="less-10000">До 10 000р</a>
                    <span class="badge"><?php echo ClistsBy::$count_cost_less;?></span>
                </li>
                <li>
                    <a href="/index.php?q=filter&datafilter=cost&filtertype=more&filtervalue=10000" data-price="more-10000">От 10 000р</a>
                    <span class="badge"><?php echo ClistsBy::$count_cost_more;?></span>
                </li>
            </ul>
            <p><a href="/index.php?q=catalog">Показать все товары</a></p>
        </div>
    </aside>
    <section class="main">
        <div class="sorting">
            <span>Стомость</span>
            <ul>
                <li>
                    <a id="CostUp" href="/index.php?q=sortby&actionsort=sort_up&sort_field=cost">↑</a>
                </li>
                <li>
                    <a id="CostDown" href="/index.php?q=sortby&actionsort=sort_down&sort_field=cost">↓</a>
                </li>
            </ul>
            <span>Вес</span>
            <ul>
                <li>
                    <a id="WeightUp" href="/index.php?q=sortby&actionsort=sort_up&sort_field=weight">↑</a>
                </li>
                <li>
                    <a id="WeightDown" href="/index.php?q=sortby&actionsort=sort_down&sort_field=weight">↓</a>
                </li>
            </ul>
            <span>Популярность</span>
            <ul>
                <li>
                    <a id="VogueUp" href="/index.php?q=sortby&actionsort=sort_up&sort_field=vogue">↑</a>
                </li>
                <li>
                    <a id="VogueDown" href="/index.php?q=sortby&actionsort=sort_down&sort_field=vogue">↓</a>
                </li>
            </ul>
            <?php require_once('../app/dataio/CInfoSession.php') ;
                    CInfoSession::setInfoSession();
                    CInfoSession::getInfoSession($goods);
            ?>
            <a
                href="/index.php?q=cart"
                id="Cart"
                data-action="open-cart">Корзина
                <?php 
                    echo "( ". CInfoSession::$col." шт. На сумму: ".CInfoSession::$sum." )";
                ?>
            </a>
            <?php 
                if(isset($_SESSION['login'])) $str = $_SESSION['login'];
                else $str = 'Вход';
            ?>
            <a
                href="/index.php?q=entrance"
                id="UserLogin"
                data-action="open-cart"><?php echo $str;?>
            </a>
        </div>
        <div class="catalog">
            
        </div>
        <div class="cart">

        </div>
        <div class="goods">
            <h1>Товар подробно</h1>
            <?php
                //найти товар по id - получить id из GET массива и сравнить с id-ми элементов массива
                // этим мы получим запрашиваемый подробно товар
                $id = $_GET['id'];
                //echo "запрашиваемый товар имеет id= ".$id;
       
                //foreach ($goods as $key => $item) {
                foreach($goods as $item) {
                    //if($key == $id) {
                    if($item['id'] == $id) {
                        //создать объект
                        $product = new CFruitProduct();//new CFruitProduct($id); //создаем
                        $product->fromArray($item); //заполняем значениями
                        //определить раздел куда вводить
                        //вывести по шаблону
                        $product->render('product_page'); //определили куда выводить('product_page') и выводим
                    }
                }
            ?>
        </div>
    </section>
    <!--
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/eshop.js"></script>
    -->
</body>
</html>