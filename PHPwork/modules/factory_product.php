<?php
//фабрика продуктов(товаров)
require_once('classes.php');
class FactoryProduct {
	// константы
	const ALPHABET = 'aeyuioqwrtpsdfghjklzxcvbnm';	// алфавит
	const ALPHABET_LEN = 26;
	const ALPHABET_VOWEL_LEN = 6;
	//для цвета авто - массив цветов
	private static $colors = ['белый', 'черный', 'красный', 'желтый', 'синий', 'фиолетовый', 'металик'];
	//для производителей авто
	private static $vendors = ['nissan','opel','mercedes','bmw','niva','craysler','ezh'];
	// для мощности авто
	private static $powers = ['86 л.с.','240 л.с.','505 л.с.','300 л.с.','140 л.с.','63 л.с.'];
	//для названия процессоров
	private static $cpus = ['core2dou','pentium4','core i5','ryzen 3','core i3','core i7','athlon x4'];
	// для оперативной памяти
	private static $rams = ['2Gb','4Gb','8Gb','16Gb','32Gb'];
	private static $hdds = ['500Gb','250Gb','750Gb','1Tb','1,5Tb','2Tb','4Tb'];
	//для названия категорий
	private static $categories = ['продукты','бытовая техника','фото-видео','бытовая химия','мебель','красота и здоровье'];
	
	public static function getProduct() : Product { //static - метод класса не зависит от состояния объекта
	//(метод можно вызвать у класса, а не у объекта(без создания объекта)). : Product - значит что возвращаться будет тип данных Product (не обязательно в php)
		
		//генерим случ число от 0 до 2(случайный класс - Product,ProductCar,ProductPC)
		$i = rand(0,2);
		switch ($i) {
			case 0://если 0, то пусть будет объект класса ProductCar
				return self::getProductCar();	//self:: - указывает на ЭТОТ класс (аналог this в объекте). с помощью self можно обращатся к СТАТИЧНЫм методам и св-вам класса
			case 1://если 1, то пусть будет объект класса ProductPC
				return self::getProductPC();
			default://иначе будет объект класса Product
				return self::getParentProduct();
		}
	}
	private static function getParentProduct() {
		$product = new Product();
		self::generateProductProperty($product);
		return $product;
	}
	private static function getProductCar() {
		$product = new ProductCar();
		self::generateProductProperty($product);
		$product->setVendor('Vendor: '.self::$vendors[rand(0,count(self::$vendors)-1)]); //$product->vendor = '';
		$product->setPower('Power: '.self::$powers[rand(0,count(self::$powers)-1)]); //$product->power = '';
		$product->setColor('Color: '.self::$colors[rand(0,count(self::$colors)-1)]); //$product->color = '';
		return $product;
	}
	private static function getProductPC() {
		$product = new ProductPC();
		self::generateProductProperty($product);
		$product->setCpu('Cpu: '. self::$cpus[rand(0,count(self::$cpus)-1)]); //$product->cpu = 'cpu :'. self::$cpus[rand(0,(count(self::$cpus)-1))];
		$product->setRam('Ram: '. self::$rams[rand(0,count(self::$rams)-1)]); //$product->ram = 'ram :'...
		$product->setHdd('Hdd: '.self::$hdds[rand(0,count(self::$hdds)-1)]); //$product->hdd = '';
		return $product;
	}
	private static function generateProductProperty($pr) {	//метод доступен только внутри класса
		//сменили св-ва в классе Product с public на protected, добавили сетеры и гетеры, и теперь
		// устанавливаем св-ва не на прямую($pr->category), а через сетер($pr->setCategory())
		$pr->setCategory('Category: '.self::$categories[rand(0,count(self::$categories)-1)]); //$pr->category = 'Category '. rand(1,5);
		$pr->setName('Name: '. self::randomWord(6)); //$pr->name = 'Name '. rand(1,1000);
		// $pr->cost = rand(1,2) == 1	//если один считаем что цена до 2тр(и цена может меняться по 100р)
		// 	? rand(1,20)*100		//то есть от 1 до 2тр с шагом в 100р
		// 	: rand(3,30)*1000;		//иначе(если 2) то больше 2тр(цена меняется только по 1тр)
		$cost = rand(1,2) == 1 ? rand(1,20)*100 : rand(3,30)*1000;
		$pr->setCost($cost);
		$pr->setCount('Count: '. rand(1,100)); //$pr->count = 'Count '. rand(1,100);
		$pr->setWeight('Weight: '. rand(1,30)); //$pr->weight = 'Weight '. rand(1,30);
		$pr->setVogue('Vogue: '. rand(1,50)); //$pr->vogue = 'Vogue '. rand(1,50);
		$pr->setDescription('Description: '. self::rendomSentence(4)); //$pr->description = 'Description : '. self::rendomSentence(4);
	}

	//для названия -  ф-ция, генерир-щая случ слово
	// подряд 3 согл или 3 гласных нельзя
	private static function randomWord($n) {
		$word;
		for ($i=0;$i<$n;$i++) {
			if (self::isVowel($word[$i-2]) && self::isVowel($word[$i-1]))
				$word .= self::getConsonant();
			else if (!self::isVowel($word[$i-2]) && !self::isVowel($word[$i-1]))
				$word .= self::getVowel();
			else
				$word .= self::getLetter();
		}
		//echo "полученное слово : ". $word; echo "<br>";
		return $word;
	}
	// ф-ция получения любой буквы
	private static function getLetter() {
		return self::ALPHABET[rand(0,25)];
	}
	// ф-ция получения гласной буквы
	private static function getVowel() {
		return self::ALPHABET[rand(0,5)];
	}
	// ф-ция получения согласной буквы
	private static function getConsonant() {
		return self::ALPHABET[rand(6,25)];
	}
	// ф-ция проверяет гласность буквы
	private static function isVowel($letter) {
		//echo "$letter";
		return (mb_strpos(self::ALPHABET, $letter) < self::ALPHABET_VOWEL_LEN);
	}

	//для названия - ф-ция, генерир-щая случ предложение из n кол-ва слов
	// нельзя подряд 2 коротких слова(1,2,3 буквы это короткое слово)
	private static function rendomSentence($n) {
		$sentence = '';
		$sen ='';
		$min = 1;
		$max = 7;
		for ($i=0;$i<$n;$i++) {
			//echo $i."-й проход цикла"; echo "<br>";
			//echo "слово(sen) до :".$sen; echo "<br>";
			if ((strlen($sen) < 4) && !empty($sen)) { //если длина слова 1,2,3 буквы и слово не "пустое"(это чтобы первое слово могло быть коротким), то
				$min = 4;
			} else $min = 1;
			$sen = self::randomWord(rand($min,$max));
			$sentence .= $sen .' ';
			//echo "min значение: ".$min; echo "<br>";
			//echo "слово(sen) после : ".$sen; echo "<br>";

		}
		//echo "полученное предложение : ". $sentence; echo "<br>";
		return trim($sentence).'.';
	}
	//для описания - ф-ция, генерир-щая случ кол-во предложений
	private static function rendomText($n) {
		$text = '';
		for ($i=0; $i<$n;$i++) {
			$sen = self::rendomSentence(rand(3,10));
			$text .= lcfirst($sen). '. ';	//lcfirst - переводит 1-ю букву в верхний регистр
		}
		return trim($text); //trim - обрезает пробелы в начале и в конце(нам надо в конце)
	}

}

?>