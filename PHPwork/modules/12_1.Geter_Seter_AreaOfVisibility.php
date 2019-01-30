<?php
//лекция 12

class Test {
	private $a = 1; // доступна только внутри этого класса(в дочерних не доступна)
	protected $b = 2; //будет доступна в дочерних классах
	public function getA() { // геттер (для получения значения)
		return $this->a;
	}
	public function setA($newA) { // сеттер (для установки/смены значения)
		if (($newA % 2) == 0 )	//просто для примера
			$this->a = $newA;
	}
	public function __clone() { //
		return $this->name = "Клон".$this->name;
		// далее при $pr6 = clone($pr1) сначала создается копия объекта, а затем запускается ф-ция клонирования
	}
}
class Test2 extends Test { // класс-потомок от класса Test
	public function getAB() {
		return $this->a + $this->b;
	}
}

$test = new Test();
$test2 = new Test2();
echo $test->getA(); echo "<br>";
echo $test2->getAB(); // не получим $a
echo "<br>";
$test3 = new Test2();
$test3->setA(10);
echo $test3->getA();echo "<br>";


// метод клонирования - чтобы две переменные не ссылались на один объект($product = $test так при изменении в одной переменной будет меняться и "вторая" - так как они ссылаются на один объект)
$product = clone($test); // - так правильно, но так как клонирование "плоское" не сработает если у объекта есть "ссылочные поля" - например массив(public $arr['weight' => 20, 'cost' => 100])
// для этого метод объекта для клонирования
echo "product :";echo "<br>";
echo "<pre>";
var_dump($product);
echo "</pre>";
?>