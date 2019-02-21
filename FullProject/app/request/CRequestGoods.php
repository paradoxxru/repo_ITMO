<?php
namespace app\request;

class CRequestGoods {
	protected const SELECT = "SELECT 
						goods.id,
						goods.name as name,
						goods.cost as cost,
						goods.weight as weight,
						goods.`count` as count,
						goods.vogue as vogue,
						goods.category as category,
						goods.description as description,
						goods.img as img,
						goods.receipt_data as receipt_data ";

	protected const FROM = "FROM goods ";

	protected const CROUPBY = "GROUP BY goods.id ";

	protected $limit = []; //массив, так как может быть 1 или 2 параметра у лимита
	protected $pdo;

	public function __construct($pdo) { //PDO $pdo - явно указали тип переменной
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
	// public function getList() {
	// 	$arr = $this->getArray();
	// 	$comps = [];
	// 	foreach ($arr as $row) {
	// 		$comps[] = new CompModel($row);
	// 	}
	// 	return $comps;
	// }

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