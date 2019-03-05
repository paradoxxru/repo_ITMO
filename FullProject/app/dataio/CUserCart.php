<?php
namespace app\dataio;

class CUserCart {
	protected $pdo;
	private $user_id;
	private $login;
	private $cart = [];
	private $total_cost = 0;
	private $total_weight = 0;
	private $total_count = 0;
	//для получения корзины пользователя
	private const CARTREQUEST = "SELECT
								goods.id, 
								goods.name, 
								goods.cost,
								goods.weight,
								goods.vogue,
								goods.category,
								goods.description,
								goods.img,
								goods.receipt_data,
								cart.goods_id,
								cart.goods_count as 'count_in_cart',
								(goods.cost * cart.goods_count) as 'summ_cost',
								cart.user_id ";
	private const FROM = "FROM goods ";
	private const JOIN = "LEFT JOIN cart ON goods.id = cart.goods_id
						LEFT JOIN `user` ON `user`.id = cart.user_id ";
	//для подсчета общей суммы, веса и кол-ва
	private const SUMMINFO = "SELECT
								SUM(goods.cost * cart.goods_count) as 'total_cost',
								SUM(cart.goods_count) as 'total_count',
								SUM(goods.weight * cart.goods_count) as 'total_weight' ";
	//для проверки есть ли товар в корзине(нужно при добавлении в корзину)
	private const CHECKCART = "SELECT
								goods.id,
								goods.name,
								`cart`.goods_count ";
	//при добавлении товара в корзину если он уже есть в корзине
	private const UPDATEPLUS = "UPDATE `cart` SET goods_count = goods_count +1 ";
	//при уменьшении кол-ва товара в корзину если он уже есть в корзине
	private const UPDATEMINUS = "UPDATE `cart` SET goods_count = goods_count -1 ";

	public function __construct($pdo, $login, $user_id) {
		$this->pdo = $pdo;
		$this->login = $login;
		if($login !== 'anonim') {
			$this->user_id = $user_id;
			$this->cart = $this->arrToCart();
			// echo "результат заполнения массива cart<br>";
			// echo "<pre>";
			// var_dump($this->cart);
			// echo "</pre>";
			// + проверять в сессии корзину и если она есть переносить(добавлять) в корзину пользователя
			//и удалять корзину из сессии
			if(isset($_SESSION['cart'])) {
				$this->combineCart();
				unset($_SESSION['cart']);
			}
		}
		else {//если аноним, то
			//формировать корзину из сессии
			if(isset($_SESSION['cart']) && $this->login === 'anonim') {
				$this->cart = $this->arrToCartAnonim();
			}
		}
		$this->calcTotalInfo();
	}
	//ф-ция соединяет корзину анонима и корзину пользователя(если она есть) при его логине
	private function combineCart() {
		//если корзина пользователя пуста, то заполняем ее из массива $_SESSION['cart']
		if(count($this->cart) == 0 )
			$this->cart = $this->arrToCartAnonim(); // + записать инфу в базу
		//иначе нужно добавить 
		else {
			//обойти массив $this->cart и массив полученный $this->arrToCartAnonim() на соотв-ия id
			$newcart = $this->arrToCartAnonim();
			// echo "массив newcart<br>";
			// echo "<pre>";
			// var_dump($newcart);
			// echo "</pre>";
			foreach ($this->cart as $key => $value) {
				foreach ($newcart as $n => $item) {
					//если есть совпадения то запросом поменять кол-во в базе корзины
					if($value['id'] == $item['id']) {
						//echo "совпали id<br>";
						$query = "UPDATE `cart` SET goods_count = goods_count + ".$item['count']
								." WHERE user_id = ".$this->user_id." AND goods_id = ".$item['id']
								." AND cart.status = 1;";
						//echo "строка запроса : ".$query.'<br>';
						$this->pdo->query($query);
						// и удалить элемент, так как далее его не будем обрабатывать
						unset($newcart[$n]);
					}
				}
			}
			// оставшиеся элементы корзины из полученные из сессии добавляем в базу корзины
			sort($newcart);
			foreach ($newcart as $key => $value) {
				$query = "INSERT INTO cart VALUES (NULL,".$value['id'].",".$value['count']
								.",".$this->user_id.", 1);";
				$this->pdo->query($query);
			}
			
		}
		//сделать обновление $this->cart из базы
		$this->cart = $this->arrToCart();
	}
	private function getWhere() {
		// echo "WHERE user_id = ".$this->user_id.";<br>";
		return "WHERE user_id = ".$this->user_id;
	}
	//ф-ция по запросу формирует массив корзины
	private function arrToCart() {
		$query = self::CARTREQUEST. self::FROM. self::JOIN .$this->getWhere()." AND cart.status =1;";
		$resalt = $this->pdo->query($query)->fetchAll();
		// echo "результат запроса корзины<br>";
		// echo "<pre>";
		// var_dump($resalt);
		// echo "</pre>";
		return $resalt;
	}
	//ф-ция формирует массив корзины анонима
	private function arrToCartAnonim() {
		//брать $_SESSION['cart'], по нему искать совпадения в полном каталоге(запросить из базы)
		$cart_anonim = [];
		$query = "SELECT * FROM goods;";
		$goods = $this->pdo->query($query)->fetchAll();
		//при нахождении записывать в массив $cart
		foreach ($goods as $key => $item) {
			if(isset($_SESSION['cart'])) {
				foreach($_SESSION['cart'] as $n => $value) {
					if($item['id'] == $value['id']) {
						$cart_anonim[] = ['id' => $item['id'],
										'name' => $item['name'],
										'cost' => $item['cost'],
										'weight' => $item['weight'],
										'count' => $value['count'],
										'vogue' => $item['vogue'],
										'category' => $item['category'],
										'description' => $item['description'],
										'img' => $item['img'],
										'receipt_data' => $item['receipt_data'],
										'count_in_cart' => $value['count'],
										'summ_cost' => $value['count'] * $item['cost']
									];
					}
				}
			}
		}
		// echo "корзина анонима <br>";
		// echo "<pre>";
		// var_dump($cart_anonim);
		// echo "</pre>";
		return $cart_anonim;
	}
	public function getCart() {
		return $this->cart;
	}
	//ф-ция считает общую сумму, кол-во и вес
	private function calcTotalInfo() {
		if($this->login !== 'anonim') {
			$query = self::SUMMINFO. self::FROM. self::JOIN .$this->getWhere()." AND cart.status =1;";
			$resalt = $this->pdo->query($query)->fetchAll();
			if(count($resalt) > 0) {
				$this->total_cost = $resalt[0]['total_cost'];
				$this->total_count = $resalt[0]['total_count'];
				$this->total_weight = $resalt[0]['total_weight'];
			}
		}
		//если аноним, то считать по массиву $this->cart
		else {
			$this->total_cost = 0;
			$this->total_weight = 0;
			$this->total_count = 0;
			foreach ($this->cart as $key => $item) {
				$this->total_cost += ($item['cost'] * $item['count']);
				$this->total_count += $item['count'];
				$this->total_weight += ($item['count'] * $item['weight']);
			}
		}
	}
	public function getTotalCost() {
		return $this->total_cost;
	}
	public function getTotalWeight() {
		return $this->total_weight;
	}
	public function getTotalCount() {
		return $this->total_count;
	}
	//ф-ция обработки добавления/удаления товара из корзины
	public function actionsWithCart() {
		//определить на какой элемент кликнули(нужно для обработки корзины анонима)
		// $query = "SELECT * FROM goods;";
		// $goods = $this->pdo->query($query)->fetchAll();

		//если нажали на "Добввить в корзину" или "+"
		if(isset($_GET['action']) && ($_GET['action'] === 'addtocart') && isset($_GET['id']) ) {
			if($this->login !== 'anonim') {
				//запрос на поиск такого товара в корзине пользователя
				$where = $this->getWhere(). " AND goods_id = ".$_GET['id']." AND status = 1;";
				$query = self::CHECKCART. self::FROM. self::JOIN. $where;
				$resalt = $this->pdo->query($query)->fetchAll();
				if(count($resalt)>0) { //если товар есть
					//то увеличить кол-во на 1
					//echo "надо увеличить кол-во<br>";
					//echo "where = ".$where."<br>";
					$query = self::UPDATEPLUS.$where;
					$this->pdo->query($query);
					//и уменьшить кол-во товара в базе goods

				}
				else { //если такого товара в корзине нет
					//то внести его в корзину
					//echo "надо добавить товар в корзину<br>";
					$query = "INSERT INTO cart VALUES (NULL,".$_GET['id'].", 1,".$this->user_id.", 1, NULL );";
					$this->pdo->query($query);
					//и уменьшить кол-во товара в базе goods

				}
			}
			else {
				//если аноним
				if(isset($_SESSION['cart'])) {
					$len = count($_SESSION['cart']);
					$k= false;
					for($i=0; $i<$len; $i++) {
						if($_SESSION['cart'][$i]['id'] == $_GET['id']) {
							$_SESSION['cart'][$i]['count']++;
							$k = true;
						}
					}
					//echo "id не совпали - добавить в конец массива элемент<br>";
					if(!$k) {
						$_SESSION['cart'][] = ['id' => $_GET['id'], 
												'count' => 1,
												'weight' => $_GET['weight'],
												'cost' => $_GET['cost'] ];
					}
				//если корзины в сессии еще не было, то создать
				} else {
					$_SESSION['cart'][0]['id'] = $_GET['id'];
					$_SESSION['cart'][0]['count'] = 1;
					$_SESSION['cart'][0]['weight'] = $_GET['weight'];
					$_SESSION['cart'][0]['cost'] = $_GET['cost'];
				}
			}
		//если нажали на "-"
		} elseif(isset($_GET['action']) && ($_GET['action'] === 'deltocart') && isset($_GET['id']) ) {
			if($this->login !== 'anonim') {
				//запрос на поиск такого товара в корзине пользователя
				$where = $this->getWhere(). " AND goods_id = ".$_GET['id']." AND status = 1;";
				$query = self::CHECKCART. self::FROM. self::JOIN. $where;
				$resalt = $this->pdo->query($query)->fetchAll();
				if(count($resalt)>0) { //если товар есть
					//то уменьшить кол-во в корзине на единицу
					$query = self::UPDATEMINUS.$where;
					$this->pdo->query($query);
					//увеличить кол-во товара в базе goods
				}
				//иначе(если такова товара нет в корзине), то ничего не делаем,
				//так как уже уменьшили до минимума

				//добавить кол-во товара в базе goods
			}
			else {
				//если аноним
				if(isset($_SESSION['cart']) )
					foreach ($_SESSION['cart'] as $key => $value) {
						if($value['id'] == $_GET['id'])
							if($value['count'] > 0)
								$_SESSION['cart'][$key]['count']--;
					}
			}
		//если нажали на "Х" (удалить из корзины)
		} elseif(isset($_GET['action']) && ($_GET['action'] === 'del_element') && isset($_GET['id'])) {
			if($this->login !== 'anonim') {
				$query = "DELETE FROM cart WHERE user_id ="
							.$this->user_id." AND goods_id =".$_GET['id']." AND status = 1;";
				$this->pdo->query($query);
				// добавить кол-во товара в базе goods
			}
			//если аноним
			else {
				foreach ($_SESSION['cart'] as $key => $value) {
					if($value['id'] == $_GET['id'])
						unset($_SESSION['cart'][$key]);
				}
				sort($_SESSION['cart']);//ф-ция sort "встроенная" - применил сортировку массива после удаления элемента(чтобы сдвинуть индексы)
			}
		}


		//записать изменения в $this->cart
		if($this->login !== 'anonim') {
			$this->cart = $this->arrToCart();
		} else { //если аноним, то
			$this->cart = $this->arrToCartAnonim();
		}
		//подсчет полной стоимости, веса, кол-ва
		$this->calcTotalInfo();
	}
	
	//ф-ция возвращает кол-во товара в базе goods по id
	public function getGoodsCount($id) {
		$query = "SELECT goods.`count` FROM goods WHERE id=".$id.";";
		return $this->pdo->query($query)->fetchAll();
	}
	// получить почту пользователя
	private function getEmail() {
		$query = "SELECT `user`.email FROM `user` WHERE id=".$this->user_id.";";
		return $this->pdo->query($query)->fetchAll();
	}
	//послать письмо покупателю
	public function sendMessage($delivery, $addr_delivery) {
		//$to = $this->getEmail()[0]['email'];
		//$to  = "<maksimov@gsom.pu.ru>";
		$to = "<paradoxxru@list.ru>";
		$subject = "заказ";
		$message = "<p>Уважаемый(ая), ".$this->login." ваш заказ принят.</p><br><br>";
		$message .= "<table style='border-collapse: separate; border-spacing: 2px; width: 100%;'>
			<th>Название</th><th>Вес</th><th>Цена</th><th>Кол-во</th><th>Стоимость</th>";
		foreach ($this->cart as $value) {
			$message .= "<tr>
						  <td style='border:1px solid;'>".$value['name']."</td>
					      <td style='border:1px solid;'>Вес: ".($value['weight']/1000)." кг.</td>
					      <td style='border:1px solid;'>".$value['cost']."</td>
					      <td style='border:1px solid;'>".$value['count_in_cart']."</td>
					      <td style='border:1px solid;'>".$value['summ_cost']."</td>
						</td>";
		}
		$message .= "<tr><td></td><td></td><td>Всего:</td><td>Вес:</td><td>Общая сумма:</td><tr>
						<tr>
							<td style='border:none;'></td><td style='border:none;'></td>
							<td style='border:1px solid;'>".$this->getTotalCount()."</td>
							<td style='border:1px solid;'>".($this->getTotalWeight()/1000)." кг.</td>
							<td style='border:1px solid;'>".$this->getTotalCost()." руб.</td>
						<tr>
					</table><br><br>";
		if($delivery == 'delivery' && isset($addr_delivery)) {
			$dostavka = 'доставка по адресу: '.$addr_delivery;
		}
		else {
			$dostavka = 'самовывоз с адреса: СПб, ул. Б. Морская, д.5';
		}
		$message .= "Выбранный способ доставки - ".$dostavka;
		//$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
		$headers = "Content-type: text/html; charset=UTF-8\r\n";
		$headers .= "From: <paradoxxru@list.ru>\r\n"; 
		//$headers .= "Reply-To: reply-to@example.com\r\n";
		if(isset($to) && isset($subject) && isset($message)) {
			mail($to, $subject, $message, $headers);
		}
	}
	// послать письмо продавцу из формы обратной связи
	public function sendMessageToSeller($message, $from) {
		$to = "<paradoxxru@list.ru>";
		$subject = "письмо от посетителя сайта";
		$message = $message . "<br><br> Письмо от ".$from."<br>";
		$headers = "Content-type: text/html; charset=UTF-8\r\n";
		$headers .= "From: <paradoxxru@list.ru>\r\n";
		mail($to, $subject, $message, $headers);
	}
	// смена статуса в корзине на 2(перевод в историю заказа) + добавить дату заказа
	public function changeStatusAndDate() {
		//изиенить статус и добавить дату заказа
		if(!empty($this->user_id)) {
			//сначала получить дату и время(чтобы у всех позиций не отличались секунды)
			$time = time();//определяем время(оно по Гринвичу)
			$time += 3 * 3600; // Добавляем 3 часа к времени по Гринвичу
			$date = date('Y-m-d H:i:s', $time);
			//подставить в запрос
			$query = "UPDATE cart SET status = 2, order_data ='".$date."'"
					." WHERE user_id =".$this->user_id." AND status = 1;";
			$this->pdo->query($query);
		}
	}
	
}