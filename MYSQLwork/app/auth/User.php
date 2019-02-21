<?php
namespace app\Auth;

class User {
	private $pdo;
	private $token;
	private $login = 'anonimous';
	private $user_id;
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

		//если пользователя нашли по логу и паролю(то есть если размер массива > 0), то логинем
		if(count($resalt) >0) {
			$this->login = $login;
			$this->user_id = $resalt[0]['id']; //или $resalt[0][0] так как данные дублируются;
			//сформируем токен
			$this->token = md5($login . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
			//сохраним так же в СЕССИЮ
			$_SESSION['user'] = [
					'login' => $this->login,
					'user_id' => $this->user_id,
					'token' => $this->token
			];
		}
		
	}
	public function  getUserName() { //на самом деле это getLogin
		return $this->login;
	}
	public function logout() {
		$this->user_id = null;
		$this->token = null;
		$this->login = 'anonimous';
		unset($_SESSION['user']);
	}
}