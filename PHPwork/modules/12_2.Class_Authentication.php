<?php
		//аутинтификация пользователя
// класс отвечающий за аутинтификацию в файле user_for12_2.php
include('login_form_for12_2.php'); // подключили файл формы
include('user_for12_2.php'); // прописан класс аутинтификации
include('factory_product_for12_2.php'); // подключили фабрику продуктов

$user = new User();

$login = $_POST['login'];
$pass = md5($_POST['password']);

$user->login($login,$pass);

$goods = []; // в этот массив будем складывать все товары $pr...
for ($i=0;$i<10;$i++) {
	$goods[] = FactoryProduct::getProduct(); // то есть в конец массива будут додбавляться элементы
}

//вывод товаров(из массива) на экран
// foreach ($goods as $k => $product) {
// 	echo "<div>";
// 	echo $k. ": <span>". $product->getName(). "</span>";
// 	echo "<span>". $product->getCost(). "</span>";
// 	echo "</div>";
// }
// заменим на вызов шаблона
// foreach ($goods as $k => $product) {
// 	include ("view/product.php");	//include - так как с require при отсутствии шаблона будет критич.
// 	// ошибка, а так вся остальная вёрстка будет, не будет только "карточки" товара
// }
//чтобы можно было "все" менять(вывод не списком, использовать другой шаблон и тд) при выводе, то надо делать так
//сделать единую точку входа - можно завести отдельный класс или вынести вывод в класс продукта
//(можно воспользоваться ф-цией toString или написать другую - например render() )
foreach ($goods as $k => $product) {
	$product->render();
}


					
?>