<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.12.2018
 * Time: 15:13
 */

// Задаем константы для обозначения действий
define('ADD_NEW_PRODUCT', 1);
define('EDIT_PRODUCT', 2);
define('DELETE_PRODUCT', 3);

// Создаем переменную, в которой хранится код необходимого действия
$cmd = ADD_NEW_PRODUCT;

// При помощи конструкции switch-case определяем, какое действие необходимо выполнить
switch ($cmd) {
    case ADD_NEW_PRODUCT:
        echo 'Добавить новый продукт';
        break;
    case EDIT_PRODUCT:
        echo 'Изменить продукт';
        break;
    case DELETE_PRODUCT:
        echo 'Удалить продукт';
        break;
    default:
        echo 'Неверный код операции';
}
