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
            require_once ("../app/user.php");
            $user = new User();
            if (!empty($_POST['login'])) { 
                $login = $_POST['login'];
                $pass = md5($_POST['password']);
                if (!$user->login($login, $pass)) { // пытаемся авторизовать и затем проверяем получилось ли
                    echo "<p>Ошибка авторизации: неверный пароль.</p>";
                }
            }
            if (!empty($_GET['logout'])) //если нажали на выход - установилось значение logout=1(см.ниже)
                                    // следовательно проверяем если значение в $_GET['logout'] есть, то
                logOut(); // то выходим


            // if(isset($_SESSION['login']) )// || isset($_POST['login']) )
            //     $str = $_SESSION['login'];
            // else 
            //     $str = 'Вход';
            if($user->isAuth())
                $str = $user->getLogin();
            else
                $str = 'Вход';
        ?>
        <a
            href="/index.php?q=entrance"
            id="UserLogin"
            data-action=""><?php echo $str;?>
        </a>
        <?php //если залогинен, то выводим ссылку на выход
            // if(isset($_SESSION['login'])) {
            //     if($user->isLogin())
            //         echo "<a href='/index.php?q=entrance&logout=1'>Выход</a>";
            // }
            if($user->isAuth())
                echo "<a href='/index.php?q=entrance&logout=1'>Выход</a>";
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
            echo "
                <form method='post' action='/index.php?q=entrance'>
                    <div>
                        <label for='Login'>Логин</label>
                        <input id='Login' name='login' placeholder='Ведите логин'>
                    </div>
                    <div>
                        <label for='Password'>Пароль</label>
                        <input id='Password' name='password' type='password' placeholder='Ведите пароль'>
                    </div>
                    <button>Войти</button>
                </form>
            ";
            // if (!empty($_POST['login'])) { 
            //     $login = $_POST['login'];
            //     $pass = md5($_POST['password']);
            //     if (!$user->login($login, $pass)) { // пытаемся авторизовать и затем проверяем получилось ли
            //         echo "<p>Ошибка авторизации: неверный пароль.</p>";
            //     }
            // }
            // // if (!empty($_GET['logout'])) //если нажали на выход - установилось значение logout=1(см.ниже)
            // //                         // следовательно проверяем если значение в $_GET['logout'] есть, то
            // //     logOut(); // то выходим

            echo "<pre>";
            echo "массив GET: ";echo "<br>";
            var_dump($_GET);
            echo "</pre>";
            echo "<pre>";
            echo "массив POST: ";echo "<br>";
            var_dump($_POST);
            echo "</pre>";
            echo "<pre>";
            echo "массив SESSION: ";echo "<br>";
            var_dump($_SESSION);
            echo "</pre>";
        ?>
    </div>
</section>
<?php //<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
//<script src="assets/js/eshop.js"></script>
?>
</body>
</html>