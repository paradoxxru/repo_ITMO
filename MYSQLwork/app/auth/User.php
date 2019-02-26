<?php
namespace app\Auth;

class User {
	private $pdo;
	private $token;
	private $login = 'anonimous';
	private $user_id;
	private $reg_status = 0; //0 - не было попыток ркгистрации, 1 - если прошла успешно , 2- не прошла
	public const REG_NONE = 0;
	public const REG_SUCCESS = 1;
	public const REG_FAILED = -1;

	private $privileges = [];

	private $avatar;

	public function __construct($pdo) {
		$this->pdo = $pdo;
			//провести авторизацию
		//сначало проверим авторизован ли польз - проверям есть ли токен и совпадает ли он
		if(!$this->isAuth()) {
			//если не авторизован, то пытаемся зарегистрировать(если есть параметр 'type') или залогинеть
			if(isset($_POST['login']) && isset($_POST['password'])) {
				if(isset($_POST['type']) && $_POST['type']==='reg') {
					echo "пытаемся зарегить<br>";
					$this->registration(
						$_POST['login'],
						$_POST['password'],
						$_POST['email'],
						$_POST['phone']
					);
				}
				//после того как зарегистрировали логинемся
				echo "пытаемся залогинеть<br>";
				$this->login($_POST['login'], $_POST['password']);
			}

		}
		//установка прав( у администратора id=1)
		if($this->user_id == 1) {
			$this->privileges = [
						'user_delete' => true,
						'user_list' =>true,
						'user_read' =>true
			];
		}
		//обработка аватарок
		if($this->isAuth() && isset($_FILES['avatar'])) { //добавить обработчик пустого файла(отправки без файла)
			echo "<pre>";
			print_r($_FILES);
			echo "</pre>";


			//удалять старые аватарки
			if(!empty($this->avatar)) {
				unlink(__DIR__."/../../img/avatars/". $this->avatar);
			}
			

			//новое имя файла
			$new_fn = __DIR__."/../../img/avatars/"
				.$this->user_id.".";	// user_id уникален, поэтому можем использовать в имени
			//вытаскиваем расширение(могут быть точки в имени файла)
			$old_fn = $_FILES['avatar']['name'];
			$old_fn = explode('.', $old_fn);

			 //метод array_pop вытаскивает последний элемент массива
			// получаем расширение
			$ext = array_pop($old_fn);

			$new_fn .= $ext;
			echo "путь ". $new_fn."<br>";

			//теперь перенесьти в нужную папку(из временной папки(путь к ней в том же $_FILES))
			move_uploaded_file($_FILES['avatar']['tmp_name'], $new_fn);
			//сохранить инфу в базу данных
			$query = "UPDATE `user` SET avatar_type = '{$ext}' WHERE id = {$this->user_id};";
			$this->pdo->query($query);

			// в поле объекта записываем имя файла аватарки
			$this->avatar = $this->user_id . '.' . $ext;
			//обновить сессию
			$_SESSION['user']['avatar'] = $this->avatar;
		}
		
	}
	//
	public function getAvatar() {
		return $this->avatar ?? false;	//?? если в переменной ничего нет, то вернется false
	}

	//метод для проверки разрешений(передаюм название привелегии, а возвращает тру или фолс)
	public function hasPermission($privilege) {
		if(isset($this->privileges[$privilege])) {
			return $this->privileges[$privilege];
		}
		else {
			return false;
		}
	}

	//регистрация
	private function registration($login, $pass, $email, $phone) {
		$this->reg_status = self::REG_FAILED; //поменяем только если регистрация пройдет успешно
		//отсекаем неподходящии варианты(если пустые лог и пасс и если их длина меньше 3 символов)
		if(empty($login) || empty($pass) || strlen($login)<=3 || strlen($pass)<3 ) {
			echo "не прошли условия<br>";
			return false;
		}
		//проверить пользователя в базе данных(если логин такой есть, то не можем зарегить)
		$query = "SELECT  * FROM `user` WHERE login = :login";
		$resalt = $this->pdo->prepare($query); // подготовка запроса
		$resalt->bindValue('login', $login);
		$resalt->execute(); //выполнить запрос
		$resalt = $resalt->fetchAll();
		echo "проверка пользователя в базе<br>";
		echo "<pre>";
		var_dump($resalt);
		echo "</pre>";
		if(count($resalt) >0) return false;

		//если дошли до сюда, значит можем регистрировать
		echo "можем регистрировать<br>";
		$query = "INSERT INTO `user` VALUE(
										NULL, :login, :pass, :email, :phone, 'вася', NULL);"; 
		//'вася' - так как у меня в базе user есть поле name, а в этом коде оно не используется, второй NULL так как нет еще аватарки
		echo "запрос : ". $query."<br>";
		$resalt = $this->pdo->prepare($query); // подготовка запроса
		$resalt->bindValue('login', $login);
		$pass= md5($pass);
		$resalt->bindValue('pass', $pass);
		$resalt->bindValue('email', $email);
		$resalt->bindValue('phone', $phone);
		
		if($resalt->execute()) {//выполнение запроса и проверка на успех(возвр true если запрос выполнен)
			echo "запрос в базу на добавление пользователя успешен<br>";
			$this->reg_status = self::REG_SUCCESS;
		}
	}
	//
	public function getRegStatus() {
		return $this->reg_status;
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
			$this->avatar = $_SESSION['user']['avatar']; //для аватара
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

			//аватар
			$this->avatar = $this->user_id. ".".$resalt[0]['avatar_type'];

			//сохраним так же в СЕССИЮ
			$_SESSION['user'] = [
					'login' => $this->login,
					'user_id' => $this->user_id,
					'token' => $this->token,
					'avatar' => $this->avatar
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