<?php
function printFoamLogin() {
	echo "
		<form method='post' action='09_2.COOKIE_registration.php'>
			<div>
				<label for='Login'>Логин</label>
				<input id='Login' name='login' placeholder='Ведите логин'>
			</div>
			<div>
				<label for='Password'>Пароль</label>
				<input id='Password' name='password' type='password' placeholder='Ведите пароль'>
			</div>
			<button>Войти</button>
		</form>
	";
}
function login() {
	// есть ли запись в базе данных(в файле)
	$login = $_POST['login'];
	$password = $_POST['password'];
	echo "полученный из POST пароль: ".$password."<br>";
	//hasUser('$login'); //ф-ция определяет есть ли такой пользователь
	if (hasUser($login)) { // проверка есть ли такой пользователь
		//если есть, тогда проверяем пароль
		$realpass = getPassword($login);
		echo "сравним ".$realpass." и ".$password."<br>";
		if (strcmp(getPassword($login),$password) === 0) {	//strcmp() - возвр 0 если строки равны
						// напрямую строки сравнивать в php нельзя, только через ф-цию
			// тогда авторизуем
			echo "с возвращением ".$login."<br>";
			setcookie('login', $_POST['login']);
			$_COOKIE['login'] = $_POST['login'];
		}
		else {
			return false;
		}
	} else {
		echo "регистрируем<br>";
		//если нет пользователя, то регистрируем
		//пишем в файл связку логин-пароль
		registrUser($login, $password);
		//создаем куки
		setcookie('login', $_POST['login']);
		// то есть сделали пару - ключ-значение - это создали куки и подготовили для отправки браузеру
		// setcookie() задает cookie, которое будет передано клиенту вместе с другими HTTP заголовками.
		// После передачи клиенту, cookie станут доступны через массивы $_COOKIE и $HTTP_COOKIE_VARS при СЛЕДУЮЩЕЙ ЗАГРУЗКЕ страницы("запаздывание").
		$_COOKIE['login'] = $_POST['login']; // в сам массив $_COOKIE записываем логин
		// (чтобы избежать "запаздывания")
	}
	return true;
}
//ф-ция сообщает авторизован пользователь или нет
function isLogin() {
	// if (!empty($_COOKIE['login'])) return true;
	// else false
	// или просто
	return !empty($_COOKIE['login']);
}
function getUserName() {
	return $_COOKIE['login'];
}
function logOut() {
	setcookie('login');	//удаляем куки
	unset($_COOKIE['login']); //удалеем переменную в глобальном массиве
}
// ф-ция проверяет есть ли такой пользователь в "базе данных"
function hasUser($login) {
	$users = file('./users_for9_2.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
	echo "проверяем есть ли логин в базе<br>";
	foreach ($users as $user) { //$user - будет строка (пара лог-пасс)
		if(strpos($user,$login.':') === 0 ) { //strpos - возвращает позицию, с которой сторка $login.':'
		// начинается в строке $user. То есть если возвращается 0 значит логин есть в строке и он
		// начинается с начала строки
		//strstr - возвращает первое вхождение(позицию) подстроки в строку( и -1 если небыло совпадения)
			echo "логин: $login в базе есть<br>";
			return true;
		}
	}
	return false; //
}
function getPassword($login) {
	$password = false; //начальное положение
	$users = file('./users_for9_2.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
	
	foreach ($users as $user) { 
		if(strpos($user,$login.':') === 0 ) { 
			$password = substr(trim($user), strlen($login)+1); //trim($user) - удаляет пробелы и перевод
			//строки сначала и в конце строки. substr($st1,n) - возвращает подстроку из строки $st1,начиная
			// с позиции n. strlen($st) - возвращает длину строки
			break;
		}
	}
	return $password;
}
function registrUser($login, $password) { //добавляет в файл стрчку с логином и паролем(разделяем :)
	file_put_contents('./users_for9_2.db', $login.':'.$password."\n", FILE_APPEND);

}

?>