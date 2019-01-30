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
        
    </div>
    <?php
        // echo "<pre>";
        // echo "массив GET: ";echo "<br>";
        // var_dump($_GET);
        // echo "</pre>";
        // echo "<pre>";
        // echo "массив SESSION: ";echo "<br>";
        // var_dump($_SESSION);
        // echo "</pre>";
        ?>
    <h1>Результат сортировки по ...<?php echo $_GET['actionsort']." by ".$_GET['sort_field']; ?></h1>
    <div class="sortby">
        <?php
            foreach ($new_goods as $id => $item) {
                $product = new CFruitProduct();//new CFruitProduct($id); //создаем
                $product->fromArray($item); //заполняем значениями
                $product->render('sortby_page'); //выводим
            }
        ?>
    </div>
</section>
<?php //<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
//<script src="assets/js/eshop.js"></script>
?>
</body>
</html>