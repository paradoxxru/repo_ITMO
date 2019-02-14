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
        // if(isset($_GET['logout'])) //если нажали выход, то logout
        //     $user->logout();
#вставляем
            if (!empty($_POST['login']) ) {
                if(!strpos($_POST['login'],':') ) {//проверяем чтобы логин не содержал двоеточия
                    $login = $_POST['login'];
                    $pass = md5($_POST['password']);
                    if(isset($_POST['name']) && isset($_POST['mail']) ) { //если значения name и mail в POST переданы(то есть была выбрана регистрация и заполнены поля), то регистрация
                        if(!strpos($_POST['name'],':') && !strpos($_POST['mail'],':')) {//проверяем чтобы не содержали двоеточия 
                            $otherParams = [];
                            $otherParams['name'] = $_POST['name'];
                            $otherParams['mail'] = $_POST['mail'];
                            //регистрация
                            $user->registerUser($login, $pass, $otherParams);
                        } else
                            print("<script language=javascript>window.alert('недопустимые данные ввода');</script>");
                    }
                    else   //если name и mail не введены значит пытаемся авторизоваться 
                        $user->login($login, $pass);
                }
                else {//если логин содержит двоеточие
                    print("<script language=javascript>window.alert('недопустимые данные ввода');</script>");
                }
            }
            if (!empty($_GET['logout'])) { //если нажали на выход - установилось значение logout=1(см.ниже)
                                          // следовательно проверяем если значение в $_GET['logout'] есть, то
                $user->logout(); // то выходим
            }

#конец вставки
        require_once ("../app/dataio/CUserCart.php");
        $userCart = new CUserCart($user->getLogin());//создаем объект-корзину, определяя для какого пользователя
        //(аноним или нет) и читаем из файла корзины в массив корзины + собираем инфу о полной стоимости и кол-ву
        //запцскаем мотод обработки экшинов
        $userCart->actionsWithCart($goods);
        //считаем кол-во, сумму и вес
        $userCart->calcSummaryInfo();
        
    ?>
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
                //$str = 'Вход';
                echo "<a href='/index.php?q=entrance' id='UserLogin' data-action=''>Вход</a>";
            }
        ?>
        <?php 
            if($user->isAuth())
                echo "<a href='/index.php?q=entrance&logout=1' style='padding-left:20px;'>Выход</a>";
        ?>
    </div>
    <!--
    <div class="catalog">
    </div>
    <div class="cart">
    </div>
    <div class="goods">
    </div>
    <div class="sortby">
    </div>
    -->
    <div class="entrance">
        <?php
        // ниже в input-ах pattern=/^[^:]+$/ - это регулярное выражение чтобы пользователь не ввел двоеточие(:)
        //пока не рабботает...
        if(!$user->isAuth()) {
            echo "
                <form class='formLogin' method='post' action='/index.php?q=entrance'>
                    <div class='input-fields'>    
                        <div>
                            <label for='Login'>Логин</label>
                            <input id='Login' name='login' placeholder='Ведите логин' required>
                        </div>
                        <div>
                            <label for='Password'>Пароль</label>
                            <input id='Password' name='password' type='password' placeholder='Ведите пароль' required>
                        </div>";
            if(isset($_GET['registration'])) {
                if($_GET['registration'] == 1) {
                    $str_in = 'Регистрация';
                    echo "
                        <div>
                            <label for='Name'>Имя</label>
                            <input id='Name' name='name' placeholder='Ведите Имя' required>
                        </div>
                        <div>
                            <label for='Mail'>Почта</label>
                            <input id='Mail' type='email' name='mail' placeholder='Ведите почту' required>
                        </div>";
                }
            } else $str_in = 'Войти';
            echo "     
                    </div>
                    <div class='action-button'>    
                        <button>".$str_in."</button>
                    </div>
                </form>";
            if(!isset($_GET['registration'])) {
                echo "
                <div>
                    <a href='/index.php?q=entrance&registration=1'>Зарегистрироваться</a>
                </div>";
            }
        } else {
            echo "<div class='entrance_message'>
                    <h3>Вы вошли как ".$user->getName()."</h3>
                    <h4>Приятных покупок</h4>
                    <a href='/index.php'>Начать покупки</a>
                </div>";
        }        //
            

            // echo "<pre>";
            // echo "массив GET: ";echo "<br>";
            // var_dump($_GET);
            // echo "</pre>";
            // echo "<pre>";
            // echo "массив POST: ";echo "<br>";
            // var_dump($_POST);
            // echo "</pre>";
            // echo "<pre>";
            // echo "массив SESSION: ";echo "<br>";
            // var_dump($_SESSION);
            // echo "</pre>";
        ?>
    </div>
</section>
<?php //<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
//<script src="assets/js/eshop.js"></script>
?>
</body>
</html>