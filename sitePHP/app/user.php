<?php
// класс для аутинтификации
class User
{
	private $login = 'anonim';
	private $token;
	private $user_name;
	private $user_mail;
	private $is_auth = false; // авторизован или анонимный
	private $permissions = [	//пример массива разрешений для пользователя
		'view_profile'=> false
	];

	public function isAuth() { // проверяет авторизован или нет(вместо ф-ции isLogin())
		return $this->is_auth;
	}
	
	public function login($login, $password) { // авторизация
		if (self::hasUser($login)) { // проверка есть ли такой пользователь
			//если есть, тогда проверяем логин и пароль
			if (strcmp(self::getPassword($login),$password) === 0) { //strcmp() - возвр 0 если строки равны
				// то авторизуем
				//echo "проверили что логин-пароль совпадают"; echo "<br>";
				// echo "login: ".$login;echo "<br>";
				$_SESSION['login'] = $login; // $_POST['login'];
				$_SESSION['token'] = self::getToken();
				$this->login = $login;
				$this->token = self::getToken();
				$this->is_auth = true;
				// + заполнить поля объекта(пока только имя и почта)
				self::setParams($login);
			}
			else {
				//echo "пароль не совпадает"; echo "<br>";
				print("<script language=javascript>window.alert('не верный пароль');</script>");
				return false;	
			}
		} else {
			//echo "Нет такого пользователя "; echo "<br>";
			print("<script language=javascript>window.alert('нет такого пользователя');</script>");
			return false;
			
		}
		return true;
	}
	//сейчас не используется
	//ф-ция проверяет авторизован ли пользователь(совпадает ли токен и введен ли логин)
	public function isLogin() {
		$token = self::getToken();
		return (!empty($_SESSION['login']) && strcmp($token, $_SESSION['token']) === 0 );
	}
	// ф-ция проверяет есть ли такой пользователь в "базе данных"
	private static function hasUser($login) {
		$users = file('../app/users.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
		// echo "проверяем есть ли логин в базе<br>";
		foreach ($users as $user) { //$user - будет строка (пара лог-пасс)
			if(strpos($user,$login.':') === 0 ) { //strpos - возвращает позицию, с которой сторка $login.':'
			// начинается в строке $user. То есть если возвращается 0 значит логин есть в строке и он
			// начинается с начала строки
			//strstr - возвращает первое вхождение(позицию) подстроки в строку( и -1 если небыло совпадения)
				// echo "логин: $login в базе есть<br>";
				return true;
			}
		}
		return false; //
	}
	//ф-ция формирующая токен
	private static function getToken() {
		//echo "формируем token"; echo "<br>";
		return md5($_SESSION['login'] .
			$_SERVER['HTTP_USER_AGENT'] .
			$_SERVER['REMOTE_ADDR']
			//$_SERVER['HTTP_X_REAL_IP'] //почему-то не работает
		);
	}
	//ф-ция возвращает логин
	public function getLogin() {
		//return $_SESSION['login'];
		return $this->login;
	}
	public function getName() {
		return $this->user_name;
	}
	public function registerUser($login, $password, $arr_params) { //добавляет в файл строчку с логином и паролем(разделяем ":"") + $arr_params. в $arr_params - будут содержаться разные значения(телефон, адресс, email и тд), которые могут добавляться или меняться.

		// echo " регистрируем(добавляем логин, хэш пароля в файл, еще имя и почту)"; echo "<br>";
		file_put_contents('../app/users.db', $login.':'.$password.":"
			.$arr_params['name'].":".$arr_params['mail']."\n", FILE_APPEND);
		// + заполнить поля объекта
		$_SESSION['login'] = $login; 
		$_SESSION['token'] = self::getToken();
		$this->login = $login;
		$this->token = self::getToken();
		$this->is_auth = true;
		$this->user_name = $arr_params['name'];
		$this->user_mail = $arr_params['mail'];
	
	}
	private static function getPassword($login) {
		$password = false;
		$users = file('../app/users.db'); //читаем файл, получаем массив строк - каждая это логин-пароль
		foreach ($users as $user) { 
			if(strpos($user,$login.':') === 0 ) { //то есть если в строке встречается логин+:, то этонужая строка
				//$password = substr(trim($user), strlen($login)+1); //trim($user) - удаляет пробелы и перевод строки сначала и в конце строки
				$str = explode(':', trim($user));
				$password = $str[1];
				//echo "пароль в getPassword: ".$password;
				break;
			}
		}
		return $password;
	}
	//завершение сеанса (logout)
	public function logout() {
		unset($_SESSION['login']); //удалеем переменную в глобальном массиве
		$this->is_auth = false;
		$this->login = 'anonim';
		unset($_SESSION['token']);
	}
	//пока не используется
	public function hasPermission($action) {	// проверка прав (передаем название действия для проверки можно ли его совершить пользователю)
		if (isset($this->permissions[$action])) { //проверяем есть ли такое разрешение
			return $this->permissions[$action];
		}
		return false;
	}
	public function __construct() { // для идентификации пользователя на других страницах нашего сайта
		//То есть например залогинелись, перешли на другую страницу, при этом на той странице вначале 
		//создается объект пользователя и при этом срабатывает метод конструктора, который вызывает метод,
		//определяющий залогинен ли пользователь.
		//метод, который определяет по данным сессии залогинен пользователь или нет
		// и если да то заполнял бы поля объекта данными из прочитанного файла(данные брать по логину)
		self::isLoginANDputContentInUser();
	}
	//метод,который бы определял по данным сессии залогинен пользователь или нет
	// и если да то заполнял бы поля объекта данными из прочитанного файла(данные брать по логину)
	private function isLoginANDputContentInUser() {
		//определяем залогинен ли пользователь
		if(isset($_SESSION['login'])) {
			if(isset($_SESSION['token'])) {
				//генерируем новый токен
				$newtoken = md5($_SESSION['login'].$_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
				if($newtoken === $_SESSION['token']) { //сравниваем с тем, который записан в сессию при регистрации
					//echo "мы сравнили токены и они совпали"; echo "<br>";
					$this->is_auth = true;
					$this->login = $_SESSION['login'];
					// запускать парсер, который читает файл и выдает массив значений(имя, почта, адрес)
					// далее из массива значения переносить в поля объекта
					// пока попробуем с txt файлом
					self::setParams($_SESSION['login']);
				}
			}
		}
	}
	private function setParams($login) {
		$usersInfo = file('../app/users.db');//читаем из файла и получаем массив строк
		$len = count($usersInfo);
		for($i=0; $i<$len; $i++) {
			$vals = explode(":", $usersInfo[$i]); //массив подстрок строки $usersInfo[$i] по разделителю ':'
			if( trim($vals[0]) === $login) {
				//vals[1] - у нас это хеш пароля
				$this->user_name = $vals[2];
				$this->user_mail = $vals[3];
			}
		}
	}
	//пока не используется
	public function getAllPermissions() {
        return $this->permissions;
    }
}

?>