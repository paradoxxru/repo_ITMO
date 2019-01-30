<?php

interface IPageController
{
	public function setPermissions($permissions); //разрешения
	public function render(); //формирование страницы
}

?>