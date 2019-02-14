<?php
namespace app\controllers;

//require_once('../app/controllers/IPageController.php');

class CEntranceController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// TODO: Implement setPermissions() method.
	}
	public function render() { //формирование страницы

		$parser = \app\dataio\CConfParser::getInstance('../app/config/db_product.yaml'); //создает объект нужного класса
		$parser->read(); //читаем из файла в массив
		// Из конфига получаем все товары в виде массива
		//( он нужен для формирования информации на странице entrance.php)
		$goods = $parser->getAllParams();
	
		$path_to_template = "../app/views/entrance.php";
		include($path_to_template);
		
	}
}