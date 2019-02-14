<?php
namespace app\router;

//require_once("../app/controllers/CCartController.php");//класс, отвечающий за формирования страницы с корзиной
//require_once("../app/controllers/CCatalogController.php");//класс, отвечающий за формирование страницы каталога
//require_once("../app/controllers/CProductController.php");//класс, отвечающий за формирование страницы конкретного товара
//require_once("../app/controllers/CSortController.php");
//require_once("../app/controllers/CFilterController.php");
//require_once("../app/controllers/CEntranceController.php");
//require_once("../app/controllers/COrderController.php");

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
		// название раздела прилетит в GET параметре
		//index.php?q=catalog
		//q=cart
		//q=product
		// echo "routees ";
		// echo $routes[$params['q']];
		if(isset($params['q']) && isset($routes[$params['q']])) {
		    echo "if <br>";
		    echo "<pre>";
		    var_dump($params);
		    var_dump($routes);
		    echo "</pre>";
		    $controller = new \app\controllers\$routes[$params['q']]();
		} else {
			//если не задан параметр q , то считаем дефолтной страницу каталога
			echo "else <br>";
			echo "<pre>";
		    //var_dump($params);
		    var_dump($routes);
		    echo "</pre>";
		    $controller = new \app\controllers\$routes['catalog'](); // !!! теперь так можно .
		    										// тоже что и $ob = new CCatalogController();
		    //$controller = new \app\controllers\CCatalogController();
		}
		return $controller;
	}
}