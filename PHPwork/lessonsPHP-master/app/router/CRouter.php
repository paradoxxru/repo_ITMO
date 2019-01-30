<?php

require_once("../app/controllers/CCartController.php");
require_once("../app/controllers/CCatalogController.php");
require_once("../app/controllers/CProductController.php");
class CRouter
{
	public static function getController() {
		$params = $_GET; //
		$routes = [
			'catalog' =>"CCatalogController",
			'cart' => "CCartController",
			'product' => "CProductController"
		];
		//$view; //будем сохранять шаблон
		if(isset($params['q']) && isset($routes[$params['q']])) {
		    $controller = new $routes[$params['q']]();
		} else {
		    $controller = new $routes['catalog'](); // !!! теперь так можно .
		    										// тоже что и $ob = new CCatalogController();
		}
		return $controller;
	}
}
?>