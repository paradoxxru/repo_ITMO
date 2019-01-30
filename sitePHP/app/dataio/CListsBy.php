<?php
//класс отвечающий за формирование иписка по категориям
class CListsBy {
	public static $categories=[]; //ассоц массив(ключ - категория, значение - кол-во товара)
	public static $count_cost_less=0; // кол-во товара до 10000
	public static $count_cost_more=0; // кол-во товара дороже 10000
	public static function getListCategory($arr) {
		//пройти массив товаров и создать новый массив по категориям
		foreach ($arr as $key=> $item) {
			if( isset(self::$categories[$item['category']]) ) {
				self::$categories[$item['category']]++;
			} else {
				self::$categories[$item['category']] = 1;
			}
		}
		// echo "<pre>";
		// echo "массив категорий: ";echo "<br>";
		// var_dump(self::$categories);
		// echo "</pre>";
	}
	public static function getListCost($arr) {
		foreach ($arr as $key => $item) {
			if($item['cost'] <= 10000)
				self::$count_cost_less += 1;
		}
		self::$count_cost_more = count($arr) - self::$count_cost_less;
	}
}

?>