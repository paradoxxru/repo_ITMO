<?php
namespace app\controllers;

//require_once('../app/controllers/IPageController.php');
class COrderController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// 
	}
	public function render($pdo) {
		//нужно подключить класс запросов, выполнить запрос и получить массив-ответ
		$request = new \app\request\CRequestGoods($pdo);
		//получаем массив всех товаров
		$arr_goods = $request->getArray();

		$path_to_template = "../app/views/order.php";
		include($path_to_template);
	}
}