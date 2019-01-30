<?php
						// Лекция 7 - продолжение
//Спросить количество тарелок и количество моющего средства.
// Моющее средство расходуется из расчета 0.5 на одну тарелку.
// В цикле выводить сколько моющего средства осталось после мытья каждой тарелки.
// В конце вывести сколько тарелок осталось, когда моющее средство закончилось или наоборот.


?>

<form method="post" action="07_3.washing_ plates.php">
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
