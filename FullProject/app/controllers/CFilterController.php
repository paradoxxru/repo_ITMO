<?php
namespace app\controllers;

//require_once('../app/controllers/IPageController.php');
class CFilterController implements IPageController
{
	public function setPermissions($permissions) { //разрешения
		// TODO: Implement setPermissions() method.
	}
	public function render($pdo) { //формирование страницы
		//нужно подключить класс запросов, выполнить запрос и получить массив-ответ
		$request = new \app\request\CRequestGoods($pdo);
		//получаем массив всех товаров
		$arr_goods = $request->getArray();

		//производим фильтрацию (НУЖНО ли проверять на "непустые значения $_GET")
		$type = $_GET['filtertype'];	//тип фильтра(равно, больше, меньше)
		$value = $_GET['filtervalue'];	//значение с которым сравнивать(конкретная категория, стоимость от/до 1000)
		$data = $_GET['datafilter'];	//значение по которому сравнивать(категория, стоимость)
		$new_goods = self::filtration($arr_goods, $data, $value, $type);//self::getRule($type));

		$path_to_template = "../app/views/filter.php"; //определили куда выводить
		include($path_to_template); // выводим
	}
	//ф-ция фильтрации. 
	//в массиве $_GET у нас:
	// datafilter - значение по которому сравнивать(категория, стоимость)
	// filtervalue - значение с которым сравнивать(конкретная категория, стоимость от/до 1000)
	// filtertype - тип фильтра(равно, больше, меньше)
	private function filtration($arr, $dataf, $valuef, $typef) {
		$rule = self::getRule($typef);//в переменной $rule будет строка, например 'isEqual'
		$rez = [];
		foreach ($arr as $key => $item) {
			if(self::$rule($item[$dataf], $valuef)) { // здесь обращаемся к строке как к ф-ции isEqual(.,.)
				$rez[$key] = $item;
			}
		}
		return $rez;
		
	}
	//ф-ция возвращает правило фильтрации
	private function getRule($t) {
		if($t === 'equal') {
			return 'isEqual';
		}
		elseif ($t === 'more') {
			return 'isMore';
		}
		elseif ($t === 'less') {
			return 'isLess';
		}
	}
	private function isEqual($a, $b) {
		return ($a == $b);
	}
	private function isMore($a, $b) {
		return ($a > $b);
	}
	private function isLess($a, $b) {
		return ($a <= $b);
	}
}