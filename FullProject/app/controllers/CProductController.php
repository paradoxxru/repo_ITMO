<?php
namespace app\controllers;

//require_once('../app/controllers/IPageController.php');
class CProductController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// TODO: Implement setPermissions() method.
	}
	public function render($pdo) { //формирование страницы
		//нужно подключить класс запросов, выполнить запрос и получить массив-ответ
		$request = new \app\request\CRequestGoods($pdo);
		//получаем массив всех товаров
		$arr_goods = $request->getArray();

		//определить раздел куда вводить
		$path_to_template = "../app/views/product.php";
		include($path_to_template); // и уже внутри product.php определять по id какой товар выводить

		
		// отобразить товар в разделе "Товар" (как скрыть при этом раздел "Каталог"? его просто не будет в шаблоне страницы?)
	}
}

?>