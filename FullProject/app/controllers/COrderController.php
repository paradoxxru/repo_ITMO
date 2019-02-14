<?php
namespace app\controllers;

//require_once('../app/controllers/IPageController.php');
class COrderController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// 
	}
	public function render() {
		$parser = \app\dataio\CConfParser::getInstance('../app/config/db_product.yaml'); //создает объект нужного класса
		$parser->read();
		$goods = $parser->getAllParams();

		$path_to_template = "../app/views/order.php";
		include($path_to_template);
	}
}