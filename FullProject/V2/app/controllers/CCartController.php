<?php
namespace app\controllers;

//require_once('../app/controllers/IPageController.php');
class CCartController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// TODO: Implement setPermissions() method.
	}
	public function render($pdo) { //формирование страницы
		// $parser = \app\dataio\CConfParser::getInstance('../app/config/db_product.yaml'); //создает объект нужного класса
		// $parser->read(); //читаем из файла
		// //получаем все товары в виде массива
		// $goods = $parser->getAllParams();

		//нужно подключить класс запросов, выполнить запрос и получить массив-ответ(пока нужен в секции фильтрации)
		$request = new \app\request\CRequestGoods($pdo);
		//получаем массив всех товаров
		$arr_goods = $request->getArray();
		// echo "полный ммссив товаров: <br>";
		// echo "<pre>";
		// var_dump($arr_goods);
		// echo "</pre>";

		$path_to_template = "../app/views/cart.php"; //определили куда выводить
		include($path_to_template); // выводим
	}
}