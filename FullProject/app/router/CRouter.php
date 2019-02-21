<?php
namespace app\router;

// класс для определения по строке запроса, какой раздел сайта необходимо отобразить
class CRouter
{
	public static function getController() {
		$params = $_GET; //
		$routes = [
			'catalog' =>"CCatalogController",
			'cart' => "CCartController",
			'product' => "CProductController",
			'sortby' => "CSortController",
			'filter' => "CFilterController",
			'entrance' => "CEntranceController",
			'order' => "COrderController"
		];
		
		if(isset($params['q']) && isset($routes[$params['q']])) {
		    // echo "if <br>";
		    // echo "<pre>";
		    // var_dump($params);
		    // var_dump($routes);
		    // echo "</pre>";
		    $route = '\\app\\controllers\\'. $routes[$params['q']];
		    $controller = new $route();//$routes[$params['q']]();
		} else {
			//если не задан параметр q , то считаем дефолтной страницу каталога
			// echo "else <br>";
			// echo "<pre>";
		 //    //var_dump($params);
		 //    var_dump($routes);
		 //    echo "</pre>";
		    $route = '\\app\\controllers\\'. $routes['catalog'];
		    $controller = new $route(); // тоже что и $ob = new CCatalogController();
		}
		return $controller;
	}
}