<?php
session_start();
error_reporting(E_ALL);
//избавляемся от всех require_once (подключаем автолоадер)
require_once __DIR__ . '/../vendor/autoload.php'; // __DIR__ - храниться путь от корня системы до текущего файла(тот файл где подключаем автолоадер, у нас index.php)
ini_set('display_errors', 1);
// 1) аутентификация: получить текущего пользователя
//require_once ("../app/user.php");
$user = new \app\User();
// 2) роутинг: определить, какую страницу запрашивает пользователь
//require_once ("../app/router/CRouter.php");
$controller = \app\router\CRouter::getController();
// 3) сформировать запрашиваемую страницу и отправить в браузер пользователю
$controller->setPermissions($user->getAllPermissions());
$controller->render();