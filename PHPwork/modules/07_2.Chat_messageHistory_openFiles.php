<?php
					// Лекция 7 - продолжение
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
	$messages =  file('../history.txt');//для всех сообщений - считываем файл и получаем массив строк
	foreach ($messages as $mes) { // перебираем каждую строку массива $messages
		echo "<p>". $mes. "</p>"; //выводим
	}
	//обработка текущего сообщ
	if (isset($_POST['message']) && strlen($_POST['message'])>0) {
	
		$mes = $user_name. " ( ". date("H:i:s")."): ". $_POST['message'];
		//надо бы еще проверить существует ли файл history.txt
		file_put_contents('../history.txt', $mes . PHP_EOL , FILE_APPEND); //file_put_contents - идентична
		//последовательным успешным вызовам функций fopen(), fwrite() и fclose().
		//Если filename не существует, файл будет создан. Иначе, существующий файл будет перезаписан,
		//за исключением случая, если указан флаг FILE_APPEND(тогда дозаписывает в конец).
		echo "<p>" . $mes. "</p>"; //выводим сообщение
	}
	?>
</div>
<form method="post" action="07_2.Chat_messageHistory_openFiles.php">
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
