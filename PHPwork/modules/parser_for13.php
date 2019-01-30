<?php

//интерфейс парсера конфигурационных файлов
interface IConfParser{
	static public function getInstance($filename); //для определения типа файла(его расширения) и создания класса, соответствующего типу файла
	public function read();	//метод чтения из файла
	public function write(); //метод записи в файл
	 //гетеры
	public function getParam($key); //будет возвращать значение переданного параметра
	public function getAllParam(); //будет возвращать все значения всех параметров
	 // сетеры
	public function setParam($key,$value); //устанавливает параметр и его значение
	public function setAllParam($value);//передаем массив новых параметров
}
//абстрактный класс, реализующий интерфейс
abstract class CConfParser implements IConfParser {
	protected $source; //имя файла - источник
	protected $params = array(); //массив параметров(будет содержать прочитанные/записываемые параметры(например логин:пароль))
	public function __construct($source) {
		$this->source = $source;
		echo "путь к файлу(имя файла) в Конструкторе : ".$source."<br>";
	}
	public function __set($name,$value) {//вызавается если обращаются(присвоить значение) к несуществующему св-ву(полю). Перепишем этот метод и можно "обращаться" как будто обращаемся на прямую к полю
		// echo "<p>";
		// var_dump($name);
		// echo "<p></p>";
		// var_dump($value);
		// echo "</p>";
		$this->setParam($name,$value);
	}
	public function __get($name) {//вызавается если обращаются(получить значение) к несуществующему св-ву(полю). Перепишем этот метод и можно "обращаться" как будто обращаемся на прямую к полю
		// echo "<p>";
		// var_dump($name);
		// echo "</p>";
		return $this->getParam($name);
	}	
	public function __call($name, $arguments) { //вызавается если обращаются к несуществующему методу
		echo "<p>";
		var_dump($name);
		echo "<p></p>";
		var_dump($arguments);
		echo "</p>";
	}
	// реализуем методы......
	public function getParam($key) {
		return $this->params[$key];
	}
	public function getAllParam() {
		return $this->params; //возвращаем весь массив параметров
	}
	public function setParam($key,$value) {
		$this->params[$key] = $value;
	}
	public function setAllParam($value) { //берем массив новых параметров
		foreach($value as $k => $val) {
			$this->params[$k] = $val; //помещаем значения в массив params
		}
	}
	//ф-ция по имени файла определяет формат и создает объект соответствующего класса(для txt один класс, для xml другой класс и тд если необходимо)
	static public function getInstance($filename) { // определяет тип файла(формат данных) и класс
		//проверяем на xml
		if(preg_match('`\.xml$`i', $filename)) {	//ищет совпадение по регулярному выраж(\ экранирует точку, ` это границы выражения, $ конец строки, i без учета регитсра)
			return false; //пока заглушка, здесь должно быть return new CXmlParamHandler($filename);
		}
		//если формат не xml, то создаем класс для текстового файла
		echo "путь к файлу(имя файла) в getInstance : ".$filename."<br>";
		return new CTextConfParser($filename); //создаем класс. при создании класса мы передаем имя файла, а конструктор при этом в поле $source созданного класса записывает имя файла(путь к файлу?)
	}
}
// объявляем класс-потомок от CConfParser
class CTextConfParser extends CConfParser {
	//реализация чтения из файла для конкретного формата данных(txt)
	public function read() {
		//открыть файл
		//прочитать файл
		//разбить прочитанный текст по строкам
		echo "путь к файлу(имя файла) при создании класса CTextConfParser extends CConfParser :"
		.$this->source;
		$lines = file($this->source); //$lines будет содержать массив строк прочитанных из файла
		
		//итерировать массив строк
		//разбить каждую строку по символу ":"
		//добавить новые элементы в массив params
		echo "<pre>";
		foreach ($lines as $line) {
			$line = trim($line); //trim чтобы удалить перевод новой строки
			echo "строка : ".$line."\n";
			$vals = explode(':',$line); //разбивает строку $line на подстроки по переданному символу($vals это массив с двумя знвчениями - до двоеточия(:) и после)
			$this->setParam($vals[0],$vals[1]);
			echo "разбиение строки на массив двух значений: ";
			print_r($vals);
		}
		echo "</pre>";
	}
	//реализация записи в файл
	public function write() {
		//из массива параметров ключ-значение получить массив строк
		//строки объединить в текст
		//записат текст в файл
		$lines = array();
		foreach ($this->params as $key => $val) {
			$lines[] = $key. ":" .$val; //[] значит в конец массива добавить элемент
		}
		$text = implode("\n", $lines); // все элементы массива склеивает в одну строку по разделителю(так как у нас разделитель это переход строки, то в файле будет "много" строк)
		file_put_contents($this->source, $text); //записываем в файл
	}
}

?>