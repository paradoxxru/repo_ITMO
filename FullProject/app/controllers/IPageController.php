<?php
namespace app\controllers;

interface IPageController
{
	public function setPermissions($permissions); //разрешения
	public function render(); //формирование страницы
}