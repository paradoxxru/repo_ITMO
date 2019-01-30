<?php
								//Исключения (отлов ошибок)

// class MyException extends Exception {}//наш класс исключений MyException(обязательно должен быть наследником Exception - это "встроенный" класс исключений)

// try {
// 	//throw new Exception('Our castom err'); // new Exception - создали новый объект класса исключений и в его конструктор передаем 'Our castom err'. throw - выброс исключения
// 	throw new MyException('Our castom err');
// } catch(MyException $e) {//сначала перехватываем наши исключения
// 	//выполняется если в try.....
// 	echo "<pre>Наше исключение: ".$e->getMessage()."</pre>";
// } catch(Exception $e) {
// 	//выполняется если в try.....
// 	echo "<pre>другое исключение: ".$e->getMessage()."</pre>";
// //можно написать catch(MyException|Exception $e) - это значит ИЛИ (то есть в одном catch отлавливать два исключения)
// } finally {
// 	//выполняется в любом случае
// 	echo "<p>finally</p>";
// }
			//когда это применяется:
class SymbolNotFound extends Exception {} //создали класс-наследник класса исключений
//например надо найти символ в строке, но символа нет и strpos вернет false(мнегие ф-ции возвращают -1),
// а мы ожидаем индекса
$str = "ppppppppp";
$i = strpos($str, 'a');
echo "<p>Метод 1</p>";
echo "Position: " . (is_numeric($i) ? $i : 'Символ не найден');

function new_strpos($haystak, $needle) {//создаем свою(другую) ф-цию поиска в строке
    $i = strpos($haystak, $needle);
    if(is_bool($i))
        //если возвращаемое значение у нас булево, то создается объект исключений и выбрасывается исключение
        throw new SymbolNotFound("Символ не найден");
    return $i;
}
echo "<br/>";
echo "<p>Метод 2</p>"; // этот метод считается корректным в современном программировании
try {// "не безопасный" код помещаем сюда и если будет ошибка, то
    $i = new_strpos($str, 'a');
    echo "Position: " . $i;
} catch (SymbolNotFound $e) {// то сработает это
    echo $e->getMessage();	// выведется сообщение "Символ не найден", а не например HTTP_ERR 500(ошибка сервера)
}

?>