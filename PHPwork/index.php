<?php
ob_start(); //запустить output_buffering
ini_set('output_buffering', 'On'); //включить буферизацию(возможно нужно еще раскоментить в файле php.ini)
// Чтобы можно было менять куки
session_start(); // "открыли" сессии
//phpinfo(); // вывод всей инфы
error_reporting(E_ERROR); //E_ALL - выводить предупреждения, ошибки и тд
?>

<?php
		//аутинтификация пользователя
// класс отвечающий за аутинтификацию в файле user.php
// см. файл по пути C:\www\dev\PHPwork\app
//include('view/login_form.php'); // подключили файл формы (будем подключать ниже после проверки условий)
include('app/user.php');
include('modules/factory_product.php');

$user = new User();

echo "массив _POST:";
echo "<pre>";
echo print_r($_POST,true);
echo "</pre>";
if (isset($_POST['login']))
	echo "логин: ".$_POST['login']; echo "<br>";

// $login = $_POST['login'];
// $pass = md5($_POST['password']);

// $user->login($login,$password);

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
	"<p><a href='index.php?logout=1'>Выход</a></p>"; // ?logout=1 - этим установили что при клике по ссылке
	// будут установлен параметр logout в значение 1 и помещен в массив $_GET ($_GET['logout' => 1])
} else {
	include('view/login_form.php'); // подключили файл формы для вывода формы
}
		//для теста
echo "объект user: ";
echo "<pre>";
echo print_r($user,true)."\n";
echo var_dump($user);
echo "</pre>";

$goods = []; // в этот массив будем складывать все товары $pr...
for ($i=0;$i<10;$i++) {
	$goods[] = FactoryProduct::getProduct(); // то есть в конец массива будут добавляться элементы
}

//вывод товаров(из массива) на экран
//сделать единую точку входа - можно завести отдельный класс или вынести вывод в класс продукта
//(можно воспользоваться ф-цией toString или написать другую - например render() )
// foreach ($goods as $k => $product) {
// 	$product->render();
// }


require_once('app/views/catalog.php');



?>