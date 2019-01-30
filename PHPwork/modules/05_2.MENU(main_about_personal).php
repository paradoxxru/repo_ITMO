<?php
							// Лекция 5 - продолжение
//Меню
//Создать массив, где ключ - название раздела, а значение - путь до файла с содержимым страницы.
//вывести в виде списка(ul) каждый элемент(li) это ссылка(имя ссылки название раздела и ссылается она
// на опледеленный путь)

$menu = array(
		'Main' => '/',
		'About' => '/about.html',
		'Personnel' => '/personnel.html',
		'Partners' => '/partner.html'
);
echo "<ul>
		<li><a href=".$menu['Main'].">Main</a></li>
		<li><a href=".$menu['About'].">About</a></li>
		<li><a href=".$menu['Personnel'].">Personnel</a></li>
		<li><a href=".$menu['Partners'].">Partners</a></li>
	</ul>"

?>
