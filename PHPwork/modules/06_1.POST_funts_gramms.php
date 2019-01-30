<?php
					// Лекция 6

			//взаимодействие с пользователем(браузером)
//Ассоциативный массив параметров, переданных скрипту через URL.
# http://localhost/?name=Kirill
echo 'Hello ' . htmlspecialchars($_GET['name']); # Выводит: "Hello Kirill"
echo "<a href='?name=Kirill2&param_1=value_1&param_2=value_2&param_3=value_3'>Много параметров</a>";
# Выведем глобальный массив GET
echo '<pre>', 				//echo принимает набор параметров через запятую и выводит
	print_r($_GET, true),
	'</pre>';
echo "============================================";
//Ассоциативный массив данных, переданных скрипту методом HTTP POST.
echo "<form action='06_1.POST_funts_gramms.php' method='post'>
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

echo "============================================";
//задача
//Написать функцию, которая принимает из формы от пользователя целое число n
// и возвращает сумму квадратов всех чисел от 1 до n. 

echo "<form action='06_1.POST_funts_gramms.php' method='post'>
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
echo "============================================";
//задача
//Вывести на экран соответствие между весом в фунтах и весом в килограммах для значений 
//1, 2, ..., 10 (фунты).1 фунт = 453 г.
//принимать значение из формы(один инпут)

echo "<form action='06_1.POST_funts_gramms.php' method='post'>
	Введите вес в фунтах: <input name='number' type='text' />
	<input type='submit' value='Send' />
	</form>";
function getWeight($w) {
	return $w*453;
}
echo "в: ". ($_POST['number']). " фунтах " . getWeight($_POST['number']) . " грамм". "<br>";
echo "в: ". $_POST['number']. " фунтах " . getWeight($_POST['number'])/1000 . " килограмм". "<br>";

echo "============================================";
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
echo "<form action='06_1.POST_funts_gramms.php' method='post'>
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

?>