<?php

namespace XForms;

abstract class AXFormElement implements IXFormElements
{
	protected $input = [];
	//для валидации элементов формы
	public function validate() : bool // bool - обозначаем что будет возвращать булево значение
	{
		return isset($this->input['value']) && strlen($this->input['value'])>0 ; //strlen() - проверяем на длину строки
	}

	//для формирования html кода элемента формы
	public function render(int $id) : string
	{
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

	public function __construct($name, $label, $placeholder, $type)
	{
		$this->input = [
			'name'=> $name,
			'label'=> $label,
			'placeholder'=> $placeholder,
			'type'=> $type
		];
	}
}