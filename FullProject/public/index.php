<?php
session_start();
error_reporting(E_ALL);
//избавляемся от всех require_once (подключаем автолоадер - он в config.php)
require_once'../app/config/config.php';
//require_once __DIR__ . '/../vendor/autoload.php'; // __DIR__ - храниться путь от корня системы до текущего файла(тот файл где подключаем автолоадер, у нас index.php)
ini_set('display_errors', 1);

date_default_timezone_set("UTC"); // Устанавливаем часовой пояс по Гринвичу

//создаем объект PDO
try {
	$pdo = new PDO("mysql:host={$db_host};dbname={$db_name}",
				$db_user,
				$db_user_pass);
} catch (Exception $e) {
	die("<h1>Error</h1>");
}

// 1) аутентификация: получить текущего пользователя
//require_once ("../app/user.php");
$user = new \app\auth\CUser($pdo); //здесь этот класс был бы нужен если бы были разрешения у пользователей
// 2) роутинг: определить, какую страницу запрашивает пользователь
//require_once ("../app/router/CRouter.php");
$controller = \app\router\CRouter::getController();
// 3) сформировать запрашиваемую страницу и отправить в браузер пользователю
//$controller->setPermissions($user->getAllPermissions()); //у нас пока нет разных разрешений для пользователей
$controller->render($pdo);

$pdo = null; //чистим переменную, освобождаем память