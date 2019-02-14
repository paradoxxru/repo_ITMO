<?php
namespace app\dataio;

class CUserCart
{
	private $source; //будет содержать путь и имя файла
	private $arrCart = []; //массив товаров в корзине(ключи - , значения - ассоц.массивы id,count,cost)
	private $col = 0; //общее кол-во товара в корзине
	private $sum = 0; //общая сумма товара в корзине
	private $sum_weight = 0; //общий вес товара в корзине

	//реализовать определение логина пользователя и сопоставить его с именем файла корзины
	public function __construct($hexlogin = 'anonim') {
		if($hexlogin !== 'anonim') {
			$this->source = '../app/config/userCarts/'.$hexlogin.".db";
		} else {
			$this->source = '../app/config/userCarts/'.
			md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']).".db";
		}
		//читаем из файла и заполняем массив корзины
		$this->readFileToArr(); 
	}
	//чтение из соответствующего файла инфы о товарах в корзине пользователя
	private function readFileToArr() {
		//echo "в ф-ции чиения из файла в массив arrCart<br>";
		//$this->source = '../app/config/userCarts/'.$hexlogin.".db";
		if(file_exists($this->source)) {
			$lines = file($this->source); //массив строк из вайла
			$len = count($lines);
			for($i=0; $i<$len; $i++) {
				$line = $lines[$i]; //строка вида('id:3;count:6;cost:1500')
				$vals = explode(';', trim($line)); //массив($vals[0]='id:3' ,$vals[1]='count:6' ,$vals[2]='cost:1500', $vals[3]='weight:500')
				foreach ($vals as $key => $value) {
					$new = explode(':', trim($value)); //массив($new[0]='id',$new[1]='3')
														//при следующей итерации $new[0]='count',$new[1]='6'
					$new_arr[$new[0]] = $new[1];
				}
				$this->arrCart[$i] = $new_arr;
			}
		}
		// echo "массив корзины arrCart после чтения из файла<br>";
		// echo "<pre>";
		// var_dump($this->arrCart);
		// echo "</pre>";

	}
	//запись инфы из массива корзины в файл пользователя
	private function writeArrToFile() {
		//echo "в ф-ции записи в файл<br>";
		$lines = '';
		foreach ($this->arrCart as $i => $arr) {
			$line = "id:".$arr['id'].";".
					"count:".$arr['count'].";".
					"cost:".$arr['cost'].";".
					"weight:".$arr['weight']."\n";
			// echo "строка ".$i."<br>";
			// echo $line;echo "<br>";
			$lines.=$line;
		}
		file_put_contents($this->source, trim($lines));
	}
	//подсчет общего кол-ва товаров в корзине, общего веса и общей стоимости
	public function calcSummaryInfo() {
		if(isset($this->arrCart)) {
			$len = count($this->arrCart);
			for($i=0; $i<$len; $i++) {
				$this->col += $this->arrCart[$i]['count'];
				//echo "считаем кол-во: ".$this->col."<br>";
				$this->sum += $this->arrCart[$i]['count'] * $this->arrCart[$i]['cost'];
				//echo "считаем сумму: ".$this->sum."<br>";
				$this->sum_weight += $this->arrCart[$i]['count'] * $this->arrCart[$i]['weight'];
			}
		}
		//echo "посчитали кол-во: ".$this->col." и сумму: ".$this->sum."<br>";
	}
	//получить общее кол-во товаров в корзине
	public function getCol() {
		return $this->col;
	}
	//получить общую стоимость товаров в корзине
	public function getSum() {
		return $this->sum;
	}
	public function getWeight() {
		return $this->sum_weight;
	}
	//получить массив корзины(для проверок)
	public function getArrCart() {
		return $this->arrCart;
	}
	//получить путь файла(для проверок)
	public function getPath() {
		return $this->source;
	}
	//ф-ция обработки добавления/удаления товара из корзины
	public function actionsWithCart($arrGoods) {
		$lengoods = count($arrGoods);
		$item = []; //временный массив(чтоб сохранять cost)
		//определяем на какой элемент кликнули
		if(isset($_GET['id'])) {
			//echo "кликнули на id: ".$_GET['id'];echo "<br>";
			for($i=0; $i<$lengoods; $i++) {
				if($arrGoods[$i]['id'] == $_GET['id']) {
					//echo "нашли этот id в массиве goods<br>";
					//echo "id равен: ".$arrGoods[$i]['id'];echo "<br>";
					$item['id'] = $arrGoods[$i]['id'];
					$item['cost'] = $arrGoods[$i]['cost'];
					$item['weight'] = $arrGoods[$i]['weight'];
					$item['count'] = 1; //установили 1 - нужно при добавлении в корзину
					//echo "выводим item['count']".$item['count']."<br>";
				}
			}
			// echo "данные по товару с этим id:<br>";
			// echo "массив item<br>";
			// echo "<pre>";
			// var_dump($item);
			// echo "</pre>";
		}
		//если нажали на "Добввить в корзину" или "+"
		if(isset($_GET['action']) && ($_GET['action'] === 'addtocart') ) {
			//echo "action addtocart<br>";
			$lencart = count($this->arrCart);
			$rule = false;
			//echo "длина массива корзины: ".$lencart."<br>";
			if($lencart === 0 && isset($_GET['id'])) {
				//echo "не было элемента с таким id в корзине";echo "<br>";
				$this->arrCart[] = $item;
			} elseif(isset($_GET['id'])) {
				for($j=0; $j<$lencart; $j++) {
				//если в массиве корзины есть элемент с id равным id из get-параметра, то увеличит кол-во
					if($this->arrCart[$j]['id'] == $_GET['id']) {
						//echo "айдишники arrCart и GET совпали - добавить cuont<br>";
						$rule = true;
						$this->arrCart[$j]['count']++;
					} 
				}
				if(!$rule) {
					//echo "id не совпали - добавить в конец массива элемент<br>";
					$this->arrCart[] = $item;
				}
			}

			// echo "массив arrCart в addtocart: <br>";
			// echo "<pre>";
			// var_dump($this->arrCart);
			// echo "</pre>";
			
        //если нажали на "-"
        } elseif(isset($_GET['action']) && ($_GET['action'] === 'deltocart')) {
        	//echo "в action deltocart<br>";
        	if(isset($_GET['id'])) {
        		//echo "get-параметр id: ".$_GET['id']."<br>";
	        	foreach ($this->arrCart as $key => $value) {
	        		if($value['id'] == $_GET['id']) {
	        			//echo "нашли в корзине совп. по id<br>";
	        			if($value['count'] > 0) {
	        				//echo "value['count'] > 0<br>";
	        				$this->arrCart[$key]['count']--;
	        			}
	        		}
	        	}
	        }

        //если нажали на "Х" (удалить из корзины)
        } elseif(isset($_GET['action']) && ($_GET['action'] === 'del_element')) {
        	// if(isset($this->arrCart[$_GET['id']])) {
        	// 	unset($this->arrCart[$_GET['id']]);
        	// }
        	if(isset($_GET['id'])) {
        		//echo "get-параметр id: ".$_GET['id']."<br>";
	        	foreach ($this->arrCart as $key => $value) {
	        		if($value['id'] == $_GET['id']) {
	        			//echo "нашли в корзине совп. по id<br>"
	        			unset($this->arrCart[$key]); //удаляем элемент
	        		}
	        	}
	        }
	  //      	echo "массив корзины после удаления:<br>";
	  //      	echo "<pre>";
			// var_dump($this->arrCart);
			// echo "</pre>";
	       	sort($this->arrCart); //ф-ция sort "встроенная" - применил сортировку массива после удаления элемента(чтобы сдвинуть индексы)
	  //      	echo "массив корзины после сортировки:<br>";
	  //      	echo "<pre>";
			// var_dump($this->arrCart);
			// echo "</pre>";
	    }
        

        if(isset($_GET['action'])) {
        	$this->writeArrToFile(); //записываем массив корзины в файл
	    }
	}
}