<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 19.01.2019
 * Time: 11:26
 */

interface IPageController
{
    public function setPermissions($permissions);
    public function render();
}