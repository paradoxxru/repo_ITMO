<?php
							// Лекция 5

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

?>

<pre>
<?php
print_r($a); //выводим внутри <pre чтобы сохранить форматирование
?>
</pre>

<!--или так -->
<?php
echo "<pre>" . print_r($a, true) . '</pre>';
?>

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
?>