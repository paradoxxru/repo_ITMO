<?php

//интерфейс парсера конфигурационных файлов
interface IConfParser{
	static public function getInstance($filename); //для определения класса
	public function read();
	public function write();
	 //гетеры
	public function getParam($key); //будет возвращать значение параметра
	public function getAllParam();
	 // сетеры
	public function setParam($key,$value);
	public function setAllParam($value);//передаем массив знвчений
}
//абстрактный класс
abstract class CConfParser implements IConfParser {
	protected $source; //имя файла - источник
	protected $params = array(); //массив параметров(будет содержать прочитанные/записываемые параметры(например логин:пароль))
	public function __construct($source) {
		$this->source = $source;
		echo "const ".$source."<br>";
	}
	public function __set($name,$value) {//вызавается если обращаются(присвоить или получить значение) к несуществующему(или ) св-ву(полю)
		// echo "<p>";
		// var_dump($name);
		// echo "<p></p>";
		// var_dump($value);
		// echo "</p>";
		$this->setParam($name,$value);
	}
	public function __get($name) {//вызавается если обращаются(присвоить или получить значение) к несуществующему(или ) св-ву(полю) и можно "обращаться" как будто обращаемся на прямую к полю
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
	// по имени файла определяет формат и создает объект соответствующего класса(для txt класс..., для xml другой класс)
	static public function getInstance($filename) { // определяет тип файла(формат данных) и класс
		//проверяем на xml
		if(preg_match('`\.xml$`i', $filename)) {	//ищет совпадение по регулярному выраж(\ экранирует точку, ` это границы выражения, $ конец строки, i без учета регитсра)
			return false;
		}
		//если не формат не xml, то создаем класс для txt
		echo "getI ".$filename."<br>";
		return new CTextConfParser($filename); //создаем класс
	}
}

class CTextConfParser extends CConfParser {
	//реализация для конкретного формата данных(txt)
	public function read() {
		//открыть файл
		//прочитать файл
		//разбить прочитанный текст по строкам
		echo $this->source;
		$lines = file($this->source); //
		
		//итерировать массив строк - 
		echo "<pre>";
		foreach ($lines as $line) {
			$line = trim($line);
			echo $line."\n";
			$vals = explode(':',$line); //разбивает строку на подстроки по символу($vals это массив с двумя знвчениями - до : и посте)
			$this->setParam($vals[0],$vals[1]);
			print_r($vals);
		}
		echo "</pre>";
		//разбить каждую строку по символу ":"

		//добавить новые элементы в массив params

	}
	public function write() {
		//из массива параметров ключ-значение получить массив строк
		//строки объединить в текст
		//записат текст в файл
		$lines = array();
		foreach ($this->params as $key => $val) {
			$lines[] = $key. ":" .$val;
		}
		$text = implode("\n", $lines); // все элементы массива склеивает в одну строку по разделителю(так как у нас разделитель это переход строки, то в файле будет "много" строк)
		file_put_contents($this->source, $text);
	}
}

?>