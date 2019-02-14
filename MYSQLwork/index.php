<?php

//запросы MYSQL
require_once('config.php');

//создание подключения к базе данных
//DPO - это класс для подключения баз данных
// $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}",
// 				$db_user,
// 				$db_user_pass);

//сразу отловим ошибки(если ошибка в данных, которые используются при подключении к базе, то на экран вылезет инфа о нашей попытке подключения, где будут указаны параметры подключения, а это логин, пароль, хост)
try {
	$pdo = new PDO("mysql:host={$db_host};dbname={$db_name}",
				$db_user,
				$db_user_pass);
} catch (Exception $e) {
	die("<h1>Error</h1>");
}

$result = $pdo->query("SELECT * FROM cpu;"); // query возвращает объект, содержащий результаты запроса
$result = $result->fetchAll(); //получаем массив строк(это делает метод fetchAll - из класса PDO)
//в полученном массиве значения будут дублироваться(как будто два массива - один ассоц., второй нумерованный со
//значениями ассоциативного)

//выведем результат
echo "<pre>";
foreach ($result as $row) {
	echo "<p>".print_r($row, true)."</p>";
}
echo "</pre>";

//теперь выведем в виде таблицы
echo "<table style='border:1px solid black'>";
foreach ($result as $row) {
	echo "<tr>"
		."<td>{$row['id']}</td>"
		."<td>{$row['frequency']}</td>"
		."<td>{$row['weight']}</td>"
		."<td>{$row['cost']}</td>"
		."<td>{$row['count']}</td>"
		."<td>{$row['name']}</td>"
		."</tr>";
}
echo "</table>";

//
// SELECT comp.name, comp.cpu_id, comp.cost,
// 		cpu.id, cpu.name
// FROM comp		
// LEFT JOIN cpu
// 	on comp.cpu_id = cpu.id
// WHERE 
// 	comp.cost > 1000
// ORDER BY comp.cost ASC
// LIMIT 10;
$result1 = $pdo->query("SELECT comp.name as compname, 
								comp.cpu_id as compcpuid, 
								comp.cost as cost,
								cpu.id as cpuid, 
								cpu.name as cpuname
						FROM comp
						LEFT JOIN cpu
							on comp.cpu_id = cpu.id
						WHERE 
						 	comp.cost > 1000
						ORDER BY comp.cost ASC
						LIMIT 10;");
$result1 = $result1->fetchAll();
// echo "<pre>";
// var_dump($result1);
// echo "</pre>";

//вывод
echo "<table>";
	echo "<th>comp_name</th>"
		."<th>comp_cpu_id</th>"
		."<th>comp_cost</th>"
		."<th>cpu_id</th>"
		."<th>cpu_name</th>";
foreach ($result1 as $row) {
	echo "<tr>"
		."<td>{$row['compname']}</td>"
		."<td>{$row['compcpuid']}</td>"
		."<td>{$row['cost']}</td>"
		."<td>{$row['cpuid']}</td>"
		."<td>{$row['cpuname']}</td>"
		."</tr>";
}
echo "</table>";

//таблица корпусов - id, вес, цена, мощ бП - сделать через командную строку
//вывести результат обединения таблиц comp и case
$result3 = $pdo->query("SELECT comp.name as comp_name,
								cpu.name as cpu_name,
								comp.case_id,
								comp.cost
						FROM comp
						LEFT JOIN cpu
							on comp.cpu_id = cpu.id
						WHERE 
						 	comp.cost > 1000
						ORDER BY comp.cost ASC
						LIMIT 10;");
$result3 = $result3->fetchAll();
//вывод
echo "<table>";
	echo "<th>Компьютер</th>"
		."<th>Процессор</th>"
		."<th>Корпус</th>"
		."<th>Цена ПК</th>";
foreach ($result3 as $row) {
	echo "<tr>"
		."<td>{$row['comp_name']}</td>"
		."<td>{$row['cpu_name']}</td>"
		."<td>{$row['case_id']}</td>"
		."<td>{$row['cost']}</td>"
		."</tr>";
}
echo "</table>";

//////// выведем данные по cpu
$str = "
SELECT
	comp.name as NAME_PC,
	cpu.name as CPU,
	cpu.weight as Weight,
	cpu.cost as selfcost,
	comp.cost as Cost
FROM comp
LEFT JOIN cpu ON comp.cpu_id = cpu.id
LIMIT 5;
";
?>
<br/>
<table style="border:1px solid black;">
	<tr>
		<th>Компьютер</th>
		<th>CPU</th>
		<th>Вес</th>
		<th>Себестоимость</th>
		<th>Стоимость сборки</th>
	</tr>
<?php
$result4 = $pdo->query($str)->fetchAll();	// можно сразу вызывать fetchAll
if(count($result4)>0) {
	foreach ($result4 as $row) {
		echo "<tr>"
			."<td>{$row['NAME_PC']}</td>"
			."<td>{$row['CPU']}</td>"
			."<td>{$row['Weight']}</td>"
			."<td>{$row['selfcost']}</td>"
			."<td>{$row['Cost']}</td>"
			."</tr>";
	}
} else {
	echo "<tr colspan='5'><td>Нет подходящих товаров</td></tr>";
}
//или - проверять результат и если длина меньше 1, то заполнять прочерками
// if(count($result4)<1) {
// 	$result4[] = [
// 			'NAME_PC'=>'-'	,
// 			'CPU'=>'-'	,
// 			'Weight'=>'-'	,
// 			'selfcost'=>'-'	,
// 			'Cost'=>'-'	,
// 	]
// }
// foreach ($result4 as $row) {
// 		echo "<tr>"
// 			."<td>{$row['NAME_PC']}</td>"
// 			."<td>{$row['CPU']}</td>"
// 			."<td>{$row['Weight']}</td>"
// 			."<td>{$row['selfcost']}</td>"
// 			."<td>{$row['Cost']}</td>"
// 			."</tr>";
// 	}
echo "</table>";


//// тоже самое, но по корпусу
$str = "
SELECT 
	comp.name as NAME_PC,
	`case`.powerBP as `Power`,
	`case`.weight as Weight,
	`case`.cost as Selfcost,
	comp.cost as Cost
FROM comp
LEFT JOIN `case` ON comp.case_id = `case`.id
LIMIT 6;
";
?>
<br/>
<table style="border:1px solid black;">
	<tr>
		<th>Компьютер</th>
		<th>Корпус</th>
		<th>Вес</th>
		<th>Себестоимость</th>
		<th>Стоимость сборки</th>
	</tr>
<?php
$result5 = $pdo->query($str)->fetchAll();	//
if(count($result5)>0) {
	foreach ($result5 as $row) {
		echo "<tr>"
			."<td>{$row['NAME_PC']}</td>"
			."<td>{$row['Power']}</td>"
			."<td>{$row['Weight']}</td>"
			."<td>{$row['Selfcost']}</td>"
			."<td>{$row['Cost']}</td>"
			."</tr>";
	}
} else {
	echo "<tr colspan='5'><td>Нет подходящих товаров</td></tr>";
}
echo "</table>";

// теперь вывести данные по cpu и case(будем складывать веса и себестоимости)

//полная объединенная инфа
$str = "
SELECT
	comp.name as NamePC,
	comp.cost as Cost,
	`case`.powerBP as `Power`,
	SUM(disk.`value`) as sumValueDisks,
	SUM(disk.cost) as sumCostDisks,
	(cpu.weight + `case`.weight) as Wcpu_case,
	(cpu.cost + `case`.cost) as Ccpu_case,
	IFNULL(SUM(disk.weight), 0) as SumDiskWeight,
	IFNULL(cpu.weight, 0) + IFNULL(`case`.weight, 0) + IFNULL(SUM(disk.weight), 0) as SumWeight,
	IFNULL(cpu.cost,0) + IFNULL(`case`.cost,0) + IFNULL(SUM(disk.cost),0) as `Selfcost(CPU,Case,Disks)`
FROM comp
LEFT JOIN compdisk ON comp.id = compdisk.comp_id
LEFT JOIN disk ON compdisk.disk_id = disk.id
LEFT JOIN cpu ON comp.cpu_id = cpu.id
LEFT JOIN `case` ON `case`.id = comp.case_id
GROUP BY comp.id
LIMIT 10;
";
?>
<br/>
<table style="border:1px solid black;">
	<tr>
		<th>Компьютер</th>
		<th>Цена</th>
		<th>Мощность</th>
		<th>сум объем дисков</th>
		<th>сум стоим дисков</th>
		<th>вес(проц+корп)</th>
		<th>цена(проц+корп)</th>
		<th>сум вес дисков</th>
		<th>общий вес</th>
		<th>общая стоимость</th>
	</tr>
<?php
$result6 = $pdo->query($str)->fetchAll();
if(count($result6)>0) {
	foreach ($result6 as $row) {
		echo "<tr>"
			."<td>{$row['NamePC']}</td>"
			."<td>{$row['Cost']}</td>"
			."<td>{$row['Power']}</td>"
			."<td>{$row['sumValueDisks']}</td>"
			."<td>{$row['sumCostDisks']}</td>"
			."<td>{$row['Wcpu_case']}</td>"
			."<td>{$row['Ccpu_case']}</td>"
			."<td>{$row['SumDiskWeight']}</td>"
			."<td>{$row['SumWeight']}</td>"
			."<td>{$row['Selfcost(CPU,Case,Disks)']}</td>"
			."</tr>";
	}
} else {
	echo "<tr colspan='10'><td>Нет подходящих товаров</td></tr>";
}
echo "</table>";

// Лекция 7 (отдельный класс для запросов!!!)
require_once "public/Complist.php";
$list = new Complist($pdo);
//$comps = $list->setLimit(10)->getArray();
$comps = $list->setLimit(10)->getList();
// echo "<pre>";
// print_r($comps);
// echo "</pre>";
echo "<table>";
foreach ($comps as $comp) {
	echo $comp->render();
}
echo "</table>";


// сформировать таблицы user и orders и вывести в html
 


$pdo = null; //чистим переменную, освобождаем память