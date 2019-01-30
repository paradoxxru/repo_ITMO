<?php
// require_once('../app/dataio/CConfParser.php');	// не нужно ли подключить???????????
// require_once('../app/product/CFruitProduct.php');
require_once('../app/controllers/IPageController.php');
class CProductController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// TODO: Implement setPermissions() method.
	}
	public function render() { //формирование страницы
		// TODO: Implement render() method.

		//сформировать массив товаров
		$parser = CConfParser::getInstance('../app/config/db_product.yaml'); //создает объект нужного класса
		$parser->read(); //читаем из файла в массив
		$goods = $parser->getAllParams();

		//определить раздел куда вводить
		$path_to_template = "../app/views/product.php";
		include($path_to_template); // и уже внутри product.php определять по id какой товар выводить

		
		// отобразить товар в разделе "Товар" (как скрыть при этом раздел "Каталог"? его просто не будет в шаблоне страницы?)
	}
}

?>