<?php
								//Лекция 6 - продолжение
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
echo "<form action='06_2.Currency_Converter.php' method='post'>
	рубли: <input name='rubls' type='text' placeholder='{$rubls}' /><br>
	доллары: <input name='dollars' type='text' placeholder='{$dollars}' /><br>
	евро: <input name='euro' type='text' placeholder='{$euro}' /><br>
	<input type='submit' value='Send' />
	</form>";
//выводим для проверки
echo '<pre>', 				
	print_r($_POST, true),
	'</pre>';

?>