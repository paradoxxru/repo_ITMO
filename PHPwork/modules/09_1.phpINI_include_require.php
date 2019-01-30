<?php
				// Лекция 9
	//Настройки php.ini
// file_uploads boolean или integer
// Разрешить или запретить загрузку файлов.
// upload_max_filesize integer
// Максимальный размер загружаемого файла.
// post_max_size integer
// Максимально допустимый размер данных, отправляемых методом POST.
// max_file_uploads integer
// Максимальное количество одновременно загружаемых файлов.
// max_input_time integer
// Максимальное время в секундах, за которое скрипт должен разобрать все входные данные, 
// переданные запросами вроде POST или GET.
// upload_tmp_dir string
// Временная директория для хранения файлов во время загрузки.

// директивы require и include
// Директивы require и include заменяются интерпретатором в ходе выполнения на содержимое файла, 
// имя которого указывается в качестве параметра этих директив.
// include <имя_файла>;
// require <имя_файла>;
// При использовании директивы include, если указанный файл не найден, то выдается предупреждение, 
// а сценарий продолжает свою работу.
// При использовании директивы require, если указанный файл не найден, 
// то выполнение сценария завершится критической ошибкой.
// Можно использовать файлы из сети, указав вместо имени URL,
// если это разрешено в настройках php (allow_url_include в php.ini).
// Подключаемый файл интерпретируется как HTML-файл.

//Однократное включение
// Директивы require_once и include_once не допускают повторного использования файла, 
// если его включение уже происходило ранее.
// include_once <имя_файла>;
// require_once <имя_файла>;

// примеры
// #включение с указанием относительного пути
// include 'config.php';
// include_once 'config.php';
// #включение с указанием абсолютного пути
// require '/domains/user/host/config.php';
// require_once '/domains/user/host/config.php';
// #включение с указанием URL
// include 'http://host/file.php';


//То что ниже написано в файле our_test.php
// define('OUR_TEST', 'our_test');
// $our_test = isset($our_test) ? $our_test++ : 1;
// $our_tesT = isset($our_test) ? $our_test++ : 2;
// function getCurrentDir() {
// 	return __DIR__;
// }
// function getRealPath() {
// 	return realpath('./');
// }
// function getScriptInfo() {
// 	echo __DIR__.PHP_EOL,
// 		__FILE__.PHP_EOL,
// 		__FUNCTION.PHP_EOL,
// 		__LINE__.PHP_EOL
// 		;
// }

//error_reporting(E_ALL); //включение репорта об ошибках(если не выводятся)
include_once "our_test.php"; // подключаем файл, в котором у нас объявлены переменные и ф-ции
echo "<pre>",
	'ot: '.$our_test.PHP_EOL,
	'oT: '.$our_tesT.PHP_EOL,
	'OT: '.OUR_TEST.PHP_EOL,
	'gCD: '.getCurrentDir().PHP_EOL,
	'gRP: '.getRealPath().PHP_EOL,
	"</pre>";
echo "<pre>";
getScriptInfo();
echo "</pre>";
echo "<br>";
echo "=============================";

include_once "our_test.php";
echo "<pre>",
	'ot: '.$our_test.PHP_EOL,
	'oT: '.$our_tesT.PHP_EOL,
	'OT: '.OUR_TEST.PHP_EOL,
	'gCD: '.getCurrentDir().PHP_EOL,
	'gRP: '.getRealPath().PHP_EOL,
	"</pre>";


?>