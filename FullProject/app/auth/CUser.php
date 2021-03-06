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
	private $user_addres;
	private $is_auth = false; // авторизован или анонимный
	private $permissions = [	//пример массива разрешений для пользователя
		'view_profile'=> false
	];
	private $avatar;

	public function __construct($pdo) {
		$this->pdo = $pdo;
		//провести авторизацию
		//сначало проверим авторизован ли польз - проверям есть ли токен и совпадает ли он
		if(!$this->isAuth()) {
			//если не авторизован, то проверяем post параметры на наличие регистрационных данных
			if(isset($_POST['email']) 
				&& isset($_POST['name']) 
				&& isset($_POST['addres']) 
				&& isset($_POST['phone'])
				&& isset($_POST['login'])
				&& isset($_POST['password']))
			{
				$this->registration();
			}
			//если не авторизован и нет данных регистрации, то пытаемся залогинить
			if(isset($_POST['login']) && isset($_POST['password'])) {
				$this->login($_POST['login'], $_POST['password']);
			}

		}
	}
	// проверка авторизован ли пользователь
	public function isAuth() {
		//если в $this->user_id есть значение, то значит пользователь залогинен
		//(чтобы не делать еще раз проверку по сессии, например если нужна проверка где-то еще на странице)
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
			$this->user_addres = $_SESSION['user']['addres'];
			$this->user_phone = $_SESSION['user']['phone'];
			$this->user_mail = $_SESSION['user']['mail'];
			$this->avatar = $_SESSION['user']['avatar'];
			// по запросу из базы
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
			$this->user_id = $resalt[0]['id']; //или $resalt[0][0] так как данные дублируются
			$this->user_name = $resalt[0]['name'];
			$this->user_mail = $resalt[0]['email'];
			$this->user_phone = $resalt[0]['phone'];
			$this->user_addres = $resalt[0]['addres'];
			$this->avatar = $resalt[0]['avatar_type'];
			//сформируем токен
			$this->token = md5($login . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
			//сохраним так же в СЕССИЮ
			$_SESSION['user'] = [
					'login' => $this->login,
					'user_id' => $this->user_id,
					'token' => $this->token,
					'name' => $this->user_name,
					'addres' => $this->user_addres,
					'phone' => $this->user_phone,
					'mail' => $this->user_mail,
					'avatar' => $this->avatar
			];
		}
		
	}
	// регистрация
	public function registration() {
		$query = "INSERT INTO `user` VALUES (NULL,'".$_POST['login']."','"
													.md5($_POST['password'])."','"
													.$_POST['email']."','"
													.$_POST['phone']."','"
													.$_POST['name']."','"
													.$_POST['addres']."',
													NULL);"; // полледнее поле это аватарка(ее расширенине)
		// echo "pзапрос - добавление пользователя<br>";
		// echo $query."<br>";
		$this->pdo->query($query); //добавляем пользователя в базу `user`
		// + по запросу из базы заполнить поля объекта и + сохранить в сесию
		// по сути это тоже самое что и login($login,$password)
		$this->login($_POST['login'],md5($_POST['password']));
	}
	//смена личных данных пользователя
	public function changeSettings() {
		echo "массив post<br>";
		echo "<pre>";
		var_dump($_POST);
		echo "</pre>";

		echo "<br>массив files <br>";
		echo "<pre>";
		var_dump($_FILES);
		echo "</pre>";
		if(isset($_POST['confirmPass']) && $this->confirmPass($_POST['confirmPass'])) {
			if(isset($_POST['repeatConfirmPass']) && $this->confirmPass($_POST['repeatConfirmPass'])) {
				if(isset($_POST['changeLogin']) && $_POST['changeLogin'] !== $this->getLogin()) {
					$query = "UPDATE `user` SET login = '".$_POST['changeLogin']."' WHERE id = ".$this->user_id.";";
					echo "запрос на смену логина<br>";
					echo $query."<br>";
					$this->pdo->query($query);
					//+ сменить логин в объекте и в сессии
				}
				if(isset($_POST['changeName']) && $_POST['changeName'] !== $this->getUserName()) {
					$query = "UPDATE `user` SET name = '".$_POST['changeName']."' WHERE id = ".$this->user_id.";";
					echo "запрос на смену имени<br>";
					echo $query."<br>";
					$this->pdo->query($query);
					//+ сменить имя в объекте и в сессии
				}
				if(isset($_POST['changePhone']) && $_POST['changePhone'] !== $this->getPhone()) {
					$query = "UPDATE `user` SET phone = '".$_POST['changePhone']."' WHERE id = ".$this->user_id.";";
					$this->pdo->query($query);
					//+ сменить телефон в объекте и в сессии
				}
				if(isset($_POST['changeMail']) && $_POST['changeMail'] !== $this->getMail()) {
					$query = "UPDATE `user` SET email = '".$_POST['changeMail']."' WHERE id = ".$this->user_id.";";
					$this->pdo->query($query);
					//+ сменить почту в объекте и в сессии
				}
				if(isset($_POST['changeAddres']) && $_POST['changeAddres'] !== $this->getAddres()) {
					$query = "UPDATE `user` SET addres = '".$_POST['changeAddres']."' WHERE id = ".$this->user_id.";";
					$this->pdo->query($query);
					//+ сменить адрес в объекте и в сессии
				}
				if(isset($_FILES['changeAvatar'])) {
					//если данные об аватарке есть, то удалять старые аватарки
					if(!empty($this->avatar)) {
						if(file_exists(__DIR__."/../../public/assets/images/avatars/". $this->avatar)) {
							unlink(__DIR__."/../../public/assets/images/avatars/". $this->avatar);
						}
					}
					//формируем новое имя файла
					$new_path_file = __DIR__."/../../public/assets/images/avatars/".$this->user_id.".";
							// user_id уникален, поэтому можем использовать в имени
					//вытаскиваем расширение(могут быть точки в имени файла)
					$old_file_name = $_FILES['changeAvatar']['name'];
					$old_file_name = explode('.', $old_file_name);
					 //метод array_pop вытаскивает последний элемент массива
					// получаем расширение
					$ext = array_pop($old_file_name);
					//добавляем расширение к новому имени файла
					$new_path_file .= $ext;
					echo "путь ". $new_path_file."<br>";
					//теперь перенесьти в нужную папку(из временной папки(путь к ней в том же $_FILES))
					move_uploaded_file($_FILES['changeAvatar']['tmp_name'], $new_path_file);
					//сохранить инфу в базу данных(можем хранить только расширение, так как имя это id)
					$query = "UPDATE `user` SET avatar_type = '".$ext."' WHERE id = {$this->user_id};";
					$this->pdo->query($query);
					// в поле объекта записываем имя файла аватарки
					$this->avatar = $this->user_id . '.' . $ext;
					//обновить сессию
					$_SESSION['user']['avatar'] = $this->avatar;


				}
				if(isset($_POST['changePass']) && $_POST['changePass'] !== '' && strlen($_POST['changePass']) > 3) {
					// меняем пароль в базе
				}
			//сделать обновления - может быть здесь и так
			//$this->login($_POST['login'],md5($_POST['password']));
			}
		}
	}
	//проверить(сравнить) введенный пароль в форме смены личных данных
	private function confirmPass($pass_for_confirm) {
		//echo "полученный пароль: ".$pass_for_confirm."<br>";
		//преобразовать принятый пароль через md5
		$pass_for_confirm = md5($pass_for_confirm);
		//echo "пароль после md5: ".$pass_for_confirm."<br>";
		//запросить из базы пароль пользователя (по id)
		$query = "SELECT password FROM `user` WHERE id = ".$this->user_id.";";
		//echo "запрос к базе: ".$query."<br>";
		$pass = $this->pdo->query($query)->fetchAll();
		// echo "результат запроса пароля из базы:<br>";
		// echo "<pre>";
		// var_dump($pass);
		// echo "</pre>";
		if($pass[0]['password'] === $pass_for_confirm)
			return true;
		else {
			echo "<script>alert('не верный пароль');</script>";
			return false;
		}
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
	public function getAddres() {
		return $this->user_addres;
	}
	public function getMail() {
		return $this->user_mail;
	}
	public function getPhone() {
		return $this->user_phone;
	}
	public function getAvatar() {
		return $this->avatar;
	}
}