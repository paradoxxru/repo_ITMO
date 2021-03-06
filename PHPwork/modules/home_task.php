<?php

//Создание переменных
//Создайте переменную с именем $age и присвойте ей числовое значение (int)  - ваш возраст.
//Создайте переменную с именем $name и присвойте ей строковое значение (string) - ваше имя.
//Создайте переменную $is_woman и присвойте ей логическое значение (bool) - являетесь ли вы женщиной.
// $age = 37;
// $name = 'Dmitriy';
// $is_woman = false;
// var_dump($age);
// var_dump($name);
// var_dump($is_woman);

//Преобразование типов
// Преобразуйте значение переменной с вашим возрастом из числового значения в строковое (string).
// Преобразуйте полученное строковое значение в дробное число (float).
// Преобразуйте полученное дробное (число с плавающей точкой, float) значение обратно в целое число.
// Преобразуйте значение переменной $is_woman в текстовое значение (string).
// Преобразуйте полученное значение обратно в логическое и, после этого, в целочисленное.
// Преобразуйте полученное значение обратно в логическое.
// echo "<br>";
// $age_string = (string)$age;
// $age_float = (float)$age_string;
// $age_int = (int)$age_float;
// $is_woman_str = (string)$is_woman;
// $is_woman_bool = (bool)$is_woman_str;
// $is_woman_int = (int)$is_woman_bool;
// $is_woman_bool2 = (bool)$is_woman_int;
// echo 'age_string: '; var_dump($age_string);
// echo "<br>";
// echo 'age_float: '; var_dump($age_float);
// echo "<br>";
// echo 'age_int: '; var_dump($age_int);
// echo "<br>";
// echo 'is_woman_str: '; var_dump($is_woman_str);
// echo "<br>";
// echo 'is_woman_bool: '; var_dump($is_woman_bool);
// echo "<br>";
// echo 'is_woman_int: '; var_dump($is_woman_int);
// echo "<br>";
// echo 'is_woman_bool2: '; var_dump($is_woman_bool2);
// echo "<br>";

//Объединение строк и арифметические операции
// Используя оператор объединения строк и переменные из предыдущего задания сформируйте 
// строку “Меня зовут <ваше имя>.
// Используя оператор объединения строк, преобразование типов и переменные из предыдущего задания 
// сформируйте строку “Мне <ваш возраст> лет”.
// Сформируйте строку “Мне <ваш возраст> лет” без приведения типов. 
// Чем полученный результат отличается от предыдущего. Как вы думаете, почему?
// Используя арифметические операции и переменные из предыдущих заданий определите, 
// какой будет ваш возраст через 7 лет?
// Аналогично определите, какой был ваш возраст 7 лет назад?
// Используя арифметические операции и преобразование типов определите, сколько полных 10-летий вы прожили?
// $str_myName = 'Меня зовут '.$name;
// echo $str_myName; echo "<br>";
// $str_myAge = "Мне ".$age_string." лет";
// echo $str_myAge; echo "<br>";
// $str_myAge2 = "Мне ".$age." лет";
// echo $str_myAge2; echo "<br>";
// echo "через 7 лет мне будет: ". ($age+7) ." лет"; echo "<br>";
// echo "7 лет назад мне было: ". ($age-7) ." лет"; echo "<br>";
// echo "я прожил полных: ". ((int)($age/10)) ." десятилетия"; echo "<br>";

	// Логические операции
// Напишите по одной функции для каждой из задач. Каждая функция по переданному в нее времени 
// (часы в 24-часовом формате) определяет, есть ли кто-то дома или нет. Возвращает функция, 
// соответственно, булево значение.
// Задачи
//  1) В доме живет только один человек
// Уходит из дома в 9-30, а приходит в 18-30.
echo "<br>";	
echo "полученное время: ". date("H:i");echo "<br>";
//или
$date = getdate();
echo "полученное время: ". $date['hours'].":".$date['minutes'];echo "<br>";

$time = time();//возвращает текущее абсолютное время. Это число равно количеству секунд, которое прошло с полуночи 1 января 1970 года (с начала эпохи UNIX). 
echo "время: "; echo "<br>";
echo $time; echo "<br>";
$time += 3*3600; //Добавляем 3 часа к времени
echo "время+3: "; echo "<br>";
echo $time; echo "<br>";
echo date("A Y-m-d H:i:s", $time); // Выводим время, согласно его часовому поясу
// date() - форматирование даты и времени. Аргументы: строка формата и абсолютное время. Второй аргумент необязателен. Возвращает строку с заданной или текущей датой в указанном формате
echo "<br>";
echo "<br>";
//получать время через time(), сравнивать с временем ухода и прихода, передавать при выводе в date()
function areYouAtHome($t) {
	$time1 = strtotime("09:30"); //преобразуем строковое значение во время(количеству секунд, которое прошло с полуночи 1 января 1970 года до 09:30 сегодняшнего дня)
	$time2 = strtotime("18:30");
	//$time = time(); //получаем текущее время
	$time = strtotime($t);
	//$time += 3*3600;	//Добавляем 3 часа к времени(наш часовой пояс)
	echo "переданное время: ".date('H:i',$time); //выводим время по шаблону
	echo "<br>";

	if($time<$time1 || $time>$time2) {
		//echo "человек дома",PHP_EOL;
		return true;
	} else
		//echo "человек ушел",PHP_EOL;
		return false;
}
if (areYouAtHome("07:30"))
	echo "человек дома",PHP_EOL;
else
	echo "человек ушел",PHP_EOL;
echo "<br>";
echo "<br>";
	// В доме живут три человека
// Первый уходит в 9-30, а приходит в 18-30.
// Второй уходит в 12-30, а приходит в 19-30.
// Третий уходит в 21-30, а приходит в 7-30.
// function has1($n) {
// 	$in_home = ($n <= 9) || ($n > 18);
// 	return $in_home;
// }
// function has2($n) {
// 	return ($n <= 12) || ($n > 18);
// }
// function has3($n) {
// 	return ($n > 7) && ($n < 21);
// }
// function hasSomeBody() {
// 	return has1($n) || has2($n) || has3($n);
// }
// function someoneAtHome($t) {
// 	$time1_start = strtotime("09:30");
// 	$time1_end = strtotime("18:30");
// 	$time2_start = strtotime("12:30");
// 	$time2_end = strtotime("19:30");
// 	$time3_start = strtotime("21:30");
// 	$time3_end = strtotime("07:30");
// 	$time = strtotime($t);
// 	echo "переданное время: ".date('H:i',$time);echo "<br>";
// 	if(($time<$time1_start || $time>$time1_end) 
// 		&& ($time<$time2_start || $time>$time2_end) 
// 		&& ($time<$time3_end || $time>$time3_start)) {
// 			echo "никого";
// 			return false;
// 	} else
// 		return true;
// }
// if(someoneAtHome("06:50")) 
// 	echo "кто-то дома";
// else
// 	echo "никого нет дома";
// echo "<br>";echo "<br>";

//Как преобразовать время с AM/PM на 24-часовой формат в PHP?
// $mytime = '09:15 AM';
// $chunks = explode(':', $mytime); //разбивает строку на подстроки по символу($chunks это массив с двумя знвчениями - до : и посте)
// if (strpos( $mytime, 'AM') === false && $chunks[0] !== '12') {
//     $chunks[0] = $chunks[0] + 12;
// } else if (strpos( $mytime, 'PM') === false && $chunks[0] == '12') {
//     $chunks[0] = '00';
// }
// echo preg_replace('/\s[A-Z]+/s', '', implode(':', $chunks));
// echo "<br>";
// //или просто
// $timenew = '09:45 pm';
// echo "Выводим время ".$timenew." в разном формате";echo "<br>";
// echo date('g:i a', strtotime($timenew));echo "<br>";
// echo date('H:i', strtotime($timenew));echo "<br>";
// echo "<br>";

//  2) В доме живут два человека
// Первый уходит в 9-30, а приходит в 18-30.
// Второй уходит в 12-30, а приходит в 19-30.


//  3) В доме живут три человека
// Первый уходит в 9-30, а приходит в 18-30.
// Второй уходит в 12-30, а приходит в 19-30.
// Третий уходит в 21-30, а приходит в 7-30.

// $html = "<b>bold text</b><a href=howdy.html>click me</a>";

// preg_match_all("/(<([\w]+)[^>]*>)(.*)(<\/\\2>)/", $html, $matches);

// for ($i=0; $i< count($matches[0]); $i++) {
//   echo "matched: " . $matches[0][$i] . "<br>";
//   echo "part 1: " . $matches[1][$i] . "<br>";
//   echo "part 2: " . $matches[2][$i] . "<br>";
//   echo "part 3: " . $matches[3][$i] . "<br>";
//   echo "part 4: " . $matches[4][$i] . "<br><br>";
// }

// echo "matches[0]";
// echo "<pre>";
// var_dump($matches[0]);
// echo "</pre>";

// echo "matches[1]";
// echo "<pre>";
// var_dump($matches[1]);
// echo "</pre>";


// $line = "	weight: 100";
// preg_match_all("/^([\t]*)/", $line, $matches);

// echo "matches[0]";
// echo "<pre>";
// var_dump($matches[0]);
// echo "</pre>";

// echo "matches[1]";
// echo "<pre>";
// var_dump($matches[1]);
// echo "</pre>";

// echo "matches[0][0]";
// echo "<pre>";
// var_dump($matches[0][0]);
// echo "</pre>";

// echo "matches[0][1]";
// echo "<pre>";
// var_dump($matches[0][1]);
// echo "</pre>";

###
/*
Первый элемент (индекс 0) содержит массив полных вхождений. Т.к. у меня жадные квантификаторы, забирающие 
максимальное вхождение, то и массив только из одного элемента - полной строки.
Далее идут массивы с вхождения множеств в том порядке, в котором они указаны в паттерне.
Соответственно, если какой-то элемент не найден, то соответствующий ему элемент будет пустым.
*/
$str = "grpart1grrpart2grpart1fhurybpart2g";
$ps = [
  "/(part1){1}/",
  "/(part1){1}.*(part2){1}/",
  "/((part1){1}.*(part2){1})*/",
  "/((part3){0,1}.*(part2){1})*/",
 
];
echo "<pre>";
foreach($ps as $p){
preg_match_all($p, $str,$m);
  echo print_r($m, true);
}
echo "</pre>";