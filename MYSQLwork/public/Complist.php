<?php

require_once"CompModel.php";

class Complist {
	protected const SELECT = "SELECT
	comp.name as NamePC,
	`case`.powerBP as `Power`,
	disk.`value` as ValueDisk,
	disk.weight as WeightDisk,
	disk.cost as SelfCostDisk,
	COUNT(DISTINCT compdisk.id) as `CountDisk`,
	SUM(disk.`value`) as sumValueDisks,
	(cpu.weight + `case`.weight) as Wcpu_case,
	(cpu.cost + `case`.cost) as Ccpu_case,
	IFNULL(cpu.weight, 0) + IFNULL(`case`.weight, 0) + IFNULL(SUM(disk.weight), 0) as SumWeight,
	IFNULL(cpu.cost,0) + IFNULL(`case`.cost,0) + IFNULL(SUM(disk.cost),0) as `cost(CPU,Case,Disks)` ";

	protected const FROM = "FROM comp
LEFT JOIN compdisk ON comp.id = compdisk.comp_id
LEFT JOIN disk ON compdisk.disk_id = disk.id
LEFT JOIN cpu ON comp.cpu_id = cpu.id
LEFT JOIN `case` ON `case`.id = comp.case_id ";

	protected const CROUPBY = "GROUP BY comp.id ";

	protected $limit = []; //массив, так как может быть 1 или 2 параметра у лимита
	protected $pdo;

	public function __construct(PDO $pdo) { //PDO $pdo - явно указали тип переменной
		$this->pdo = $pdo;
	}
	//будет возвращать массив массивов
	public function getArray() {
		//запрос(пока только с лиммитом)
		$query = self::SELECT . self::FROM
		.$this->getWhere()
		.self::CROUPBY
		.$this->getHaving()
		.$this->getOrder()
		.$this->getLimit() //пока только этот метод реализован
		.";";
		return $this->pdo->query($query)->fetchAll();
	}
	//будет возвращать массив объектов
	public function getList() {
		$arr = $this->getArray();
		$comps = [];
		foreach ($arr as $row) {
			$comps[] = new CompModel($row);
		}
		return $comps;
	}

	//получить WHERE
	protected function getWhere() {
		return " ";
	}
	//получить HAVING
	protected function getHaving() {
		return " ";
	}
	//ф-ция для формирования сортировки
	protected function getOrder() {
		return " ";
	}
	//получить LIMIT
	protected function getLimit() {
		if(count($this->limit) > 0) {
			return "LIMIT  ". implode(',' , $this->limit);
		} else {
			return " ";
		}
	}
	//ф-ция чтобы устанавливать лимит
	// $ofset - отступ(необязат параметр)
	public function setLimit($limit, $ofset = null) {
		$this->limit = []; //обнуляем лимит
		if(is_numeric($ofset)) $this->limit[] = $ofset;
		if(is_numeric($limit)) $this->limit[] = $limit;
		return $this;

	}
}