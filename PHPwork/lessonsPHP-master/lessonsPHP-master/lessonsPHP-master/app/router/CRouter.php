<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 17.01.2019
 * Time: 21:49
 */

require_once ("../app/controllers/CCartController.php");
require_once ("../app/controllers/CCatalogController.php");
require_once ("../app/controllers/CProductController.php");

class CRouter
{
    public static function getController() {
        $params = $_GET;
        $routes = [
            'catalog' => "CCatalogController",
            'cart' => "CCartController",
            'product' => "CProductController"
        ];
        if(isset($params['q']) && isset($routes[$params['q']])) {
            $controller = new $routes[$params['q']]();
        } else {
            $controller = new $routes['catalog']();
        }
        return $controller;
    }
}