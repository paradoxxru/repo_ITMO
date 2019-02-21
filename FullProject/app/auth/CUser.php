<?php
namespace app\auth;

class CUser {
	protected $pdo;
	private $login = 'anonim';
	private $token;
	private $user_id;
	private $user_name;
	private $user_mail;
	private $user_phone;
	private $user_adder;
	private $is_auth = false; // авторизован или анонимный
	private $permissions = [	//пример массива разрешений для пользователя
		'view_profile'=> false
	];

	public function __construct($pdo) {
		$this->pdo = $pdo;
		//провести авторизацию
		//сначало проверим авторизован ли польз - проверям есть ли токен и совпадает ли он
		if(!$this->isAuth()) {
			//если не авторизован, то пытаемся залогинеть
			if(isset($_POST['login']) && isset($_POST['password'])) {
				$this->login($_POST['login'], $_POST['password']);
			}
		}
	}
	// проверка авторизован ли пользователь
	public function isAuth() {
		//если в $this->user_id есть значение, то значит пользователь залогинен
		//(чтобы не делать еще раз проверку по сессии, например на других страницах)
		if($this->user_id !== null) return true;

		if(
			isset($_SESSION['user']) &&
			isset($_SESSION['user']['token']) &&
			isset($_SESSION['user']['login']) &&
			$_SESSION['user']['token'] === md5(
						$_SESSION['user']['login']
						.$_SERVER['REMOTE_ADDR']
						.$_SERVER['HTTP_USER_AGENT']
			)
		) {
			//значит авторизуем
			$this->user_id = $_SESSION['user']['user_id'];
			$this->login = $_SESSION['user']['login'];
			$this->user_name = $_SESSION['user']['name'];
			//заполнить остальные поля
			return true;
		}
		return false;
	}
	//пытаемся залогинеть
	public function login($login,$password) {
		//сравнить из базы данных
		$query = "SELECT  * FROM `user` WHERE login = :login AND password = :password;";
		// :login - то есть будет подставлена переменная

		//передаем запрос, параметры(лог и пасс) и получаем массив(нумерованный + ассоц)
		$password = md5($password);
		$resalt = $this->pdo->prepare($query); // подготовка запроса
		$resalt->bindParam('login', $login); // передаем первый параметр
		$resalt->bindParam('password', $password); // передаем второй параметр
		
		$resalt->execute(); //выполнить запрос
		$resalt = $resalt->fetchAll();
		// echo "результат запроса логина и пароля<br>";
		// echo "<pre>";
		// var_dump($resalt);
		// echo "</pre>";

		//если пользователя нашли по логу и паролю(то есть если размер массива > 0), то логинем
		if(count($resalt) >0) {
			$this->login = $login;
			$this->user_id = $resalt[0]['id']; //или $resalt[0][0] так как данные дублируются
			$this->user_name = $resalt[0]['name'];
			$this->user_mail = $resalt[0]['email'];
			$this->user_phone = $resalt[0]['phone'];
			$this->user_adders = $resalt[0]['addres'];
			//сформируем токен
			$this->token = md5($login . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
			//сохраним так же в СЕССИЮ
			$_SESSION['user'] = [
					'login' => $this->login,
					'user_id' => $this->user_id,
					'token' => $this->token,
					'name' => $this->user_name
			];
		}
		
	}
	// регистрация
	public function registration() {

	}
	public function logout() {
		$this->user_id = null;
		$this->token = null;
		$this->login = 'anonim';
		unset($_SESSION['user']);
	}
	public function getUserName() {
		return $this->user_name;
	}
	public function getLogin() {
		return $this->login;
	}
	public function getUserId() {
		return $this->user_id;
	}
}