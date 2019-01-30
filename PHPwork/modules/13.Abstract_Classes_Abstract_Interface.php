<?php
					// Лекция 13
				// Абстрактный класс
// Абстрактный метод – это метод для которого отсутствует реализация.
// Определяется с помощью ключевого слова abstract.
// abstract class ShopProduct { // абстрактный класс
//     abstract public function getPrice(); //абстрактный метод
// }
// Абстрактный класс – класс, на основе которого нельзя создать экземпляр объекта(можно только создать класс-наследник). Определяется с помощью ключевого слова abstract.

// Класс, который содержит по крайней мере один абстрактный метод, должен быть определен как абстрактный.
// В любом классе, который расширяет(наследует) абстрактный класс, должны быть реализованы все абстрактные методы либо сам класс должен быть объявлен абстрактным.
// abstract class ShopProduct { // Можно
//     abstract public function getPrice();
// }
// class ShopProduct { // Нельзя
//     abstract public function getPrice();
// }

// abstract class CParser {
//     abstract public function parse();
// }
// class XMLParser extends CParser {
//     public function parse() {
//     	//здесь РЕАЛИЗАЦИЯ
//         # Используем средства для парсинга XML
//     }
// }
// class CSVParser extends CParser {
//     public function parse() {
//     	//здесь РЕАЛИЗАЦИЯ
//         # Используем функции для парсинга CSV
//     }
// }

// Мы ГАРАНТИРУЕМ, что каждая конкретная реализация парсера будет иметь метод parse, 
// который вернет данные в оговоренном формате, при этом мы ничего не знаем об исходном формате данных.

						//Интерфейс
// Интерфейс – объявляется также как и обычный класс, но с использованием ключевого слова interface.
// СОСТОИТ ТОЛЬКО ИЗ АБСТРАКТНЫХ методов и констант.
// interface IUser {
//     public function authenticate();
//     public function getId();
//     public function getName();
// }
// Все методы, определенные в интерфейсе должны быть публичными.

// Часто термин наследование заменяют термином РЕАЛИЗАЦИЯ.
// Для реализации интерфейса используется оператор implements.
// Классы могут реализовывать более одного интерфейса.
// class CUser implements IUser, ArrayAccess {	// здесь класс Реализует два интерфейса(IUser и ArrayAccess)
//     # Здесь реализация
// }

						//Завершенные (финальные) методы
// Чтобы предотвратить переопределение метода в дочерних классах, необходимо использовать ключевое слово final перед объявлением метода.
// Такие методы называются завершенными.
// abstract class CParser {
//     abstract public function parse();
//     final public function toArray() {		// завершенный метод
//         return $this->parse();
//     }
//     final public function toJson() {			// завершенный метод
//         return json_encode($this->parse());
//     }
// }

						//Завершенные (финальные) классы
// Если класс определяется с ключевым словом final, то он называется завершенным.
// Для завершенного класса нельзя создать подкласс.
// # Класс объявлен завершенным
// final class XMLParser extends CParser {
//     public function parse() {}
// }
//если далее объявить:
//class ExtXMLParser extends XMLParser {}
//то
# PHP выдаст фатальную ошибку
# Класс не может быть унаследован от завершенного класса


require_once('parser_for13.php');
$parser = CConfParser::getInstance('config_for13.txt'); //создаем объект класса CTextConfParser, который является потомком класса CConfParser, так как метод getInstance по переданному в него файлу определил, что расширение файла txt(вернее что не xml) и вернул класс CTextConfParser
$parser->read(); //читаем из файла(изначально в этом файле три строки - param1:1, param2:22, param3:333)
echo "вывод параметра param2: ";
echo $parser->getParam('param2'); echo "<br>";
echo "Все параметры: "; echo "<br>";
echo "<pre>";
echo print_r($parser->getAllParam(),true);
echo "</pre>";

$parser->setParam('param2', 'new'); //изменяем значение param2 на new в массиве $params
$parser->setParam('param4', '4444');// добавляем param4 и его значение в массив $params
$parser->write(); //записываем значения из $params в файл
echo "вывод параметра param4: ";
echo $parser->getParam('param4'); echo "<br>";

echo "<p>Read:</p>";
echo "Пытаемся обратиться к несуществующ. полю  объекта: ".$parser->param2; // обращаемся к несущестующему полю объекта $parser
									//(при этом вызывается public function __get($name))
echo "<p>write:</p>";
echo "пытаемся в несуществующее поле записать"; echo "<br>";
echo "в param4 - new value, а в param5 - new2 value2"; echo "<br>";
$parser->param4 = "new value"; // устанавливаем значение несуществующего поля
								//(при этом вызывается public function __set($name,$value))
$parser->param5 = "new2 value2";

$parser->write();
echo "Все параметры теперь: "; echo "<br>";
echo "<pre>";
echo print_r($parser->getAllParam(),true);
echo "</pre>";

// обратимся к несуществующему методу класса
$parser->emptyMethod(); // "запуститься метод __call"

?>