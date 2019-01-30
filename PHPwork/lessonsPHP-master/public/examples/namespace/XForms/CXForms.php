<?php
//пространство имен
namespace XForms;

// класс для создания веб-форм (для формирования и вывода форм)
class CXForms
{
	//для формирования id (чтобы связатть label и input)
	private static $input_counter = 0; //счетчик для уникального номера
	static function getInputId() {	// ф-ция возвращает уникальный номер
		return ++self::$input_counter;
	}

	private $inputs =[]; //масив массивов. каждый элемент это ассоц. массив с полями: 
	// 'name','label','placeholder','type'
	//для добавления инпутов
	//будем добавлять элементы в массив $inputs
	public function addInput($name, $label, $placeholder, $type) {
		$this->inputs[] = new CXFormElementInput($name, $label, $placeholder, $type);
		// echo "name: ".$name;echo "<br>";
		// echo "label: ".$label;echo "<br>";
		// echo "placeholder: ".$placeholder;echo "<br>";
		// echo "type: ".$type;echo "<br>";
			// [ //добавляем в конец массива элемент-массив
			// 'name'=> $name,
			// 'label'=> $label,
			// 'placeholder'=> $placeholder,
			// 'type'=> $type,
			// ];
	}
	//для вывода - для получения формы на экране. Перепишем метод __toString
	public function __toString() {
		$html = '';
		// .= добавить к концу строки
		//для формирования id (чтоб связать label и input) можно
			// формировать md5 от микросекунд : md5(microtime(true))
			// или xforms-(какое-то имя)+(плюс использовать ф-цию, выдающую уникальный номер)
		//$html.= "<form>";
		echo "<pre>";
		var_dump($this->inputs);
		for ($i=0; $i < count($this->inputs); $i++) { 
					// $id = 'xforms-' . CXForms::getInputId();
					// $html.= '<label for="'.$id.'">'.$this->inputs[$i]['label']."</label>";
					// $html.= "<input ";
					// $html.= 'id="'.$id.'"';
					// $html.= 'name="'.$this->inputs[$i]['name'].'"';
					// $html.= 'placeholder="'.$this->inputs[$i]['placeholder'].'"';
					// $html.= 'type="'.$this->inputs[$i]['type'].'"';
					// $html.= " />";

		}
		// for ($i=0;$i<count($this->inputs);$i++) {
		// 		$html .= $this->getInputHTML($i);
		// 	}	

		//$html.= "</form>";
		echo "</pre>";
		return $html;//''.print_r($this->inputs, true); // true - значит не выводит, а возвращает
	}
	protected function getInputHTML($i) {
		$html = ''; //другая переменная
		$id = 'xforms-' . CXForms::getInputId();
		$html.= '<label for="'.$id.'">'.$this->inputs[$i]['label']."</label>";
		$html.= "<input ";
		$html.= 'id="'.$id.'"';
		$html.= 'name="'.$this->inputs[$i]['name'].'"';
		$html.= 'placeholder="'.$this->inputs[$i]['placeholder'].'"';
		$html.= 'type="'.$this->inputs[$i]['type'].'"';
		$html.= " />";
		return $html;
	}
}
