<?php
// Классы и объекты
require_once('classes.php');//в подключаемом файле объявлен класс под названием Product
$pr1 = new Product('Яблоко'); //создаем один объект класса Product
$pr2 = new Product('Груша'); //создаем другой объект класса Product
$pr1->category = 'фрукты'; // св-ву category объекта $pr1 присваиваем значение
echo $pr1->category;
echo "<pre>";
var_dump($pr1);
var_dump($pr2);
echo "</pre>";
?>