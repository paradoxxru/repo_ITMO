<?php

require_once('../app/controllers/IPageController.php');
require_once('../app/dataio/CConfParser.php');
require_once('../app/product/CFruitProduct.php');
class CCatalogController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// TODO: Implement setPermissions() method.
	}
	public function render() { //формирование страницы
		
		// if(isset($_GET['action'])) {

		// }
		//из конфигурац файла считываем инфу
		$parser = CConfParser::getInstance('../app/config/db_product.yaml'); //создает объект нужного класса
		$parser->read(); //читаем из файла в массив

		//$product = $parser->getParam(0); //берем первый элемент из массива
		//var_dump($product);
		// $product = new CFruitProduct(1);
		// $product->fromArray($parser->getParam(0));
		// $product->render('catalog');

		// Из конфига получаем все товары в виде массива
		$goods = $parser->getAllParams();
		$path_to_template = "../app/views/catalog.php";
		include($path_to_template);
		// превращаем массив параметров в массив объектов(CFruitProduct)
		
		//перенесем нижний код в catalog.php(C:\www\dev\PHPwork\lessonsPHP-master\app\views)
		// foreach ($goods as $id => $item) {
		// 	$product = new CFruitProduct($id); //создаем
		// 	$product->fromArray($item); //заполняем значениями
		// 	$product->render('catalog'); //выводим
		// }

	}
}