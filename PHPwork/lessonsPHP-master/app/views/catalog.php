<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.01.2019
 * Time: 22:21
 */
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
            <!-- Шаблон вывод фильтра по категориям -->
            <li><a href="#" data-category="Категория 1">Категория 1</a> <span class="badge">20</span></li>
            <li><a href="#" data-category="Категория 2">Категория 2</a> <span class="badge">12</span></li>
            <li><a href="#" data-category="...">...</a> <span class="badge">32</span></li>
            <li><a href="#" data-category="Категория N">Категория N</a> <span class="badge">21</span></li>
        </ul>
        <p>По стоимости</p>
        <ul class="filter__cost">
            <li><a href="#" data-price="less-10000">До 10 000р</a> <span class="badge">11</span></li>
            <li><a href="#" data-price="more-10000">От 10 000р</a> <span class="badge">9</span></li>
        </ul>
        <p><a href="#" data-action="filter" data-type="greater" data-filter="cost" data-value="-1">Показать все товары</a></p>
    </div>
</aside>
<section class="main">
    <div class="sorting">
        <span>Стомость</span>
        <ul>
            <li>
                <a id="CostUp" href="#">↑</a>
            </li>
            <li>
                <a id="CostDown" href="#">↓</a>
            </li>
        </ul>
        <span>Вес</span>
        <ul>
            <li>
                <a id="WeightUp" href="//lessonsPHP-master/public/index.php?q=catalog&action=sort_up&sort_fieid=wieght">↑</a>
            </li>
            <li>
                <a id="WeightDown" href="#">↓</a>
            </li>
        </ul>
        <span>Популярность</span>
        <ul>
            <li>
                <a id="VogueUp" href="#">↑</a>
            </li>
            <li>
                <a id="VogueDown" href="#">↓</a>
            </li>
        </ul>
        <a
            href="/lessonsPHP-master/public/index.php?q=cart"
            id="Cart"
            data-action="open-cart">Корзина</a>
        <a
            href="#"
            id="Login"
            data-action="open-cart">Вход</a>
    </div>
    <h1>Каталог</h1>
    <div class="catalog">
        <!--<div class="catalog__item">-->
           <!-- <span class="catalog__item-name">Название товара</span>
            <img class="catalog__item-preview" src="assets/images/im1.svg" alt="">
            <span class="catalog__item-cost">10 000р</span>
            <a href="/lessonsPHP-master/public/index.php?q=product">Подробнее</a> -->
        <?php
        foreach ($goods as $id => $item) {
            if(isset($_GET['action']) 
                && $_GET['action']==='filter'
                && $_GET['field']==='weight'
            ) {
                if($item['weight'] != $_GET['value']) continue;
            }
            $product = new CFruitProduct($id); //создаем
            $product->fromArray($item); //заполняем значениями
            $product->render('catalog'); //выводим
        }
        ?>
        <!--</div>-->
    </div>
    <div class="cart">
        <h1>Корзина</h1>
    </div>
    <div class="goods">
        <h1>Товар</h1>
    </div>
</section>
<?php //<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
//<script src="assets/js/eshop.js"></script>
?>
</body>
</html>