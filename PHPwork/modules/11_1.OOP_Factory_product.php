<?php
						// Лекция 11
			// ООП
// $pr3 = new ProductCar('2105');
// echo "<pre>";
// var_dump($pr3);
// echo "</pre>";
// $pr4 = new ProductPC('pentium4');
// echo "<pre>";
// var_dump($pr4);
// echo "</pre>";

require_once('factory_product.php'); // а в этом файле мы подключаем classes.php
$pr1 = FactoryProduct::getProduct(); //обращаемся к методу класса без создания объекта
$pr2 = FactoryProduct::getProduct();
$pr3 = FactoryProduct::getProduct();
$pr4 = FactoryProduct::getProduct();

echo "<pre>";
var_dump($pr1);
var_dump($pr2);
var_dump($pr3);
var_dump($pr4);
echo "</pre>";