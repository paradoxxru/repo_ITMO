<?php
namespace app\controllers;

//require_once('../app/controllers/IPageController.php');
//require_once('../app/dataio/CConfParser.php');		
//require_once('../app/product/CFruitProduct.php'); 

class CCatalogController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		
	}
	public function render() { //формирование страницы
		//из конфигурац файла считываем инфу
		$parser = \app\dataio\CConfParser::getInstance('../app/config/db_product.yaml'); //создает объект нужного класса
		$parser->read(); //читаем из файла во внутренний массив($params)

		//$product = $parser->getParam(0); //берем первый элемент из массива
		//var_dump($product);
		// $product = new CFruitProduct(1);
		// $product->fromArray($parser->getParam(0));
		// $product->render('catalog');

		// Из конфига получаем все товары в виде массива
		$goods = $parser->getAllParams();
		// echo "<pre>";
  //       echo "массив goods: ";echo "<br>";
  //       var_dump($goods);
  //       echo "</pre>";

		//парсер для файла корзины
		// $parser_for_cart = CConfParser::getInstance('../app/config/cart.yaml');
		// $parser_for_cart->read();
		// //массив корзины
		// $arr_cart = $parser_for_cart->getAllParams();
		// echo "<pre>";
  //       echo "массив arr_cart: ";echo "<br>";
  //       var_dump($arr_cart);
  //       echo "</pre>";

		$path_to_template = "../app/views/catalog.php";
		include($path_to_template);
	}
}