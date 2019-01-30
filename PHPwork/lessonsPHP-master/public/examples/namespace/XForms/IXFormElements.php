<?php
namespace XForms;

interface IXFormElements
{
	//для валидации элементов формы
	public function validate() : bool; // bool - обозначаем что будет возвращать булево значение

	//для формирования html кода элемента формы
	public function render(int $id) : string;
}

?>