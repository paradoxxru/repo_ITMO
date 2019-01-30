<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 06.12.2018
 * Time: 13:37
 */
/*
?>
<form method="post" action="index.php">
    <input name="plates" type="text">
    <input name="soap" type="text">
    <button>Помыть!</button>
</form>
<?php
//todo  Array
//todo (
//todo     [plates] =>
//todo     [soap] =>
//todo )
$plates = $_POST['plates'];
$soap = $_POST['soap'];
while($plates > 0 && $soap > 0) {
    $plates--; //todo $plates = $plates - 1;
    $soap -= 0.5;//todo $soap = $soap - 0.5;
    echo "Осталось " . $plates .
        " тарелок и " . $soap . " моющего средства." .
        "<br/>";
}
if($plates > 0)
    echo "Осталось " . $plates . " тарелок.";
if($soap > 0)
    echo "Осталось " . $soap . " моющего средства.";

// echo "<pre>" . print_r($_POST, true) . "</pre>";
*/
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once "examples/14.include_function.php";
echo "<pre>",
    'ot: ', $our_test, PHP_EOL,
    'oT: ', $our_tesT, PHP_EOL,
//    'OT: ', OUR_TEST, PHP_EOL,
//    'gCD: ', getCurrentDir(), PHP_EOL,
//    'gRP: ', getRealPath(), PHP_EOL,
'';
//getScriptInfo();
    echo "</pre>";
    echo "==================";
include_once "examples/14.include_function.php";
echo "<pre>",
'ot: ', $our_test, PHP_EOL,
'oT: ', $our_tesT, PHP_EOL,
//'OT: ', OUR_TEST, PHP_EOL,
//'gCD: ', getCurrentDir(), PHP_EOL,
//'gRP: ', getRealPath(), PHP_EOL,
'';
//getScriptInfo();
echo "</pre>";
echo "before include";
include "examples/14.include_function11.php";
echo "after include & before require";
require "examples/14.include_function11.php";
echo "after require";
*/

/*
 * // Авторизация и регистрация
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

//require_once('./examples/17.ProductFabrica.php');
//require_once('./examples/16.product.class.php');
/*
$pr1 = new Product("Яблоко");
$pr2 = new Product("Груша");
$pr3 = new ProductCar("2105");
$pr4 = new ProductPC("Notebook-1");

//echo $pr3 . "<br/>";
/**/
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
//index.php?q=catalog
//    q=cart
//    q=product

// todo аутентификация: получить текущего пользователя со всеми правами доступа
require_once ("../app/user.php");
$user = new User();

// todo роутинг: определить, какую страницу запрашивает пользователь и есть ли у него соответствующие права
require_once ("../app/router/CRouter.php");
$controoler = CRouter::getController();

// todo сформировать запрашиваемую страницу

