<?php
						// Лекция 8 - продолжение

		// загрузить файл на сервер (с помощью суперглоб массива $_FILE)
// $_FILES содержит всю информацию о загруженных файлах.
// пример
// Array (
//     [userfile] => Array (
//         [name] => jshtm.zip
//         [type] => application/x-zip-compressed
//         [tmp_name] => /tmp/phpAE.tmp
//         [size] => 21344
//         [error] => 0
//     )
// )


echo "<pre>";
// echo print_r($_FILES, true);
// if (isset($_FILES['userfile'])) {
// 	$file_info = pathinfo($_FILES['userfile']['name']);
// 	$destination = '../test_dir/'.microtime(true).'.'.$file_info['extension']; 
//microtime(true) - возвращает микросекунды - нужно для изменения имени файлов
// 	echo $destination;
// 	move_uploaded_file($_FILES['userfile']['tmp_name'],	//перемещаем из временного каталога
// 	$destination); // в этот путь
// }

echo "</pre>";

?>
<form enctype="multipart/form-data" action="08_2._FILES_uploadToServer.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>

<?php
// input name="userfile[]" multiple type="file" - [] значит в виде массива, multiple - можно посылать много файлов
?>



<?php
echo "===========================================";
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
				$destination = '../css/'.microtime(true).'.'.$file_info['extension'];
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
				break;
			case 'jpg':
				$file_info = pathinfo($_FILES['userfile']['name']);
				$destination = '../img/'.microtime(true).'.'.$file_info['extension'];
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
				break;
		}
	} else
		echo "Не тот формат";
}
*/
// сделать мультизагрузку файлов(чтобы отправлять несколько файлов)
if (isset($_FILES['userfile'])) {
	foreach ($_FILES['userfile']['name'] as $key => $name) {
		//echo $key." : ". $name ."<br>";
		$file_info = pathinfo($name);
		if ($file_info['extension'] == 'css') {
			$destination = '../css/'.$key.microtime(true).'.css'; //добавили значение .$key. в имя,
			//иначе при загрузке нескольких файлов они будут затираться в конечной папке(так как
			// время в микросекундах будет совпадать)
			move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $destination);
			echo "upload {$name} to {$destination}\n";
		}
		elseif ($file_info['extension'] == 'jpg') {
			$destination = '../img/'.$key.microtime(true).'.jpg';
			move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $destination);
			echo "upload {$name} to {$destination}\n";
		} else echo "err {$name}\n";
	}
}

echo "</pre>";

?>

<form enctype="multipart/form-data" action="08_2._FILES_uploadToServer.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    Отправить этот файл: <input name="userfile[]" multiple type="file" />
    <input type="submit" value="Send File" />
</form>
