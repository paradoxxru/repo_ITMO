<?php
require_once('../app/controllers/IPageController.php');
class CCartController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// TODO: Implement setPermissions() method.
	}
	public function render() { //формирование страницы
		// TODO: Implement render() method.
		$parser = CConfParser::getInstance('../app/config/db_product.yaml'); //создает объект нужного класса
		$parser->read(); //читаем из файла
		//получаем все товары в виде массива
		$goods = $parser->getAllParams();

		$path_to_template = "../app/views/cart.php"; //определили куда выводить
		include($path_to_template); // выводим
	}
}

?>