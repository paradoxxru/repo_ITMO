<?php
		//аутинтификация пользователя
// класс отвечающий за аутинтификацию в файле user_for12_2.php
// include('login_form_for12_2.php'); //подключили файл формы (будем подключать ниже после проверки условий)
include('user_for12_2.php'); // прописан класс аутинтификации
include('factory_product_for12_2.php'); // подключили фабрику продуктов

$user = new User();

// $login = $_POST['login'];
// $pass = md5($_POST['password']);

// $user->login($login,$pass);

// авторизация пользователя
if (!empty($_POST['login'])) { //если ввели логин
	$login = $_POST['login'];
	$pass = md5($_POST['password']);
	if(!($user->login($login,$pass))) { //логинимся и проверяем получилось ли
		echo "<p>Ошибка авторизации: неверный пароль.</p>";
	}
}
if (!empty($_GET['logout'])) { //если нажали на выход - установилось значение logout=1(см.ниже)
							// следовательно проверяем если значение в $_GET['logout'] есть, то
	$user->logout(); // выходим
}
if ($user->isLogin()) {
	echo "<h1>Добро пожаловать ".$user->getLogin()." !</h1>".
	"<p><a href='12_2v2.Class_Authentication.php?logout=1'>Выход</a></p>"; // ?logout=1 - этим установили что при клике по ссылке будут установлен параметр logout в значение 1 и помещен в массив $_GET ($_GET['logout' => 1])
} else {
	include('login_form_for12_2v2.php'); // подключили файл формы для вывода формы
}
		//для теста
echo "объект user: ";
echo "<pre>";
echo print_r($user,true)."\n"; //если значение поле = false, то не выведется на экран
echo var_dump($user); //выведет значение false
echo "</pre>";

$goods = []; // в этот массив будем складывать все товары $pr...
for ($i=0;$i<10;$i++) {
	$goods[] = FactoryProduct::getProduct(); // то есть в конец массива будут додбавляться элементы
}

//вывод товаров(из массива) на экран
//сделать единую точку входа - можно завести отдельный класс или вынести вывод в класс продукта
//(можно воспользоваться ф-цией toString или написать другую - например render() )
foreach ($goods as $k => $product) {
	$product->render();
}


					
?>