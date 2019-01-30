<?php
// класс для управления товарами(на стороне php)
class Product {
	//св-ва
	protected $weight =0; //задали начальное значение
	protected $cost;	// public - значит доступно из вне, private - доступно только внутри этого класса
						// protected - будет доступна в дочерних классах
	protected $name;
	protected $description;
	protected $vogue;
	protected $category;
	protected $count;
	//методы
	// конструктор(для задания начальных значений) - это частный случай метода.
	// у конструктора зарезервированное имя __construct
	public function __construct($name = false)//принимаем из вне параметр $name - при создании новых
	// объектов можем передавать, например, имя. false - значение по умолчанию(если не передали параметр)
	{
		if($name) $this->name = $name;	//то есть если передали значение, то установить его как имя
		// $this - сам объект класса Product(является ссылкой на вызываемый объект)
		$this->cost = 0;// так же можно задать начальные значения какому-нибудь св-ву, но это проще сделать
		//прямо в объявлении(public $weight =0;)
	}
	public function __toString() { //метод "преобразования" объекта при выводе его на экран(например через echo)
		return "Продукт: ". $this->name . " (". $this->count . " )";
	}
	public function __clone() { //
		return $this->name = "Клон".$this->name; //для примера добавляем слово "Клон"
		// далее при $pr6 = clone($pr1) сначала создается копия объекта, а затем запускается ф-ция клонирования
	}
	
	//ф-ция-метод для подключения файла, в котором описан вывод на экран
	public function render() {
		include ("view/product.php");
	}

	//геттер для веса (это тоже метод)
	public function getWeight() {
		return $this->weight;
	}
	//сеттер для веса
	public function setWeight($new_weight) {
		$this->weight = $new_weight;
	}
	//геттер для цены
	public function getCost() {
		return $this->cost;
	}
	//сеттер для цены
	public function setCost($new_cost) {
		$this->cost = $new_cost;
	}
	//геттер для имени
	public function getName() : string {	//string явно указываем что значение будет строковое
		return $this->name;
	}
	//сеттер для имени
	public function setName(string $new_name) : void {	// void значит что ничего не возвращает
											// string и void не обязательные параметры
		$this->name = $new_name;
	}
	//геттер для описания
	public function getDescription() {
		return $this->description;
	}
	//сеттер для описания
	public function setDescription($new_description) {
		$this->description = $new_description;
	}
	//геттер для популярности
	public function getVogue() {
		return $this->vogue;
	}
	//сеттер для популярности
	public function setVogue($new_vogue) {
		$this->vogue = $new_vogue;
	}
	//геттер для категорий
	public function getCategory() {
		return $this->category;
	}
	//сеттер для категорий
	public function setCategory($new_category) {
		$this->category = $new_category;
	}
	//геттер для количества
	public function getCount() {
		return $this->count;
	}
	//сеттер для количества
	public function setCount($new_count) {
		$this->count = $new_count;
	}
}
// к лекции 11(ООП)
//класс-наследник от Product
class ProductCar extends Product {
	//extends(пер. расширить) - значит что наследуем от класса Product(расширяем класс Product)
	private $vendor;
	private $power;
	private $color;
	public function __toString() { // переопределили этот метод
		return "Автомобиль: ". $this->name . " (". $this->count . " )";
	}
	public function getVendor() {
		return $this->vendor;
	}
	public function setVendor($new_vendor) {
		$this->vendor = $new_vendor;
	}
	public function getPower() {
		return $this->power;
	}
	public function setPower($new_power) {
		$this->power = $new_power;
	}
	public function getColor() {
		return $this->color;
	}
	public function setColor($new_color) {
		$this->color = $new_color;
	}
}
//другой класс-наследник от Product
class ProductPC extends Product {
	private $ram;
	private $cpu;
	private $hdd;
	public function __toString() { // переопределили этот метод
		return "Автомобиль: ". $this->name . " (". $this->count . " )";
	}
	public function getRam() {
		return $this->ram;
	}
	public function setRam($new_ram) {
		$this->ram = $new_ram;
	}
	public function getCpu() {
		return $this->cpu;
	}
	public function setCpu($new_cpu) {
		$this->cpu = $new_cpu;
	}
	public function getHdd() {
		return $this->hdd;
	}
	public function setHdd($new_hdd) {
		$this->hdd = $new_hdd;
	}
}

?>