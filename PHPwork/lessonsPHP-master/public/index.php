<?php
 /* // Авторизация и регистрация
// Включить буфферизацию вывода
ob_start();
ini_set('output_buffering', 'On');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
setcookie('login');
require_once "examples/15.registration.php";

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

if(isset($_SESSION['counter']))  $_SESSION['counter']++;
else $_SESSION['counter'] = 1;
echo "<p>Вы открывали эту страницу {$_SESSION['counter']} раз</p>";
echo "<pre>";
echo "SESSION:\n";
print_r($_SESSION);
echo "COOKIE:\n";
print_r($_COOKIE);
echo "POST:\n";
print_r($_POST);
echo "</pre>";
*/
session_start();
//ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


/*
$goods = [];
for ($i =0; $i<100; $i++)
    $goods[] = FactoryProduct::getProduct();
foreach ($goods as $k => $product) {
    $product->render();
}
//$pr1 = FactoryProduct::getProduct();
//$pr2 = FactoryProduct::getProduct();
//$pr3 = FactoryProduct::getProduct();
//$pr4 = FactoryProduct::getProduct();
//echo $pr1->category;
/**//*
echo "<pre>";
//var_dump($cnt);
var_dump($pr1);
var_dump($pr2);
var_dump($pr3);
var_dump($pr4);
echo "<pre>";
/*
include("app/user.php");

include("examples/view/login_form.php");

$user = new User();

$login = $_POST['login'];
$pass = md5($_POST['password']);

$user->login($login, $pass);
/*
require_once ("examples/18.rw_params.php");
$parser = CConfParser::getInstance("config.txt");
$parser->read();
echo "<p>" . $parser->param2 . "</p>";
$parser->param4 = "new value";
$parser->param5 = 55555;
$parser->write();
/**/
//require_once ("../app/product/WordGenerator.php");

// название раздела прилетит в GET параметре
//index.php?q=catalog   // lessonsPHP-master/public/index.php?q=catalog
//q=cart
//q=product

// 1) аутинтификация: получить текущего пользователя со всеми его правами доступа
require_once('../app/user.php');
$user = new User();

// 2) роутинг: определить какую страницу ему показать
// для каждый типовой странницы будет свой класс
// $routes = [
// 'catalog' =>"../app/views/catalog.php",
// 'cart' => "../app/views/cart.php",
// 'product' => "../app/views/product.php"
// ];
// $view; //будем сохранять шаблон
// if(isset($_GET['q']) && isset($routes[$_GET['q']])) {
//     $view = $routes[$_GET['q']];
// } else {
//     $view = $routes['catalog'];
// }
require_once("../app/router/CRouter.php");
$controller = CRouter::getController();
//var_dump($controller);


// 3) сформировать запрашиваемую страницу и отправить в браузер пользователю
//require_once('../app/views/catalog.php'); //пока вывели для примера
//require_once ($view);
$controller->setPermissions($user->getAllPermissions());
$controller->render();