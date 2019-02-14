<?php
//класс для хранения данных одной сборки

class CompModel {
	protected $params;

	public function __construct($params) {
		$this->parsms = $params;
	}

	//будет объект представлять в виде строки таблицы
	public function render() {
		$out = ""; //для результата
		for($i=0;$i<8;$i++){
			$out .= "<td>{$this->params[$i]}</td>";
		}
		$out = "<tr>{$out}</tr>";
		return $out;
	}
}