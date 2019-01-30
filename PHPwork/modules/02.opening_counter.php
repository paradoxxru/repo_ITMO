<!--Лекция 2-->

<html><?php
$a ="!!!"; ?><head><?php echo "\n"; ?></head>
<?php //echo "<body>"; echo "<h1>"; 
?>
Hello World<?php echo $a; ?></h1>
</body>
</html>


<?php

//считаем кол-во посещений(открытия страницы)
$c = file_get_contents('../counter.txt'); //counter.txt - будет хранить инфу, file_get_contents - возвращает содержимое файла
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
file_put_contents('../counter.txt', $c); //запись в файл значения переменной $c с перезаписью
											//(запись поверх содержимого)

?>

<?php
				//константы

	echo "<br>";
	define('HELLO_WORLD', 'Hello World!'); //define - объявление константы
											//HELLO_WORLD - имя константы
											//'Hello World!' - значение константы
    echo HELLO_WORLD;
    echo $a;//из предыдущего примера

?>

<?php

echo "<pre>";

echo "<br>";
//приведение типов
$a1 = '12.34 fdfds';
$a2 = 12.34;
$a3 = true;
$a4 = 0.0;
$a5 = 0.00000000000000000000000000001;

/*посмотрим преобразования
(int), (integer)
(bool), (boolean)
(float), (double), (real)
(string)
(array)
(object)
*/

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


echo "<br>";
/*
	&=  - побитовая логич операция(каждый бит переменной сранивается)
	|=
	^=  - побитовое отрицание
	>>=  - сдвиг побитный
	<<=
*/

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


$a = 4;
$a = 1 + $a = 2;
var_dump($a); // будет 3 !!! так как идем при присваивании справа налево

$a = true and false; //будет true !!!!
var_dump($a); 
$a = (true and false);
var_dump($a); 

echo "</pre>";

?>