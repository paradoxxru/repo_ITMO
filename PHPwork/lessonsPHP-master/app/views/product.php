<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.01.2019
 * Time: 22:22
 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/eshop.css">
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
                    <a id="WeightUp" href="#">↑</a>
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
                    href="#"
                    id="Cart"
                    data-action="open-cart">Корзина</a>
        </div>
        <div class="catalog">
            <div class="catalog__item">
                <span class="catalog__item-name">Название товара</span>
                <img class="catalog__item-preview" src="images/im1.svg" alt="">
                <span class="catalog__item-cost">10 000р</span>
            </div>
        </div>
        <div class="cart">

        </div>
        <div class="goods">

        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/eshop.js"></script>
</body>
</html>