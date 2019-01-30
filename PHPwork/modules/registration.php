<?php
function printFormLogin() {
	echo "
		<form method='post' action='/'>
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
	$password = md5($_POST['password']); // md5($password) - возвращает хэш(то есть шифруем)
	//hasUser('$login'); //ф-ция определяет есть ли такой пользователь
	if (hasUser($login)) { // проверка есть ли такой пользователь
		//если есть, тогда проверяем логин и пароль
		// @todo сделать проверку на корректный пароль
		//$pass = getPassword($login);
		if (strcmp(getPassword($login),$password) === 0) { //strcmp() - возвр 0 если строки равны
			// то авторизуем
			//setcookie('login', $_POST['login']); //теперь не надо
			$_SESSION['login'] = $_POST['login'];  //$_COOKIE['login'] = $_POST['login'];
			$_SESSION['token'] = getToken(); 
		}
		else {
			return false;	
		}
	} else {
		//если нет пользователя, то регистрируем
		//пишем в файл связку логин-пароль(логин и хэш пароля)
		registrUser($login, $password);
		//создаем куки
		//setcookie('login', $_POST['login']); // теперь не надо
		// то есть сделали пару - ключ-значение - это создали куки и подготовили для отправки браузеру
		// setcookie() задает cookie, которое будет передано клиенту вместе с другими HTTP заголовками.
		// После передачи клиенту, cookie станут доступны через массивы $_COOKIE и $HTTP_COOKIE_VARS при СЛЕДУЮЩЕЙ ЗАГРУЗКЕ страницы("запаздывание").
		$_SESSION['login'] = $login; //$_COOKIE['login'] = $_POST['login']; // в сам массив $_COOKIE записываем логин
		// (чтобы избежать "запаздывания")
		$_SESSION['token'] = getToken();
	}
	return true;
}
//ф-ция сообщает авторизован пользователь или нет
function isLogin() {
	$token = getToken();
	// if (!empty($_COOKIE['login'])) return true;
	// else false
	// или просто
	return (!empty($_SESSION['login']) && strcmp($token, $_SESSION['token']) === 0 ); //return !empty($_COOKIE['login']);
}
function getUserName() {
	return $_SESSION['login']; //return $_COOKIE['login'];
}
function logOut() {
	//setcookie('login');	//удаляем куки(теперь не надо)
	unset($_SESSION['login']); //unset($_COOKIE['login']); //удалеем переменную в глобальном массиве
}
// ф-ция проверяет есть ли такой пользователь в "базе данных"
function hasUser($login) {
	$users = file('./users.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
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
	$password = false;
	$users = file('./users.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
	
	foreach ($users as $user) { 
		if(strpos($user,$login.':') === 0 ) { 
			$password = substr(trim($user), strlen($login)+1); //trim($user) - удаляет пробелы и перевод строки сначала и в конце строки
			break;
		}
	}
	return $password;
}
function registrUser($login, $password) { //добавляет в файл стрчку с логином и паролем(разделяем :)
	file_put_contents('users.db', $login.':'.$password."\n", FILE_APPEND);
	
}
//ф-ция формирующая токен
function getToken() {
	return md5($_SESSION['login'] .
		$_SERVER['HTTR_USER_AGENT'] .
		$_SERVER['REMOTE_ADDR'] .
		$_SERVER['HTTP_X_REAL_IP']
	);
}



?>