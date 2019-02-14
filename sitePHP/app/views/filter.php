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
    <?php
        require_once ("../app/user.php"); // видимо нужно перенести в самое начало документа
        $user = new User(); //создаем, проверяем залогинен ли, записываем инфу в поля объекта
        if(isset($_GET['logout'])) //если нажали выход, то logout
            $user->logout();

        require_once ("../app/dataio/CUserCart.php");
        $userCart = new CUserCart($user->getLogin());//создаем объект-корзину, определяя для какого пользователя
        //(аноним или нет) и читаем из файла корзины в массив корзины + собираем инфу о полной стоимости и кол-ву
        //запцскаем мотод обработки экшинов
        $userCart->actionsWithCart($goods);
        //считаем кол-во, сумму и вес
        $userCart->calcSummaryInfo();
        
        // echo "путь до файла: ";echo "<br>";
        // echo $userCart->getPath();echo "<br>";
        // echo "массив корзины в файле catalog.php: ";echo "<br>";
        // echo "<pre>";
        // var_dump($userCart->getArrCart());
        // echo "</pre>";
        
    ?>
    <div class="filter">
        <p>По категории</p>
        <ul class="filter__categories">
        <?php
            //подключить файл CListByCategory
            require_once('../app/dataio/CListsBy.php');
            //вызвать getListCategory($goods)
            CListsBy::getListCategory($goods);
            //подключить шаблон вывода списка по категориям
            $path_to_template = "../app/views/lists/list_by_category.php"; //определили куда выводить
            include($path_to_template); // выводим
        ?>
        </ul>
        <p>По стоимости</p>
        <?php
            CListsBy::getListCost($goods);
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
        <?php //require_once('../app/dataio/CInfoSession.php') ;
                  //  CInfoSession::setInfoSession();
                  //  CInfoSession::getInfoSession($goods);
        ?>
        <a
            href="/index.php?q=cart"
            id="Cart"
            data-action="open-cart">Корзина
            <?php 
            //echo "( ". CInfoSession::$col." шт. На сумму: ".CInfoSession::$sum." )";
            echo "( ".$userCart->getCol()." шт. На сумму: ".$userCart->getSum()." )";
            ?>
        </a>
        <?php
            // require_once ("../app/user.php");
            // $user = new User(); //создаем, проверяем залогинен ли, записываем инфу в поля объекта
            
            // if(isset($_GET['logout'])) 
            //     $user->logout();
        ?>
        <?php  
            if($user->isAuth()) {
                $str = $user->getName();
                echo "<a href='/index.php?q=cabinet' id='UserCabinet'>".$str."</a>";
            }
            else {
                //$str = 'Вход';
                echo "<a href='/index.php?q=entrance' id='UserLogin' data-action=''>Вход</a>";
            }
        ?>
        <!--
        <a
            href="/index.php?q=entrance"
            id="UserLogin"
            data-action=""><?php //echo $str;?>
        </a>
        -->
        <?php
            if($user->isAuth())
                echo "<a href='/index.php?q=catalog&logout=1' style='padding-left:20px;'>Выход</a>";
        ?>
    </div>
    <div class="catalog">
       
    </div>
    <div class="cart">
        
    </div>
    <div class="goods">
        
    </div>
    <div class="sortby">
        
    </div>
    </div>
    <h1>Фильтр по : '<?php echo $_GET['datafilter'];?>'</h1>
    <div class="filterby">
        <?php
            //из массива new_goods вывести товары
            foreach ($new_goods as $key => $item) {
                //if(isset($_GET['actionfilter']) && ($_GET['actionfilter'] === 'filter_category')) {
                    //if(isset($_GET['datacategory'])) {
                        //if($item['category'] == $_GET['datacategory']) {
                            $product = new CFruitProduct();//new CFruitProduct($id); //создаем
                            $product->fromArray($item); //заполняем значениями
                            $product->render('filter_page'); //выводим
                        //}
                    //}
                //}
            }
        ?>
    </div>
</section>
<?php //<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
//<script src="assets/js/eshop.js"></script>
?>
</body>
</html>