<?php
//класс записывающий и выдающий инфу из суперглобального массива $_SESSION
class CInfoSession {
	public static $col = 0;
	public static $sum = 0;
	public static $sum_weight = 0;
	public static function setInfoSession() {
		//если нажали на "Добввить в корзину" или "+"
		if(isset($_GET['action']) && ($_GET['action'] === 'addtocart') ) {
            if( isset($_SESSION['cart'][$_GET['id']]) ) {
                $_SESSION['cart'][$_GET['id']]++;
                // echo "в if по session++";
            }
            else
                $_SESSION['cart'][$_GET['id']] = 1;
        //если нажали на "-"
        } elseif(isset($_GET['action']) && ($_GET['action'] === 'deltocart')) {
        	if( isset($_SESSION['cart'][$_GET['id']]) ) {
        		if($_SESSION['cart'][$_GET['id']] > 0)
        			$_SESSION['cart'][$_GET['id']]--;
        		// else if($_SESSION['cart'][$_GET['id']] == 0)
        		// 	unset($_SESSION['cart'][$_GET['id']]);
        	}
        //если нажали на "Х" (удалить из корзины)
        } elseif(isset($_GET['action']) && ($_GET['action'] === 'del_element')) {
        	if( isset($_SESSION['cart'][$_GET['id']]) ) {
        		unset($_SESSION['cart'][$_GET['id']]);
        	}
        }
	}
	public static function getInfoSession($arr) {
		foreach ($arr as $i => $item) {
			if(isset($_SESSION['cart'])) {
				foreach ($_SESSION['cart'] as $key => $value) {
					if($key == $item['id']) {
						self::$col += $_SESSION['cart'][$key];
						self::$sum += $_SESSION['cart'][$key] * $item['cost'];
						self::$sum_weight += $item['weight'] * $_SESSION['cart'][$key];
					}
				}
			}
		}
	}
}


?>