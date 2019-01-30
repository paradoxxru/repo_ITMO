<?php
/*
// Авторизация и регистрация
// Включить буфферизацию вывода
ob_start();
ini_set('output_buffering', 'On');

if(!empty($_POST['login'])) {
    if(!login()) {
        echo "<p>Ошибка авторизации: неверный пароль.</p>";
    }
}
if(!empty($_GET['logout'])) {
    logout();
}
if(isLogin()) {
    echo "<h1>Добро пожаловать, " .
        getUserName() .
        '!</h1>' .
        '<p><a href="/?logout=1">Выход</a></p>';
} else {
    printFormLogin();
}
*/
session_start();
//ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
include("examples/view/login_form.php");
$user = new User();
$login = $_POST['login'];
$pass = md5($_POST['password']);
$user->login($login, $pass);
*/


// 1) аутентификация: получить текущего пользователя со всеми правами доступа
require_once ("../app/user.php");
$user = new User();

// 2) роутинг: определить, какую страницу запрашивает пользователь и есть ли у него соответствующие права
// для каждый типовой странницы будет свой класс
// $routes = [
// 'catalog' =>"../app/views/catalog.php",
// 'cart' => "../app/views/cart.php",
// 'product' => "../app/views/product.php"
// ];
// название раздела прилетит в GET параметре
//index.php?q=catalog   // lessonsPHP-master/public/index.php?q=catalog
//q=cart
//q=product
// $view; //будем сохранять шаблон
// if(isset($_GET['q']) && isset($routes[$_GET['q']])) {
//     $view = $routes[$_GET['q']];
// } else {
//     $view = $routes['catalog'];
// }

//unset($_SESSION['cart']);
// unset($_SESSION['login']);
// unset($_SESSION['token']);
require_once ("../app/router/CRouter.php");
$controller = CRouter::getController();

// 3) сформировать запрашиваемую страницу и отправить в браузер пользователю
$controller->setPermissions($user->getAllPermissions());
$controller->render();
