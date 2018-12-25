<?php 							//Домашнее задание
/*
//Создание переменных
//Создайте переменную с именем $age и присвойте ей числовое значение (int)  - ваш возраст.
//Создайте переменную с именем $name и присвойте ей строковое значение (string) - ваше имя.
//Создайте переменную $is_woman и присвойте ей логическое значение (bool) - являетесь ли вы женщиной.
$age = 37;
$name = 'Dmitriy';
$is_woman = false;
var_dump($age);
var_dump($name);
var_dump($is_woman);

//Преобразование типов
// Преобразуйте значение переменной с вашим возрастом из числового значения в строковое (string).
// Преобразуйте полученное строковое значение в дробное число (float).
// Преобразуйте полученное дробное (число с плавающей точкой, float) значение обратно в целое число.
// Преобразуйте значение переменной $is_woman в текстовое значение (string).
// Преобразуйте полученное значение обратно в логическое и, после этого, в целочисленное.
// Преобразуйте полученное значение обратно в логическое.
echo "<br>";
$age_string = (string)$age;
$age_float = (float)$age_string;
$age_int = (int)$age_float;
$is_woman_str = (string)$is_woman;
$is_woman_bool = (bool)$is_woman_str;
$is_woman_int = (int)$is_woman_bool;
$is_woman_bool2 = (bool)$is_woman_int;
echo 'age_string: '; var_dump($age_string);
echo "<br>";
echo 'age_float: '; var_dump($age_float);
echo "<br>";
echo 'age_int: '; var_dump($age_int);
echo "<br>";
echo 'is_woman_str: '; var_dump($is_woman_str);
echo "<br>";
echo 'is_woman_bool: '; var_dump($is_woman_bool);
echo "<br>";
echo 'is_woman_int: '; var_dump($is_woman_int);
echo "<br>";
echo 'is_woman_bool2: '; var_dump($is_woman_bool2);
echo "<br>";

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
$str_myName = 'Меня зовут '.$name;
echo $str_myName; echo "<br>";
$str_myAge = "Мне ".$age_string." лет";
echo $str_myAge; echo "<br>";
$str_myAge2 = "Мне ".$age." лет";
echo $str_myAge2; echo "<br>";
echo "через 7 лет мне будет: ". ($age+7) ." лет"; echo "<br>";
echo "7 лет назад мне было: ". ($age-7) ." лет"; echo "<br>";
echo "я прожил полных: ". ((int)($age/10)) ." десятилетия"; echo "<br>";
*/
?>										


										<!--Лекция 1-->
<!--
<html><head></head>
<body> 
	<h1> <?php
    	//$str = "Hello World___!"; #присваиваем значение переменной
    	//echo $str;             #вывод на экран
	?>

	</h1> 
</body>
</html>
-->

<?php
//$n = 1;
//двойные ковычки позволяют обращатся к значению переменной
//echo "n = $n";  # напечатает "n = 1"
//echo "<br>";
//echo "n = {$n}";  # напечатает "n = 1" //{$n} - более строгое определение границ переменной
//echo "<br>";
//echo "\$n = $n"; # напечатает "$n = 1" // \экранировали $
//echo "<br>";
//echo '$n';      # напечатает "$n" //так как использовали одинарные кавычки
//echo "<br>";
//echo "$0000"; # после $ недопустимое имя переменной
             # поэтому строка будет выводиться как есть: "$0000"
?>

<?php
//	echo "<br>";
//	echo "<br>";
    # нумерованный массив
//    echo $n[0];
//    echo "<br>";
    # ассоциативный массив
//    $n = array( //переопределили предыдущий массив
//            'key1' => 'value1',
//            'key2' => 'value2',
//    );
//    echo $n['key1'];
//    echo "<br>";
//    echo $n[0]; //ничего не выведет так как массив уже ассоциативный и по индексу не обратиться
?>

<?php
//	echo "<br>";
//	echo "<br>";
//	$obj = new DateTime(); //в переменну поместили новый экземпляр существующего класса
//	$obj->property1 = 1;
//  $obj->property2 = 'Hello';
//  echo $obj->format('Y-m-d H:i:s');
?>

<?php
	//Ресурсы
	//Никаких операций, включая преобразование типа, с этими значениями выполнять нельзя, так как они используются только специальными функциями.
//Создаются эти значения также специальными функциями при открытии доступа к определенному ресурсу (БД, файлы и т.д.).
#создает файловый дескриптор
	//$fp = fopen('/etc/passwd', 'r');
#создает дескриптор соединения с БД (одно из полей объекта будет дескриптором)
	//$pdo = new PDO('mysql:host=localhost;dbname=t', 'root', 'root');
#создает дескриптор нового палитрового изображения
	//$img = imagecreate(200, 100); //создастся картинка(пустой белый лист) 200 на 100 пикселей


?>


<?php
//$img = array(
//	'wer',
//	2,
//	array(3,4)
//);

//echo "<pre>"; //позволяет создать тег pre, который выводит на страницу все что внутри как есть
//var_dump($img);
//print_r($img);
//print_r($img, false);
//echo print_r($img, true); //print_r($img, true) - вернет текстовую строку, ее можно сохранить в переменную
// и использовать дальше
//var_export($img, false);
//echo var_export($img, true);
//echo "</pre>";

?>

								<!--Лекция 2-->

<html><?php
$a ="!!!"; ?><head><?php echo "\n"; ?></head>
<?php //echo "<body>"; echo "<h1>"; 
?>
<!--
Hello World<?php echo $a; ?></h1>
</body> -->
</html>


<?php
/*
//считаем кол-во посещений(открытия страницы)
$c = file_get_contents('counter.txt'); //counter.txt - будет хранить инфу, file_get_contents - возвращает содержимое файла
echo "<br>";
var_dump($c); //будет строкой
echo "<br>";
//проверим есть ли в файле значение
if ( !is_numeric($c) ) $c = 0; //is_numeric - возвращает трю или фолс - проверяет является ли переменная 
								//числом(int или float)
$c++;
echo $c;
echo "<br>";
var_dump($c); //будет числом(не явное приведение типов) - php сам преобразовал
echo $c;
echo "<br>"; // перевод строки
var_dump(is_string($c)); //просто проверили является ли переменная строкой и вывели результат
file_put_contents('counter.txt', $c);
*/
?>

<?php
//константы
/*
	echo "<br>";
	define('HELLO_WORLD', 'Hello World!'); //define - объявление константы
											//HELLO_WORLD - имя константы
											//'Hello World!' - значение константы
    echo HELLO_WORLD;
    echo $a;//из предыдущего примера
*/
?>

<?php
/*
echo "<pre>";

echo "<br>";
//приведение типов
$a1 = '12.34 fdfds';
$a2 = 12.34;
$a3 = true;
$a4 = 0.0;
$a5 = 0.00000000000000000000000000001;
*/
/*посмотрим преобразования
(int), (integer)
(bool), (boolean)
(float), (double), (real)
(string)
(array)
(object)
*/
/*
echo "$a1\n";
echo "переменная a в исходном виде";
echo "<br>";
var_dump($a1);

echo "<br>";
echo "преобразуем в целое число";
echo "<br>";
var_dump((int)$a1); //преобразовываем в число и выводим

echo "<br>";
echo "преобразуем в bool";
echo "<br>";
var_dump((bool)$a1); //преобразовываем и выводим

echo "<br>";
echo "преобразуем в float";
echo "<br>";
var_dump((float)$a1); //преобразовываем и выводим

echo "<br>";
echo "преобразуем в строку";
echo "<br>";
var_dump((string)$a1); //преобразовываем и выводим

echo "<br>";
echo "преобразуем в array";
echo "<br>";
var_dump((array)$a1); //преобразовываем и выводим

echo "<br>";
echo "преобразуем в object";
echo "<br>";
var_dump((object)$a1); //преобразовываем и выводим

echo "<br>";
var_dump($q); //будет NULL
$q = 0.003;
var_dump($q);
var_dump((string)$q);
var_dump($q);
$q = (string)$q;
var_dump($q);
var_dump((int)$q);
var_dump((int)"2.99884"); //будет 2

//сравнение
var_dump($q == "0.000");
*/

/*
$a = 9;
$a += 1; //тоже самое $a = $a +1
//var_dump($a);
$a = "9";
var_dump($a);
$a .= "1";  // .= это объединение строк
var_dump($a);
echo "<br>";
// ! - не, || - или(если хоть одно истина, то вернет истину), && - И (только если оба истина вернет истину)
$t = true;
$f = false;
// true true
// true false
// false true
// false false
var_dump($t || $t);
var_dump($t || $f);
var_dump($f || $t);
var_dump($f || $f);
echo "<br>";
var_dump($t && $t);
var_dump($t && $f);
var_dump($f && $t);
var_dump($f && $f);
echo "<br>";
var_dump(!$t);
var_dump(!$f);
echo "<br>";

$a = true;
var_dump($a);
var_dump(false || false || false || false || (($a =false) == true));
var_dump(true || false || false || false || (($a =false) == true)); //здесь до ($a =false) == true) не дойдет, так как //внвчале стоит true и || вернет true если хоть один true и дальше выполняться не будет, то есть присвоение $a не //произойдет
var_dump(false && false || false || false || (($a =false) == true)); //остановиться после первого && и вернет false
*/

echo "<br>";
/*
	&=  - побитовая логич операция(каждый бит переменной сранивается)
	|=
	^=  - побитовое отрицание
	>>=  - сдвиг побитный
	<<=
*/
/*
$a = 0b1111; //0b значит дальше двоичное представление
var_dump($a);
$a >>= 1;
echo ($a)."\n";
$a <<= 1;
echo ($a)."\n";
echo "<br>";

$a = 0b101;
$a &= 0b001; //  $a = $a && false //true "умножает" на false
var_dump($a);

$a = true;
$a &= false; //  
var_dump($a);
*/
/*
$a = 4;
$a = 1 + $a = 2;
var_dump($a); // будет 3 !!! так как идем при присваивании справа налево

$a = true and false; //будет true !!!!
var_dump($a); 
$a = (true and false);
var_dump($a); 

echo "</pre>";
*/
?>

							<!--Лекция 3-->

<pre>
<?php
			//операторы ветвления и ф-ции

//С помощью if..else выяснить, является ли год високосным.(делиться на 4 без остатка и при этом не делиться на 100 без
//остатка либо делиться на 400 без остатка - значит високосный)
//$year = 2001; //Для проверки. в: 2000, 2004, 1904; нв: 1900, 1903, 2001,2003
    
//    if (!($year%4) && $year%100) { //любое число при преобразовании в булеан дает true, 0 дает false
//    	echo 'Год является високосным';
//    }
//    else if(!($year%400)) {
//    	echo 'Год является високосным';
//    }
//    else {
//    	echo 'Год не является високосным.';
//    }
	//или
/*
$year2 = 1904; //Для проверки. в: 2000, 2004, 1904; нв: 1900, 1903, 2001,2003
echo $year2."\n";
if ($year2 % 4 == 0 && $year2 % 100 != 0) {
	echo 'Год является високосным';
} else if ($year2 % 400 == 0) {
	echo 'Год является високосным';
} else 
	echo 'Год не является високосным.';
*/
//или
//if (($year2 % 4 == 0 && $year2 % 100 != 0) || ($year2 % 400 == 0))  {
//	echo 'Год является високосным';
//} else 
//	echo 'Год не является високосным.';

//1.Создать несколько констант с названием операций.
//Например, ADD_NEW_PRODUCT, EDIT_PRODUCT и т.д.
//2.Создать переменную и присвоить ей значение одной из операций.
//3.Используя оператор выбора switch вывести на экран выбранную операцию.
/*
echo "<br>";echo "<br>";
define('ADD_NEW_PRODUCT', 1);//создали константу
define('EDIT_PRODUCT', 2);
define('DELETE_PRODUCT', 3);
$cmd = EDIT_PRODUCT; // в переменной будет значение 2
switch ($cmd) {
    case ADD_NEW_PRODUCT:
        echo 'Добавить новый продукт';
        echo "<br>";
        //break;						
    case EDIT_PRODUCT:
        echo 'Редактировать продукт';
        echo "<br>";
        //break;						//без брейков выполняться все кейсы(+default), начиная с подходящего
    case DELETE_PRODUCT:
        echo 'Удалить продукт';
        echo "<br>";
        //break;    
    default:
        echo 'Неверный код операции';
        echo "<br>";
        //break;
}
*/

					//ф-ции
//
echo "<br>";
function square($x) {
   return $x * $x;
}
//echo square(2);

	//Передача аргументов по значению
/*
echo "<br>";echo "<br>";
function add($x) {
    $x++;
    echo '<p>' . $x . '</p>';
}
$y = 5;
add($y);
echo '<p>' . $y . '</p>';
$x = 15;
add($x);
echo '<p>' . $x . '</p>';
*/
	//Передача значений по ссылке
echo "<br>";echo "<br>";
//Если необходимо изменять сами аргументы, то их необходимо передавать (принимать) по ссылке
function concat(&$output, $str) { // & - значит передаем ссылку на переменную. Тогда можно будет менять значение
									// этой переменной !!!!
    $output .= $str;
}
//Если необходимо передать аргумент по ссылке в функцию, которая принимает аргумент по значению:
function concat2($output, $str) {
    $output .= $str;
    echo $output."\n";
}
$str = 'Hello';
//echo $str."\n";
//concat(&$str, ' world!'); // или при вызове ф-ции можем указать что передаем ссылку на переменную(не работает в php 7)
//concat($str, ' world!'); //теперь $str "глобально" поменялась = Hello world!
//echo $str."\n";
//concat2($str, ' world!'); //внутри ф-ции значение меняется(но не "сохраняется")
//echo $str."\n";				//поэтому здесь = Hello world!

	//Значение аргументов по умолчанию
//В определении функции можно использовать синтаксис C++ для задания значений аргументов по умолчанию.

function fee($type='Яблоко') { //то есть если аугумент не передали, то его значение внутри ф-ции будет 'Яблоко'
    return 'Имеем фрукт: ' . $type."\n";
}
/*
echo fee();         #выводит: "Имеем фрукт: Яблоко"
echo fee('Груша');  #выводит: "Имеем фрукт: Груша"
echo fee('Груша', 'мясо'); # 'мясо' будет игнорироваться
*/

//Написать функцию, которая возвращает количество дней в году.
//Интерфейс функции:
//function getDaysInYear($year = false);
//Если год в функцию передан, то количество дней считается и возвращается для переданного года.
//Если год не передан, то берется текущий.
//Получение текущего года:
//$year = date("Y");
function getDaysInYear($year = false) { //false - значение по умолчанию
	if (!is_int($year)) //если год не передали, то установить текущий год(если не число тоже)
		$year = date("Y"); //ф-ция data возвращает текущий год
	$days = 365; //изначально зададим кол-во дней в обычном году(не високосный)
	if (($year%4 == 0 && $year%100 !=0) || ($year%400 == 0)) { //проверяем является ли год високосный
		$days = 366;
	}
	return $days;
}

/*
echo "2017 : ".getDaysInYear(2017)."\n";
echo "2000 : ".getDaysInYear(2000)."\n";
echo "2001 : ".getDaysInYear(2001)."\n";
echo "1901 : ".getDaysInYear(1901)."\n";
echo "2004 : ".getDaysInYear(2004)."\n";
echo "1904 : ".getDaysInYear(1904)."\n";
echo " : ".getDaysInYear()."\n";
echo "dfsgufy : ".getDaysInYear('dfsgufy')."\n";
echo "<br>";echo "<br>";
*/
//Написать функцию, которая выводит количество дней, оставшихся до нового года.
//Функция должна корректно работать при запуске в любом году, т. е. грядущий год должен вычисляться программно.
//function getDaysToYearEnd();
//Получить порядковый номер текущего дня в году (от начала года):
//$day = date("z");
function getDaysToYearEnd() {
	$year = date("Y"); //ф-ция data возвращает текущий год
	$day = date("z"); //порядковый номер текущего дня в году (от начала года)
	echo "сейчас ".$year." год\n";
	echo "сейчас ".$day." день от начала года\n";
	$days_in_year = getDaysInYear($year); //вызыываем ф-цию из предыдущей задачи и определяем 
	// сколько дней в указаном году
	$end = $days_in_year - $day - 1;
	return $end;
}
//echo "До нового года осталось: ".getDaysToYearEnd()."\n";
?>
</pre>

<?
						// Лекция 4
//новая колода карт - все лежат по порядку(туз(порядк номер 1)-двойка(поряд номер 2)-тройка-......)
//масти идут по порядку - черви, буби, крести, пики(то есть бубновый туз(порядк номер 14))
//Задача - по порядковуму номеру вывести масть и значение карты

//ф-ция возвращает значение карты и масть
//используем кратность 13
function getCardValue($i) {
	if (!is_int($i))	//проверяем число ли(чтобы не было строки вместо индекса)
		return 'требуется номер карты';
	if ($i <1 || $i >52)
		return 'нет такой карты';
	$suit = 'Ч'; //для масти(установили начальное значение)
	$val = 'Т'; //для значения карты(установили начальное значение)
		//определяем значение карты
	switch ($i % 13) { //если остаток от деления на 13....
		case 0:
			$val = 'К';
			break;
		case 1:
			$val = 'Т';
			break;
		case 11:
			$val = 'В';
			break;
		case 12:
			$val = 'Д';
			break;
		default: //иначе соответствует остатку от деления на 13
			$val = $i % 13;
	}
	//определяем масть
	switch(ceil($i/13)) {//округление в большую сторону
		case 1:
			$suit = 'hearts';
			break;
		case 2:
			$suit = 'diamonds';
			break;
		case 3:
			$suit = 'clubs';
			break;
		case 4:
			$suit = 'spades';
			break;
	}

	return "<span class='{$suit}'>{$val}</span>";// {} - явно указывают границы переменной 
	//тоже что и "<span class='" .$suit "'>" .$val "</span>";
	// Здусь возвращаем span с определенным классом(см. ниже), чтобы делее стилизовать значение,
	// выводимое в span(черви будут красные и будет изображение червей)
	// символы взяты - https://unicode-table.com/ru/sets/suits-of-the-cards/
}
echo "<br>";echo "<br>";
$i = rand(0, 53); //ф-ция rand() возвращ случ значение(от 0 до 53) - 0 и 53 выдадут ошибку
$card = getCardValue($i);
//echo $i . ': ' . $card;

?>	
<style type="text/css">
	.hearts, .diamonds {color:red;}
	.clubs, .spades {color:black;}
	.hearts::before{content: "♥";}
	.diamonds::before{content: "♦"}
	.clubs::before{content: "♣"}
	.spades::before{content: "♠"}

</style>


<?php

//области видимости
/*
echo '<pre>';
$aa1 = 1;
$aa3 = 3;
function fee2(){
   $aa2 = 2;
   global $aa3; //пробросили $aa3 из глобальной видимости в ф-цию
   echo '1: ' . $aa1 . PHP_EOL; //$a1 не будет доступна
   echo '2: ' . $aa2 . PHP_EOL; // PHP_EOL тоже самое что \n
   echo '3: ' . $aa3 . PHP_EOL;
}
fee2();
echo '4: ' . $aa1 . PHP_EOL;
echo '5: ' . $aa2 . PHP_EOL;
echo '6: ' . $aa3 . PHP_EOL;
echo '</pre>';
*/
//статические переменные
/*Статическая переменная существует только в локальной области видимости 
функции, но не теряет своего значения, когда выполнение программы выходит из этой области видимости.
*/
function test()
{
    static $a = 0; //при втором запуске ф-ции test() $a будет уже 1
    $b = 0;
    echo $a;
    echo $b;
    $a++;$b++;
}
//test();
//test();
//test();

//Проверка существования переменной
//bool isset ( mixed var [ , mixed … ] ) Определяет была ли установлена переменная значением, 
//отличным от NULL.
//Если передать более одного аргумента – True только если все переменные определены.
//Проверка происходит слева направо до первой неопределенной переменной.

//Уничтожение переменной
//void unset ( mixed var [ , mixed … ] )
//Удаляет перечисленные переменные.
//Если переменная, объявленная глобальной или передается ПО ССЫЛКЕ, удаляется внутри функции, 
//то будет удалена только локальная переменная.
//Переменная в области видимости вызова функции сохранит то же значение, что и до вызова unset().

//задача
//Написать функцию, которая вычисляет текущий сигнал светофора.
//Принимает функция количество минут, которое прошло с начала часа.
//Возвращает текущий цвет светофора.
//Известно, что с начала каждого часа светофор горит следующим образом:
//- 3 минуты горит зеленый
//- 3 минуты горит желтый
//- 4 минуты горит красный
//- 2 минуты горит желтый
//- цикл начинается сначала

function getLightColor($i) {
	if (!is_int($i)) return 'Ошибка'; //если ввели не число
	if ($i < 0) return 'Ошибка'; //если ввели отрицательное число
	//каждый цикл длиться 12 мин
	//в каждом цикле 4 смены действия
	//в час происходит 5 циклов
	$color = '';
	$i = $i % 60; // (каждый новый час начинается с 60-й мин)если ввели 61, то пойдет 2-я мин другого часа
	$i = $i % 12; // то есть каждые 12 мин цикл начинается сначала
	/*
	switch ($i) {
		case 0:
		case 1:
		case 2:
			$color = 'green';
			break;
		case 3:
		case 4:
		case 5:
		case 10:
		case 11:
			$color = 'yellow';
			break;
		case 6:
		case 7:
		case 8:
		case 9:
			$color = 'red';
			break;
	}*/
	if ($i < 3) $color = 'green';
	elseif ($i <6) $color = 'yellow';
	elseif ($i < 10) $color = 'red';
	else $color = 'yellow';
	return $color;

}
//echo "<br>";echo "<br>";
$i = rand(0,60);
$color = getLightColor($i);
//echo $i. ' : '. $color;

//задача
//Написать функцию, которая определяет время по положению стрелок часов.
//Программа принимает два аргумента:
//положение часовой стрелки в градусах.
//положение минутной стрелки в градусах;
//Программа возвращае текстовую строку вида: “чч:мм”, где чч - часы, а мм - минуты.

function getClock($a, $b) {
//360 градусов / 12 = 30 градусов - то есть за час часовая стрелка проходит 30 градусов
// за минуту минутная стрелка проходит 6 градусов(360/60)
$hour = (int)($a/30); //сколько целых часов прошло за $a градусов
$minute = ((int)($b/6))%60; //сколько целых минут прошло за $b градусов, берем остаток от деления
// на 60(мин) чтобы обрабатывать градусы больше 360(как буд-то пошла следующая минута)
return 'часы: '.$hour.' мин: '.$minute;
}
//echo "<br>";echo "<br>";
//echo getClock(0,15);


//массивы
/*
$months = array(
    -2 => 'Январь',
          'Февраль',  #Какой будет индекс?
     3 => 'Март',
          'Апрель',   #Какой будет индекс?
);
echo "<br>";echo "<br>";
print_r($months);
echo "<br>";
echo ($months[2] ? 'true' : 'false');  //если надо выводить на экран логическое значение

//$b = false;
//echo ($b ? 'true' : 'false');
echo "<br>";
var_dump($months[2]);
*/
?>

<?php
							// Лекция 5
/*
echo "<br>";
$months = array(
    'january'  => 'Январь',
    'february' => 'Февраль',
    'march'    => 'Март',
);
$months['april'] = 'Апрель';
echo $months['february']; #Выведет "Февраль"

//двумерный массив
echo "<br>";
$a = array(
    'orange' => array(
        'color' => 'Оранжевый',
        'taste' => 'Сладкий',
    ),
    'lemon' => array(
        'color' => 'Желтый',
        'taste' => 'Кислый',
    ),
);
echo $a['orange']['taste']; # выведет "Сладкий"
echo "<br>";
*/
?>

<pre>
<?php
//print_r($a); //выводим внутри <pre чтобы сохранить форматирование
?>
</pre>

<!--
или так
echo '<pre>' . print_r($a, true) . '</pre>';
-->

<?php
//задача
//Создайте массив $bmw с ячейками (индексы):
//    “model”
//    “speed”
//    “doors”
//    “year”
//Заполните ячейки значениями: “X5”, 120, 5, “2006”.
//Создайте массивы $totyota и $opel с такими же ячейками. Заполните значениями:
//“Astra”, 130, 3, “2008”
//“Camry”, 140, 5, “2007”
//Выведите значения всех трех массивов в виде таблицы:
//Имя - модель - скорость - двери - год
//bmw -    X5     -      120     -     5     - 2006
/*
$bmv = array(
	'model'=>'X5',
	'speed'=>'120',
	'doors'=>'5',
	'year'=>'2006'
);
$toyota = array(
	'model'=>'Camry',
	'speed'=>'140',
	'doors'=>'5',
	'year'=>'2007'
);
$opel = array(
	'model'=>'Astra',
	'speed'=>'130',
	'doors'=>'3',
	'year'=>'2008'
);
echo "<table>
		<tr>
			<th> Имя </th><th> Модель </th><th> Скорость </th><th> Двери </th><th> Год </th>
		</tr>
		<tr>
			<td> BMW </td><td>".$bmv['model']."</td><td>".$bmv['speed']."</td><td>".$bmv['doors']."</td><td>".$bmv['year']."</td>
		</tr>
		<tr>
			<td> TOYOTA </td><td>".$toyota['model']."</td><td>".$toyota['speed']."</td><td>".$toyota['doors']."</td><td>".$toyota['year']."</td>
		</tr>
		<tr>
			<td> OPEL </td><td>".$opel['model']."</td><td>".$opel['speed']."</td><td>".$opel['doors']."</td><td>". $opel['year'] ."</td>
		</tr>
	</table>";
*/
//Меню
//Создать массив, где ключ - название раздела, а значение - путь до файла с содержимым страницы.
//вывести в виде списка(ul) каждый элемент(li) это ссылка(имя ссылки название раздела и ссылается она
// на опледеленный путь)
/*
$menu = array(
		'Main' => '/',
		'About' => '/about.html',
		'Personnel' => '/personnel.html',
		'Partners' => '/partner.html'
);
echo "<ul>
		<li><a href=".$menu['Main'].">Main</a></li>
		<li><a href=".$menu['About'].">About</a></li>
		<li><a href=".$menu['Personnel'].">Personnel</a></li>
		<li><a href=".$menu['Partners'].">Partners</a></li>
	</ul>"
*/
?>

<?php
		//циклы
//Оператор break
//Прерывает выполнение циклов for, while, foreach и конструкций switch.
//Имеет необязательный аргумент, определяющий сколько вложенных циклов необходимо прервать.
/*
$i = 0;
while (++$i) {
    switch ($i) {
        case 5:
            echo 'At 5';
            break 1; #выйти только из switch
        case 10:
            echo 'At 10';
            break 2; #выйти только из switch и цикла while
        default:
            break;
    }
}

//Оператор continue
//Используется, чтобы прекратить выполнение оставшейся части цикла и перейти к следующей итерации.
//Имеет необязательный аргумент, определяющий на сколько вложенных циклов должно распространяться 
//его действие.
//while ( list($key, $value) = each($arr) ) {
//    if ( !($key % 2) ) {
//        continue; #пропустить не четный элемент
//    }
    #обработать четный элемент
//}

//вывести все четные числа от 1 до 10
$n =10;
for ($i=0;$i<$n;$i++) {
	if ($i%2 == 1)
		continue;
	echo "<p>{$i}</p>"; //можно указать так echo "<p>".$i."</p>"
	
};

//задача
//Используя цикл вывести таблицу умножения на 2 для чисел от 1 до 10

echo "<br>";
echo "<table>
		<tr>
			<th> число </th><th> x2 </th><th> результат</th>
		</tr>";
for ($i=1; $i<=10; $i++) {
	echo "<tr>
			<td>".$i."</td><td> x2 </td><td>".($i*2)."</td><td>
		</tr>";
};
echo "</table>";
*/
?>


<?php
					// Лекция 6, 7
/*
			//взаимодействие с пользователем(браузером)
//Ассоциативный массив параметров, переданных скрипту через URL.
# http://localhost/?name=Kirill
echo 'Hello ' . htmlspecialchars($_GET['name']); # Выводит: "Hello Kirill"
echo "<a href='?name=Kirill2&param_1=value_1&param_2=value_2&param_3=value_3'>Много параметров</a>";
# Выведем глобальный массив GET
echo '<pre>', 				//echo принимает набор параметров через запятую и выводит
	print_r($_GET, true),
	'</pre>';
//Ассоциативный массив данных, переданных скрипту методом HTTP POST.
echo "<form action='index.php' method='post'>
    Имя: <input name='name' type='text' />
    Возраст: <input name='age' type='text' />
    Вес: <input name='weight' type='text' />
    <input type='submit' value='Send' />
</form>";
# Например в форму ввели Kirill
echo 'Hello ' . htmlspecialchars($_POST['name']); # Выводит: "Hello Kirill"
# Выведем глобальный массив POST
echo '<pre>', 				//echo принимает набор параметров через запятую и выводит
	print_r($_POST, true),
	'</pre>';
*/

//задача
//Написать функцию, которая принимает из формы от пользователя целое число n
// и возвращает сумму квадратов всех чисел от 1 до n. 
/*
echo "<form action='index.php' method='post'>
	Введите число: <input name='number' type='text' />
	<input type='submit' value='Send' />
	</form>";
echo '<pre>', 				
	print_r($_POST, true),
	'</pre>';
function getRezalt($n) {
	$sq =0;
	for ($i=1; $i <= $_POST['number']; $i++) {
		$sq += $i*$i;
	}
	echo "ввели число: ". $_POST['number'] . "<br>";
	echo "сумму квадратов всех чисел от 1 до ". $_POST['number'] . " равна: ". $sq . "<br>";
}
getRezalt($_POST['name']);
*/
//задача
//Вывести на экран соответствие между весом в фунтах и весом в килограммах для значений 
//1, 2, ..., 10 (фунты).1 фунт = 453 г.
//принимать значение из формы(один инпут)
/*
echo "<form action='index.php' method='post'>
	Введите вес в фунтах: <input name='number' type='text' />
	<input type='submit' value='Send' />
	</form>";
function getWeight($w) {
	return $w*453;
}
echo "в: ". ($_POST['number']). " фунтах " . getWeight($_POST['number']) . " грамм". "<br>";
echo "в: ". $_POST['number']. " фунтах " . getWeight($_POST['number'])/1000 . " килограмм". "<br>";
*/
/*
//задача - при вводе фунтов сразу выводить граммы и наоборот(примо в импуты)
$funts = "";
$gramms = "";
if (!empty($_POST['funts'])) {		//проверяем - если не пустая строка или не ноль, то
	$funts = (int)$_POST['funts'];	//пытаемся преобразовать в число
	$gramms = $funts*453;
} elseif (!empty($_POST['gramms'])) {
	$gramms = (int)$_POST['gramms'];
	$funts = $gramms/453;
}
echo "<form action='index.php' method='post'>
	фунты: <input name='funts' type='text' placeholder=\"{$funts}\" /><br>
	граммы: <input name='gramms' type='text' placeholder='{$gramms}' /><br>
	<input type='submit' value='Send' />
	</form>";
//выводим для проверки
echo '<pre>', 				
	print_r($_POST, true),
	'</pre>';
//ниже тестим ф-ции для проверки
echo "funts is ". ((isset($_POST['funts'])) ? ' set' : ' not set') . "<br>";
echo "funts is ". ((empty($_POST['funts'])) ? ' empty' : ' not empty'). "<br>"; //ф-ция, если введена пустая строка или 0, то будет считать что empty
echo "funts is ". ((is_int($_POST['funts'])) ? ' int' : ' not int'). "<br>";
*/
/*
//создать конвертер валют
$rubls="";
$dollars="";
$euro = "";
if (!empty($_POST['rubls'])) {
	$rubls = (int)$_POST['rubls']; //пытаемся преобразовать в число
	$dollars = $rubls/67.18;
	$euro = $rubls/76.33;
} elseif (!empty($_POST['dollars'])) {
	$dollars = (int)$_POST['dollars'];
	$rubls = $dollars*67.18;
	$euro = $dollars/1.14;
} elseif (!empty($_POST['euro'])) {
	$euro = (int)$_POST['euro'];
	$rubls = $euro*76.33;
	$dollars = $euro*1.14;
}
echo "<form action='index.php' method='post'>
	рубли: <input name='rubls' type='text' placeholder='{$rubls}' /><br>
	доллары: <input name='dollars' type='text' placeholder='{$dollars}' /><br>
	евро: <input name='euro' type='text' placeholder='{$euro}' /><br>
	<input type='submit' value='Send' />
	</form>";
//выводим для проверки
echo '<pre>', 				
	print_r($_POST, true),
	'</pre>';
*/

	
						//Работа с директориями
	// вывести список файлов и директорий
/*
#получить ссылку на текущий каталок
$path = "./"; //текущая директория
if (isset($_GET['path'])) { //проверяем нет ли у нас в массиве $_GET элемента 'path' (то есть 
							// существует ли такой элемент). Данный параметр(элемент массива $_GET)
				// возникнет при нажатии на ссылку <a href='/index.php?path={$full_file_name}'> (см. ниже)
	if (is_dir($_GET['path'])) { //Определяет, является ли имя файла(полный путь к файлу) директорией.
		$path = $_GET['path'] . "/";
	}
}
$folder =  opendir($path); //открываем директорию и помещаем ссылку на нее в переменную $folder
$folder2 = opendir("test_dir");
//echo "$folder2"."\n";
#проверяем удалось ли открыть директорию
if ($folder) {
	echo "<ul>";
	while ($file = readdir($folder)) { //readdir($folder) - поочереди считывает 
										//файлы из директории
										//в $file помещает имя(папки или файла) и если нечего больше читать возвращает false
		echo "<li>";
		if (is_dir($path.$file)) { //проверяем является ли полученное значение директорией(чтобы далее выводить на директорию ссылку)
			$full_file_name = $path.$file;
			echo "<a href='/index.php?path={$full_file_name}'>$file</a>"; //?path={$full_file_name} - 
			// это параметры (ключ - path(это имя параметра), значение - путь $path.$file)
			// Как только нажмем на ссылку в массиве $_GET будет создан элемент $_GET['path'] со
			// значением $full_file_name(то есть полный путь до папки)
			//В нашем случае можно не указывать index.php, так как по дефолту localhost запускает
			// именно index.php, если бы была другая страница(например home_task.php),то надо указывать
			
		} else { //если не директория, то выводим имя файла как есть без ссылки
			echo $file;
		}
		echo "</li>";

		//echo '<li>' 
		//	.$file . ": "
		//	. filetype($path. $file) //получаем тип файла, указали полный путь(в нашем случае 
		//можно указывать только $file, так как работает в той же директории)
		//	. '</li>';
	}
	echo "</ul>";
	//в итоге получим список из наших файлов и директорий в папке где находиться index.php
	//так как $path = "./" это текущая(относительно выполняемого файла) директория
	// Первый элемент списка всегда будет (.) точка - текущая директория
	// Второй элемент списка всегда будет (..) две точки - выход на уровень вверх
}
echo "<pre>". print_r($_GET, true) . "</pre>";
*/
?>

<?php
				//сделать тоже в виде таблицы, добавить размер файла, описание и тд
#получить ссылку на текущий каталок
$path = "./"; //текущая директория
if (isset($_GET['path'])) { //проверяем нет ли у нас в массиве $_GET элемента 'path' (то есть 
							// существует ли такой элемент). Данный параметр(элемент массива $_GET)
				// возникнет при нажатии на ссылку <a href='/index.php?path={$full_file_name}'> (см. ниже)
	if (is_dir($_GET['path'])) { //Определяет, является ли имя файла(полный путь к файлу) директорией.
		$path = $_GET['path'] . "/";
	}
}
$folder =  opendir($path); //открываем директорию и помещаем ссылку на нее в переменную $folder

#проверяем удалось ли открыть директорию
if ($folder) {
	echo "<table>";
	echo "<tr>
			<th>Имя файла</th>
			<th>Размер(байт)</th>
			<th>Расширение</th>
			<th>Дата изменения</th>
		</tr>";
	while ($file = readdir($folder)) { 
		echo "<tr>";
		if (is_dir($path.$file)) { //проверяем является ли полученное значение директорией(чтобы далее выводить на директорию ссылку)
			$full_file_name = $path.$file;
			echo "<td colspan='4'>
				<a href='/index.php?path={$full_file_name}'>$file</a>
				</td>";
				//colspan='4' - объединение 4-х ячеек(так как для файла будет больше инфы чем для каталога)
		} else { //если не директория, то выводим имя файла как есть без ссылки
			echo "<td>
				 $file
				</td><td>";
				echo filesize($path.$file); //размер файла в байтах
				echo "</td><td>";
				$file_info = pathinfo($path.$file); //получаем массив информации
				echo $file_info['extension']; // выводим только расширение
				echo "</td><td>";
				$file_time = filemtime($path.$file); //filemtime - возвращает время последнего изменения
				// файла(в формате временной метки Unix, который подходит для передачи в качестве
				// аргумента функции date())
				echo date("Y-m-d H:i:s", $file_time);

			//$rrr = pathinfo($path.$file); //вернет массив с инфой о файле(тип файла, расширение)
			//$ttt = filemtime($path.$file); //.....
		}
		

	}
	echo "</table>";
}
echo "<pre>". print_r($_GET, true) . "</pre>"; 
//echo "<pre>". print_r($file_info) . "</pre>";

?>

<?php
		//получать содержимое файлов
//в файле будем хранить диалоги из чата, в чате передача данных через пост(добавлять новые сообщения)
//
$user_name = 'anonim'; //начальное значение
if (isset($_POST['login'])) { // если имя введено
	$user_name = $_POST['login'];
}

?>
<div class="message-box">
	<?php
	//вывод предыдущих сообщений
	$messages =  file('history.txt');//для всех сообщений - считываем файл и получаем массив строк
	foreach ($messages as $mes) { // перебираем каждую строку массива $messages
		echo "<p>". $mes. "</p>"; //выводим
	}
	//обработка текущего сообщ
	if (isset($_POST['message']) && strlen($_POST['message'])>0) {
	
		$mes = $user_name. " ( ". date("H:i:s")."): ". $_POST['message'];
		//надо бы еще проверить существует ли файл history.txt
		file_put_contents('history.txt', $mes . PHP_EOL , FILE_APPEND); //file_put_contents - идентична
		//последовательным успешным вызовам функций fopen(), fwrite() и fclose().
		//Если filename не существует, файл будет создан. Иначе, существующий файл будет перезаписан,
		//за исключением случая, если указан флаг FILE_APPEND(тогда дозаписывает в конец).
		echo "<p>" . $mes. "</p>"; //выводим сообщение
	}
	?>
</div>
<form method="post" action="index.php">
	<input type="text" 
			name="login"
			value = "<?php echo $user_name; ?>"
	><br>
	<textarea name="message" rows="4" cols="10"></textarea><br>
	<button>Отправить</button>
</form>

<?php
//echo "<pre>". print_r($_POST, true). "</pre>";
?>

<?php
//Спросить количество тарелок и количество моющего средства.
// Моющее средство расходуется из расчета 0.5 на одну тарелку.
// В цикле выводить сколько моющего средства осталось после мытья каждой тарелки.
// В конце вывести сколько тарелок осталось, когда моющее средство закончилось или наоборот.


?>

<form method="post" action="index.php">
	<label>Ведите кол-во тарелок<input type="text" name="plate"></label>
	<label>Введите кол-во средства<input type="text" name="soap"></label>
	<button>Моем</button>
</form>
<?php
	$plate = $_POST['plate'];
	$soap = $_POST['soap'];
	while ($plate > 0 && $soap > 0) {
		$plate--;
		$soap-=0.5;
		echo "Осталось ".$plate. " тарелок и ". $soap . " моющего средства". "</br>" ;
	}
	if ($plate>0)
		echo "осталось ". $plate . " тарелок";
	if ($soap >0)
		echo "осталось ". $soap . " средства";
		
	//мой вариант
	// $plate = $_POST['plate'];
	// $soap = $_POST['soap'];
	// $i=0;
	// while ($plate>0 && $soap>0) {
	// 	$i++;
	// 	echo "<p>после мытья ".$i." тарелки осталось " . ($soap - 0.5) ."</p>";
	// 	$plate-=1;
	// 	$soap-=0.5;
	// }
	// if ($plate>0 || $soap>0) {
	// 	echo "<p>осталось тарелок: ". $plate. "</p>";
	// 	echo "<p>осталось средства: ". $soap. "</p>";
	// } else
	// 	echo "Все тарелки вымыты";
?>
<?php
echo "<pre>". print_r($_POST, true). "</pre>";
?>

<?php
		//часы - по текущему времени сформировать стрелочные часы
$sec = (int)date('s'); //получить дату, взять только секунды, пиревести в целое цначение
$sec = 1; //переобозначили
echo $sec . PHP_EOL;
$tablo = []; //матрица(массив строк)
$tablo[] = '\\\\\\\\\\\\||||//////';
$tablo[] = '\              /';
$tablo[] = '\              /';
$tablo[] = '\              /';
$tablo[] = '\              /';
$tablo[] = '\              /';
$tablo[] = '-              -';
$tablo[] = '-      ┌┐      -';
$tablo[] = '-      └┘      -';
$tablo[] = '-              -';
$tablo[] = '/              \\';
$tablo[] = '/              \\';
$tablo[] = '/              \\';
$tablo[] = '/              \\';
$tablo[] = '/              \\';
$tablo[] = '//////||||\\\\\\\\\\\\';

$side = (floor(($sec + 8) / 15)) % 4; //для определение стороны(ребра часов)
//$i //строка
//$k //столбец
switch ($side) {
	case 0:
		$i=0;
		//$sec +8 = от 61 до 68 и от 9 до 16
		$k = ($sec +8)%60 -1;
		break;
}
$tablo_out[$i][$k] = $tablo[$i][$k];

echo "<pre>";

// foreach ($tablo as $key => $row) { //каждую строку представить как ключ - значение
// 									//$key - это индекс массива, а $row - каждая строка
// 	//echo $key." : ".$row."<br>";
// 	echo $row."<br>";
// }

//echo print_r($tablo, true);

$tablo_out = [];
for ($i=0;$i<16;$i++) {
	for ($k=0; $k<16; $k++){
		$tablo_out[$i][$k];
	}
}
foreach ($tablo_out as $key => $row) {
	foreach ($variable as $key => $value) {
		# code...
	}
	//echo $key." : ".$row."<br>";
	echo $row."<br>";
}

echo "</pre>";
?>



<?php
		// загрузить файл на сервер (с помощью суперглоб массива $_FILE)
echo "<pre>";
// echo print_r($_FILES, true);
// if (isset($_FILES['userfile'])) {
// 	$file_info = pathinfo($_FILES['userfile']['name']);
// 	$destination = './test_dir/'.microtime(true).'.'.$file_info['extension']; //microtime(true) - микросек .....
// 	echo $destination;
// 	move_uploaded_file($_FILES['userfile']['tmp_name'],	//паеремещаем из временного каталога
// 	$destination); // в этот путь
// }

echo "</pre>";

?>
<form enctype="multipart/form-data" action="index.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>

<?php
// input name="userfile[]" multiple type="file" - [] значит в виде массива, multiple - можно посылать много файлов
?>



<?php
//задача - принимать только файлы с расширением .css и .jpg и помещать их в соответствующие папки
// на сервере
echo "<pre>";

echo print_r($_FILES, true);
/*
if (isset($_FILES['userfile'])) {
	$file_extension = pathinfo($_FILES['userfile']['name'])['extension'];
	echo "расширение файла: " . $file_extension;
	if ($file_extension == 'css' || $file_extension == 'jpg') {
		switch ($file_extension) {
			case 'css':
				$file_info = pathinfo($_FILES['userfile']['name']);
				$destination = './css/'.microtime(true).'.'.$file_info['extension'];
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
				break;
			case 'jpg':
				$file_info = pathinfo($_FILES['userfile']['name']);
				$destination = './img/'.microtime(true).'.'.$file_info['extension'];
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
				break;
		}
	} else
		echo "Не тот формат";
}
*/
if (isset($_FILES['userfile'])) {
	foreach ($_FILES['userfile']['name'] as $key => $name) {
		//echo $key." : ". $name ."<br>";
		$file_info = pathinfo($name);
		if ($file_info['extension'] == 'css') {
			$destination = './css/'.$key.microtime(true).'.css';
			move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $destination);
			echo "upload {$name} to {$destination}\n";
		}
		elseif ($file_info['extension'] == 'jpg') {
			$destination = './img/'.$key.microtime(true).'.jpg';
			move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $destination);
			echo "upload {$name} to {$destination}\n";
		} else echo "err {$name}\n";
	}
}

echo "</pre>";

?>

<form enctype="multipart/form-data" action="index.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    Отправить этот файл: <input name="userfile[]" multiple type="file" />
    <input type="submit" value="Send File" />
</form>