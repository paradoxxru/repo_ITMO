<?php
// класс для аутинтификации
class User
{
	private $login;
	private $token;
	private $user_name;
	private $user_mail;
	private $is_auth = false; // авторизован или анонимный
	private $permissions = [
		'view_profile'=> false
	];

	public function isAuth() { // проверяет авторизован или нет
		return $this->is_auth;
	}
	
	public function login($login, $password) { // авторизация
		if (self::hasUser($login)) { // проверка есть ли такой пользователь
		//если есть, тогда проверяем логин и пароль
			if (strcmp(self::getPassword($login),$password) === 0) { //strcmp() - возвр 0 если строки равны
				// то авторизуем
				echo "проверили что логин-пароль совпадают"; echo "<br>";
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['token'] = self::getToken();
			}
			else {
				echo "пароль не совпадает"; echo "<br>";
				return false;	
			}
		} else {
			//если нет пользователя, то регистрируем
			//пишем в файл связку логин-пароль(логин и хэш пароля)
			echo "логина нет,"; echo "<br>";
			self::registerUser($login, $password);
			$_SESSION['login'] = $login; 
			$_SESSION['token'] = self::getToken();
		}
		return true;
	}
	//ф-ция проверяет авторизован ли пользователь(совпадает ли токен и введен ли логин)
	public function isLogin() {
		$token = self::getToken();
		return (!empty($_SESSION['login']) && strcmp($token, $_SESSION['token']) === 0 );
	}
	// ф-ция проверяет есть ли такой пользователь в "базе данных"
	private static function hasUser($login) {
		$users = file('users_for12_2.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
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
	//ф-ция формирующая токен
	private static function getToken() {
		//echo "формируем token"; echo "<br>";
		return md5($_SESSION['login'] .
			$_SERVER['HTTR_USER_AGENT'] .
			$_SERVER['REMOTE_ADDR'] .
			$_SERVER['HTTP_X_REAL_IP']
		);
	}
	//ф-ция возвращает логин из массива $_SESSION
	public function getLogin() {
		return $_SESSION['login'];
}
	private static function registerUser($login, $password) { //добавляет в файл стрчку с логином и паролем(разделяем ":"")
		echo " регистрируем(добавляем логин, хэш пароля в файл)"; echo "<br>";
		file_put_contents('users_for12_2.db', $login.':'.$password."\n", FILE_APPEND);
	
	}
	private static function getPassword($login) {
		$password = false;
		$users = file('./users_for12_2.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
		foreach ($users as $user) { 
			if(strpos($user,$login.':') === 0 ) { 
				$password = substr(trim($user), strlen($login)+1); //trim($user) - удаляет пробелы и перевод строки сначала и в конце строки
				break;
			}
		}
		return $password;
	}

	public function logout() { //завершение сеанса
		unset($_SESSION['login']); //удалеем переменную в глобальном массиве
	}
	public function registration($login, $password, $params) { // регистрация. в $params - будут содержаться разные значения(телефон, адресс и тд), которые могут добавляться или меняться

	}
	public function hasPermission($action) {	// проверка прав (передаем название действия для проверки можно ли его совершить пользователю)
		if (isset($this->permissions[$action])) { //проверяем есть ли такое разрешение
			return $this->permissions[$action];
		}
		return false;
	}
	public function __construct() { // для идентификации пользователя на других страницах сайта

	}
}

?>