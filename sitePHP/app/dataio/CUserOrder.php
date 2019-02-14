<?php

class CUserOrder
{
	private $login; //логин пользователя
	private $userOrder = []; //массив заказа
	private $path_to_cart; //путь до корзины
	private $addr; //адрес доставки
	private $path_to_history; //путь до истории заказов(yaml формат) пользователя
	private $path_to_order; //путь до заказа
	private $numberOrder; // номер заказа
	private $arrYAML = []; //массив
	private $lines; // массив строк при чтении/записи из yaml
    private $i; // счетчик
    private $total_lines; //длина массива строк

	public function __construct($log) {
		if($log !== 'anonim') {
			//сначала прочитать файл базы пользователей и сравнить с $log
			$users = file('../app/users.db');
			foreach ($users as $user) {
				if(strpos($user,$log.':') === 0) {//проверяем есть ли логин в базе
					$this->login = $log;
					if(file_exists('../app/config/userCarts/'.$log.'.db')) {//проверяем есть ли файл
						$this->path_to_cart = '../app/config/userCarts/'.$log.'.db';
						$userOrder = $this->toArrOrder($this->path_to_cart);
					}
				}
			}
		} else {
			print("<script language=javascript>window.alert('вы не вошли в систему');</script>");
		}

		//если ест у него файл корзины, то переносим данные в приватный массив
	}
	//принимает путь до корзины,заполняет массив корзины
	private function toArrOrder($path) {
		$lines = file($path); //массив строк из файла
		$len = count($lines);
		for($i=0; $i<$len; $i++) {
			$line = $lines[$i]; //строка вида('id:3;count:6;cost:1500')
			$vals = explode(';', trim($line)); //массив($vals[0]='id:3' ,$vals[1]='count:6' ,$vals[2]='cost:1500', $vals[3]='weight:500')
			foreach ($vals as $key => $value) {
				$new = explode(':', trim($value)); //массив($new[0]='id',$new[1]='3')
														//при следующей итерации $new[0]='count',$new[1]='6'
				$new_arr[$new[0]] = $new[1];
			}
			$this->userOrder[$i] = $new_arr;
		}
	}
	//возвращает
	public function getOrder() {
		return $this->userOrder;
	}

	public function setAddrDelivery() {
		//записать в файл и в поле адрес доставки(в формате login:адрес)
		if (isset($_POST['addr'])) {
			$this->addr = $_POST['addr'];

		}
	}
	private function delCart_setHistory() {
		//как только заказ подтвержден - удалить файл корзины пользователя и перенести данные в историю заказов(отдельный файл historylogin.db)
	}
	private function sendMail() {
		//как только подтвердили заказ рассылать письма покупателю и продавцу
		//указывать всю инфу - товар, адрес доставки, номер заказа, время заказа
	}
	//генерировать номер заказа
	public function genNumberOrder() {
		return $this->numberOrder = ''.date('Ymd').'.'.microtime(true).'';
		// и здесь записывать файл заказа + рассылать письма + писать в историю и удалять корзину
	}
	//чтение из yaml
	public function readYAML() {
		$this->path_to_history = '../app/config/userHistories/test.yaml';
		$this->lines = file($this->path_to_history);

		$this->total_lines = count($this->lines);
		// echo "всего строк: ".$this->total_lines."<br>";
		for($this->i = 0; $this->i < $this->total_lines; $this->i++) {
			$line = trim($this->lines[$this->i]);
			// echo "строка: <br>";
			// echo $line."<br>";
			$vals = explode(':', $line);
			$this->setArrYaml($vals[0], $this->getValue(trim($vals[1]), 0));
			echo "шаг :".$this->i."<br>";
			echo "массив yaml:<br>";
			echo "<pre>";
			var_dump($this->arrYAML);
			echo "</pre>";
		}
		// echo "массив yaml:<br>";
		// echo "<pre>";
		// var_dump($this->arrYAML);
		// echo "</pre>";
	}
	private function getValue($val, $level) {
		if(empty($val)) {
            $val = [];
            for($this->i++;$this->i < $this->total_lines; $this->i++) {
            	$line = $this->lines[$this->i];
                preg_match_all("/^([\t]*)/", $line, $matches);
                if(!isset($matches[0][0]) || strlen($matches[0][0]) <= $level) {
                	$this->i--;
                    return $val;
                }
                $vals = explode(':', trim($line));
                $new_level = $level + 1;
                $val[$vals[0]] = $this->getValue(trim($vals[1]), ($level + 1));
            }
            return $val;
        } else {
            return $val; //для рекурсии
        }
	}

	public function writeYAML() {
		$this->lines = [];
        foreach($this->arrYAML as $key => $val) {
            $this->valueToYaml($key, $val);
        }
        $text = implode("\n", $this->lines);
        file_put_contents($this->path_to_history, trim($text));
	}

	private function valueToYaml($key, $val, $indent = "")
    {
        print_r($val);
        if(is_array($val) || is_object($val)) {
            $this->lines[] = $indent . $key . ":";
            foreach($val as $k => $v) {
                $this->valueToYaml($k, $v, ($indent . "\t"));
            }
        } else
        {
            $this->lines[] = $indent . $key . ": " . $val;
        }
    }

	public function setArrYaml($key, $value) {
        $this->arrYAML[$key] = $value;
        // echo "массив arrYAML[key]<br>";
        // echo "key :".$key."<br>";
        // echo "значение:<br>";
        // echo "<pre>";
        // var_dump($value);
        // echo "</pre>";
    }
    public function getArrYaml() {
        return $this->arrYAML;
    }
}