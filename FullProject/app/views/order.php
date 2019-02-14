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
        //require_once ("../app/user.php"); // видимо нужно перенести в самое начало документа
        $user = new User(); //создаем, проверяем залогинен ли, записываем инфу в поля объекта
        if(isset($_GET['logout'])) //если нажали выход, то logout
            $user->logout();

        //require_once ("../app/dataio/CUserCart.php");
        $userCart = new CUserCart($user->getLogin());//создаем объект-корзину, определяя для какого пользователя
        //(аноним или нет) и читаем из файла корзины в массив корзины + собираем инфу о полной стоимости и кол-ву
        
        //запускаем мотод обработки экшинов
        //$userCart->actionsWithCart($goods); //здесь не нужен???
        //считаем кол-во, сумму и вес
        $userCart->calcSummaryInfo();
        
        //require_once ("../app/dataio/CUserOrder.php");
        $order = new CUserOrder($user->getLogin()); //создаем объект заказа
        
        echo "<pre>";
        echo "массив POST: ";echo "<br>";
        var_dump($_POST);
        echo "</pre>";
    ?>
    <div class="filter">
        <p>По категории</p>
        <ul class="filter__categories">
        <?php
            //подключить файл CListByCategory
            //require_once('../app/dataio/CListsBy.php');
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
        <a
            href="/index.php?q=cart"
            id="Cart"
            data-action="open-cart">Корзина
            <?php 
            echo "( ".$userCart->getCol()." шт. На сумму: ".$userCart->getSum()." )";
            ?>
        </a>
        <?php  
            if($user->isAuth()) {
                $str = $user->getName();
                echo "<a href='/index.php?q=cabinet' id='UserCabinet'>".$str."</a>";
            }
            else {
                echo "<a href='/index.php?q=entrance' id='UserLogin' data-action=''>Вход</a>";
            }
        ?>
        
        <?php
            if($user->isAuth())
                echo "<a href='/index.php?q=catalog&logout=1' style='padding-left:20px;'>Выход</a>";
        ?>
    </div>
    <h1>Ваш заказ, <span><?php echo $user->getName(); ;?></span> </h1>
    <?php
        $ourOrder = $order->getOrder();
    ?>
    <div class="order">
        <table class="order__table">
            <th>Название</th><th>Характеристики</th><th>Цена</th><th>Кол-во</th><th>Стоимость</th>
            <?php 
                foreach ($goods as $i => $item) {
                    if( isset($ourOrder) ) {
                        foreach ($ourOrder as $key => $value) {
                            if($value['id'] == $item['id']) {
                                echo "<tr>
                                        <td>".$item['name']."</td>
                                        <td>Вес: ".$item['weight']." кг. Популярность: ".$item['vogue']."</td>
                                        <td>".$item['cost']."</td>
                                        <td>".$value['count']."</td>
                                        <td>".$value['count'] * $item['cost']."</td>
                                    </tr>";
                            }
                        }
                    }
                }
                echo "<th></th><th></th><th>Всего:</th><th>Вес:</th><th>Общая сумма:</th>";
                echo "<tr>
                        <td style='border:none'></td><td style='border:none'></td>
                        <td>".$userCart->getCol()." шт.</td>
                        <td>".$userCart->getWeight()." кг.</td>
                        <td>".$userCart->getSum()." руб.</td>
                    <tr>";
            ?>
        </table>
        <?php
            if(empty($_POST['d'])) {
                echo
                '<div class="editOrder">
                        <a href="/index.php?q=cart">Редактировать</a>
                </div>
                <div class="delivery">
                    <div>
                        <h5>Информация о доставке:</h5>
                        <p>Самовывоз осуществляется по адресу: СПб, 3-я ул.Строителей, д.5</p>
                        <p>Доставка осуществляется через 1-3 рабочих дня после оплаты</p>
                    </div>
                    <h5>Выберите способ доставки:</h5>
                    <form class="formOreder" method="post" action="/index.php?q=order">
                        <div>
                            <label for="IDdelivery">Доставка</label>
                            <input id="IDdelivery" type="radio" name="d" value="delivery">
                            <label for="IDadder">Укажите адрес доставки</label>
                            <input id="IDadder" type="text" name="addr">
                        </div>
                        <div>
                            <label for="IDpickup">Самовывоз</label>
                            <input id="IDpickup" type="radio" name="d" value="pickup" checked>
                        </div>
                        <div class="confirmOrder">    
                            <button>Подтвердить</button>
                        </div>
                    </form>
                </div>';
            } else {
                echo "<div>
                        <h3>Ваш заказ № принят</h3>
                    </div>";
            }
            //сформировать номер заказа
            //создать файл заказа, в него
               //записать в файл и в переменную адрес доставки(самовывоз)
            if(isset($_POST['d'])) {
                $order->setAddrDelivery();
            }
            echo "numberOrder = ".$order->genNumberOrder();
            $order->readYAML();
            // $mass = $order->getArrYaml();
            // echo "массив yaml:<br>";
            // echo "<pre>";
            // var_dump($mass);
            // echo "</pre>";
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
</section>
<?php //<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
//<script src="assets/js/eshop.js"></script>
?>
</body>
</html>