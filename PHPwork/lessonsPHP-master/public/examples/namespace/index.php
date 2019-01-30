<?php
						// Пространство имен
error_reporting(E_ALL);
ini_set('display_errors', 1);
// require_once ('pack1/classA.php');
// require_once ('pack1/pack2/classA.php');
// require_once'pack1/pack2/classB.php';

//избавляемся от всех require_once (см ниже)
require_once __DIR__ . '/vendor/autoload.php'; // __DIR__ - храниться путь от корня системы до текущего файла(тот файл где подключаем автолоадер, у нас index.php)

$a = new \Pack1\classA(); //создали объект класса classA из пространства имен Pack1
$b = new \Pack1\Pack2\classA();//создали объект класса classA из пространства имен Pack1\Pack2
$b2 = new \Pack1\Pack2\classB();//создали объект класса classB из пространства имен Pack1\Pack2 , но сам файл лежит в корне(вместе с индексом) - но переместим в Pack2 для АВТОЗАГРУЗЧИКА(будем использовать автозагрузчик composer. Сначала его нужно установить)
//Далее создать файл composer.json - это файл настроек(в нем не может быть комментариев)
//ниже текст файла json(ВАЖНО - убрать комментарии)
// {
//   "name": "Pack1", //название приложения(верхний уровень namespace)
//   "autoload": {//секция автозагрузки
//     "psr-4": { //указываем что у нас соответствие со стандартом psr-4
//       "Pack1\\": "pack1/", // сначало ключь(имя namespase-а), затем значение(путь к этому namespace-у 
//       //относительно файла composer.json). "\\" это такой синтаксис
//       "Pack1\\Pack2\\": "pack1/pack2"
//     }
//   }
// }
//затем запустить командную строку из папки с файлом composer.json и выполнить: composer install
//в результате появиться папка vendor(в папке где лежить json)
//далее добавляем в наш файл index.php автолоадер из папки vendor
	//require_once __DIR__ . '/vendor/autoload.php';

$c = new \Pack1\Pack3\classC(); // сразу не срабтает, так как не прописан в автолоадаре
//нужно прописать в файле настроек composer.json - добавить "Pack1\\Pack3\\": "pack1/pack3"
// далее в командной строке обновить данные - выполнить: composer dump-autoload

echo "<p>{$a->a}</p>";
echo "<p>{$b->a}</p>";
echo "<p>{$b2->a}</p>";
echo "<p>{$c->a}</p>";

$form = new \XForms\CXForms();
$form->addInput('login', 'Введите логин', 'Логин', 'text'); //добавили инпут
$form->addInput('email', 'Введите почту', 'Почта', 'text'); //добавили еще один инпут
$form->addInput('addres', 'Введите адрес', 'Адрес', 'text');
$form->addInput('submit', 'Войти', '', 'submit');

echo"<pre>".$form."</pre>";