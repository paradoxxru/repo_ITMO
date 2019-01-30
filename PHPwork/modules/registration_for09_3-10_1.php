<?php
function printFormLogin() {
	echo "
		<form method='post' action='09_3-10_1.SESSION_MD5_registration.php'>
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
	//hasUser($login) - ф-ция определяет есть ли такой пользователь(такая переменная)
	if (hasUser($login)) { // проверка есть ли такой пользователь
		//если есть, тогда проверяем пароль
		if (strcmp(getPassword($login),$password) === 0) { //strcmp() - возвр 0 если строки равны
			// то авторизуем
			$_SESSION['login'] = $login;
			$_SESSION['token'] = getToken();
			echo "с возвращением ".$login."<br>";
		}
		else {
			return false;	
		}
	} else {
		echo "регистрируем<br>";
		//если нет пользователя, то регистрируем(пишем в файл данные) и авторизуем
		//пишем в файл связку логин-пароль(логин и хэш пароля)
		registrUser($login, $password);
		//авторизуем
		$_SESSION['login'] = $login; // логин храним в массиве $_SESSION
		$_SESSION['token'] = getToken(); //в массив $_SESSION добавили поле token
	}
	return true;
}
//ф-ция сообщает авторизован пользователь или нет
function isLogin() {
	$token = getToken();
	return (!empty($_SESSION['login']) && strcmp($token, $_SESSION['token']) === 0 ); //то есть проверяем
	// не только есть ли логтн в массиве $_SESSION, но и соответствует ли token токену в сессии
}
function getUserName() {
	return $_SESSION['login']; 
}
function logOut() {
	//setcookie('login');	//удаляем куки
	unset($_SESSION['login']); //удалеем переменную в глобальном массиве
}
// ф-ция проверяет есть ли такой пользователь в "базе данных"
function hasUser($login) {
	$users = file('../users.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
	echo "проверяем есть ли логин в базе<br>";
	foreach ($users as $user) { //$user - будет строка (пара лог-пасс)
		if(strpos($user,$login.':') === 0 ) { //strpos - возвращает позицию, с которой сторка $login.':'
		// начинается в строке $user. То есть если возвращается 0 значит логин есть в строке и он
		// начинается с начала строки
			echo "логин: $login в базе есть<br>";
			return true;
		}
	}
	echo "логин: $login отсутствует в базе<br>";
	return false; //
}
function getPassword($login) {
	$password = false;
	$users = file('../users.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
	
	foreach ($users as $user) { 
		if(strpos($user,$login.':') === 0 ) { 
			$password = substr(trim($user), strlen($login)+1); //trim($user) - удаляет пробелы и перевод
			// строки сначала и в конце строки. substr($st1,n) - возвращает подстроку из строки $st1,
			// начиная с позиции n.
			break;
		}
	}
	return $password;
}
function registrUser($login, $password) { //добавляет в файл стрчку с логином и паролем(разделяем :)
	file_put_contents('../users.db', $login.':'.$password."\n", FILE_APPEND);
	
}
//ф-ция формирующая токен
function getToken() { //можно добавить еще какие-нибудь значения
	return md5($_SESSION['login'] .
		$_SERVER['HTTR_USER_AGENT'] .
		$_SERVER['REMOTE_ADDR'] .
		$_SERVER['HTTP_X_REAL_IP']
	); //массив $_SERVER содержит разную информацию о подключенном пользователе: HTTR_USER_AGENT - 
	// это например версия браузера, REMOTE_ADDR -ip адрес пользователя(но может быть "искаженным" прокси), 
	// HTTP_X_REAL_IP - реальный(белый) ip адрес пользователя
}

?>