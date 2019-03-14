<?php
namespace app\controllers;

class CCatalogController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		
	}
	public function render($pdo) { //формирование страницы
		//нужно подключить класс запросов, выполнить запрос и получить массив-ответ
		$request = new \app\request\CRequestGoods($pdo);
		//получаем массив всех товаров
		$arr_goods = $request->getArray();
		// echo "<pre>";
  //       echo "массив goods: ";echo "<br>";
  //       var_dump($arr_goods);
  //       echo "</pre>";
		//далее подключить страницу, на который будет вывод
		$path_to_template = "../app/views/catalog.php";
		include($path_to_template);
	}
}